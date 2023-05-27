<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProntuarioModel;
use App\Models\UserActionModel;

class GerenciaPront extends BaseController
{
    private $prontModel;
    private $userActionModel;

    public function __construct()
    {
        $this->prontModel = new ProntuarioModel();
        $this->userActionModel = new UserActionModel();
    }

    public function index()
    {
        $prontuarios = $this->prontModel->select('id, responsavel, paciente, data')->orderBy('data', 'DESC')->get()->getResult();

        $prontuarios = json_decode(json_encode($prontuarios), true);

        // Formata a data no formato desejado
        foreach ($prontuarios as &$prontuario) {
            $prontuario['data'] = date('d-m-Y', strtotime($prontuario['data']));
        }

        // Pagination variables
        $totalItems = count($prontuarios);
        $itemsPerPage = 5;
        $totalPages = ceil($totalItems / $itemsPerPage);
        $currentPage = $this->request->getVar('page') ? $this->request->getVar('page') : 1;

        // Slice the array based on the current page
        $offset = ($currentPage - 1) * $itemsPerPage;
        $prontuarios = array_slice($prontuarios, $offset, $itemsPerPage);

        $id_usuario = $this->session->get('id_usuario');

        return view('historico_prontuario', [
            'id_usuario' => $id_usuario,
            'prontuario' => $prontuarios,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages
        ]);
    }


    public function search()
    {
        $searchTerm = $this->request->getVar('searchTerm'); // Obtém o termo de busca enviado através do formulário
        $prontuarios = $this->prontModel->select('id, responsavel, paciente, data')
            ->like('responsavel', $searchTerm)
            ->orLike('paciente', $searchTerm)
            ->orderBy('data', 'DESC')
            ->get()
            ->getResult();

        $prontuarios = json_decode(json_encode($prontuarios), true);

        // Formata a data no formato desejado
        foreach ($prontuarios as &$prontuario) {
            $prontuario['data'] = date('d-m-Y', strtotime($prontuario['data']));
        }

        // Pagination variables
        $totalItems = count($prontuarios);
        $itemsPerPage = 5;
        $totalPages = ceil($totalItems / $itemsPerPage);
        $currentPage = $this->request->getVar('page') ? $this->request->getVar('page') : 1;

        // Slice the array based on the current page
        $offset = ($currentPage - 1) * $itemsPerPage;
        $prontuarios = array_slice($prontuarios, $offset, $itemsPerPage);

        $id_usuario = $this->session->get('id_usuario');

        return view('historico_prontuario', [
            'id_usuario' => $id_usuario,
            'prontuario' => $prontuarios,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
            'searchTerm' => $searchTerm
        ]);
    }



    public function delete($id)
    {
        if ($this->prontModel->delete($id)) {
            $data['message'] = 'Ficha excluida com sucesso!';
            $data['type'] = 'success';
        } else {
            $data['message'] = 'Erro ao excluir!';
            $data['type'] = 'error';
        }

        $prontuarios = $this->prontModel->select('id, responsavel, paciente, data')->orderBy('data', 'DESC')->limit(5)->get()->getResult();
        $prontuarios = json_decode(json_encode($prontuarios), true);

        // Formata a data no formato desejado
        foreach ($prontuarios as &$prontuario) {
            $prontuario['data'] = date('d-m-Y', strtotime($prontuario['data']));
        }

        // Pagination variables
        $totalItems = count($prontuarios);
        $itemsPerPage = 5;
        $totalPages = ceil($totalItems / $itemsPerPage);
        $currentPage = $this->request->getVar('page') ? $this->request->getVar('page') : 1;

        // Slice the array based on the current page
        $offset = ($currentPage - 1) * $itemsPerPage;
        $prontuarios = array_slice($prontuarios, $offset, $itemsPerPage);

        $id_usuario = $this->session->get('id_usuario');
        $nome = $this->session->get('nome');

        $this->registerUserAction('Excluiu um prontuário');

        return view('historico_prontuario', [
            'id_usuario' => $id_usuario,
            'nome' => $nome,
            'prontuario' => $prontuarios,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
            'message' => $data['message'],
            'type' => $data['type']
        ]);
    }

    public function create()
    {

        return view('prontuario');
    }

    public function store()
    {

        if ($this->prontModel->save($this->request->getPost())) {

            $data['message'] = 'Salvo com sucesso!';
            $data['type'] = 'success';
        } else {
            $data['message'] = 'Erro ao salvar!';
            $data['type'] = 'error';
        }

        $id_usuario = $this->session->get('id_usuario');
        $nome = $this->session->get('nome');

        $this->registerUserAction('Criou um novo prontuário');

        return view('prontuario',[
            'id_usuario' => $id_usuario,
            'nome' => $nome,
            'message' => $data['message'],
            'type' => $data['type'] 
    ]);
    }

    public function storeEdit()
    {

        if ($this->prontModel->save($this->request->getPost())) {

            $data['message'] = 'Salvo com sucesso!';
            $data['type'] = 'success';
        } else {
            $data['message'] = 'Erro ao salvar!';
            $data['type'] = 'error';
        }

        $id_usuario = $this->session->get('id_usuario');
        $nome = $this->session->get('nome');

        $this->registerUserAction('Editou um prontuário');

        return view('prontuarioEdit',[
            'id_usuario' => $id_usuario,
            'nome' => $nome,
            'message' => $data['message'],
            'type' => $data['type'] 
    ]);
    }



    public function edit($id)
    {

        return view('prontuarioEdit', ['prontuario' => $this->prontModel->find($id)]);
    }

    public function pdf($id)
    {

        $prontuario = $this->prontModel->find($id);

        if (!$prontuario) {
            // O registro não foi encontrado na tabela
            echo "Registro não encontrado";
            return;
        }

        $mpdf = new \Mpdf\Mpdf();

        // Formata a data em PT-BR
        $data = date("d/m/Y", strtotime($prontuario['data']));

        // Adicione conteúdo ao PDF
        $mpdf->SetHeader('<div style="text-align:center;"><img src="../public/img/nap2.png" width="200" height="80" style="display:block; margin:auto;"/></div><h3 style="color: #2D4A61; font-family: Arial, sans-serif; text-align: center;">NAP - Núcleo de Apoio Psicopedagógico</h3>');

        $mpdf->AddPage();

        $mpdf->SetHeader('');


        $mpdf->WriteHTML('<br>');
        $mpdf->WriteHTML('<h1 style="color: #2D4A61; font-size: 32px; font-family: Arial, sans-serif; text-align: center; margin-top: 100px; margin-bottom: 50px;">Ficha de Paciente - Prontuário</h1>');
        $mpdf->WriteHTML('<p style="font-size: 18px; font-family: Arial, sans-serif;"><strong>Responsável pelo atendimento:</strong> <span style="color: #2D4A61;">' . $prontuario['responsavel'] . '</span></p>');
        $mpdf->WriteHTML('<p style="font-size: 18px; font-family: Arial, sans-serif;"><strong>Paciente:</strong> <span style="color: #2D4A61;">' . $prontuario['paciente'] . '</span></p>');
        $mpdf->WriteHTML('<p style="font-size: 18px; font-family: Arial, sans-serif;"><strong>Data:</strong> <span style="color: #2D4A61;">' . $data . '</span></p>');
        $mpdf->WriteHTML('<div style="border: 1px solid #2D4A61; padding: 10px; margin-top: 20px;"><p style="font-size: 20px; font-family: Arial, sans-serif; font-weight: bold; color: #2D4A61;">Descrição:</p><p style="font-size: 18px; font-family: Arial, sans-serif;">' . $prontuario['descricao'] . '</p></div>');



        // Salve o PDF em um arquivo
        $mpdf->Output('Prontuario.pdf', 'D');
    }

    private function registerUserAction($action)
    {
        $id_usuario = $this->session->get('id_usuario');
        $nome = $this->session->get('nome');

        $data = [
            'id_usuario' => $id_usuario,
            'nome' => $nome,
            'action' => $action,
            'timestamp' => date('Y-m-d H:i:s')
        ];

        $this->userActionModel->insert($data);
    }
}
