<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AnamneseModel;
use App\Models\UserActionModel;

class GerenciaAnam extends BaseController

{

    private $anamModel;
    private $userActionModel;

    public function __construct()
    {
        $this->anamModel = new AnamneseModel();
        $this->userActionModel = new UserActionModel();
        
    }

    public function index()
    {
        $anamneses = $this->anamModel->select('id, responsavel, paciente, data')->orderBy('data', 'DESC')->get()->getResult();
        
        $anamneses = json_decode(json_encode($anamneses), true);
    
        // Formata a data no formato desejado
        foreach ($anamneses as & $anamnese) {
            $anamnese['data'] = date('d-m-Y', strtotime($anamnese['data']));
        }
    
        // Pagination variables
        $totalItems = count($anamneses);
        $itemsPerPage = 5;
        $totalPages = ceil($totalItems / $itemsPerPage);
        $currentPage = $this->request->getVar('page') ? $this->request->getVar('page') : 1;
    
        // Slice the array based on the current page
        $offset = ($currentPage - 1) * $itemsPerPage;
        $anamneses = array_slice($anamneses, $offset, $itemsPerPage);
    
        return view('historico_anamnese', [
            'anamnese' => $anamneses,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages
        ]);
    }

    public function search()
    {
        $searchTerm = $this->request->getVar('searchTerm'); // Obtém o termo de busca enviado através do formulário
        $anamneses = $this->anamModel->select('id, responsavel, paciente, data, hora')
                                        ->like('responsavel', $searchTerm)
                                        ->orLike('paciente', $searchTerm)
                                        ->orderBy('data', 'DESC')
                                        ->get()
                                        ->getResult();
    
        $anamneses = json_decode(json_encode($anamneses), true);
    
        // Formata a data no formato desejado
        foreach ($anamneses as &$anamnese) {
            $anamnese['data'] = date('d-m-Y', strtotime($anamnese['data']));
        }

        // Pagination variables
        $totalItems = count($anamneses);
        $itemsPerPage = 5;
        $totalPages = ceil($totalItems / $itemsPerPage);
        $currentPage = $this->request->getVar('page') ? $this->request->getVar('page') : 1;
    
        // Slice the array based on the current page
        $offset = ($currentPage - 1) * $itemsPerPage;
        $anamneses = array_slice($anamneses, $offset, $itemsPerPage);
    
        return view('historico_anamnese', [
            'anamnese' => $anamneses,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
            'searchTerm' => $searchTerm
        ]);
    }

    public function delete($id)
    {
        if($this->anamModel->delete($id)){
            $data['message'] = 'Ficha excluida com sucesso!';
            $data['type'] = 'success';
        }

        else{
            $data['message'] = 'Erro ao excluir!';
            $data['type'] = 'error';
        }

        $anamneses = $this->anamModel->select('id, responsavel, paciente, data ,hora')->orderBy('data', 'DESC')->limit(5)->get()->getResult();
        $anamneses = json_decode(json_encode($anamneses), true);

        // Formata a data no formato desejado
        foreach ($anamneses as &$anamnese) {
            $anamnese['data'] = date('d-m-Y', strtotime($anamnese['data']));
        }

         // Pagination variables
        $totalItems = count($anamneses);
        $itemsPerPage = 5;
        $totalPages = ceil($totalItems / $itemsPerPage);
        $currentPage = $this->request->getVar('page') ? $this->request->getVar('page') : 1;
    
        // Slice the array based on the current page
        $offset = ($currentPage - 1) * $itemsPerPage;
        $anamneses = array_slice($anamneses, $offset, $itemsPerPage);

        $id_usuario = $this->session->get('id_usuario');
        $nome = $this->session->get('nome');

        $this->registerUserAction('Excluiu uma anamnese');
    
        return view('historico_anamnese', [
            'id_usuario' => $id_usuario,
            'nome' => $nome,
            'anamnese' => $anamneses,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
            'message' => $data['message'],
            'type' => $data['type']
        ]);

    }

    public function create(){

        return view('anamnese');

    }

    public function store(){
        
        if($this->anamModel->save($this->request->getPost())){

            $data['message'] = 'Salvo com sucesso!';
            $data['type'] = 'success';
        
        }
        else{
            $data['message'] = 'Erro ao salvar!';
            $data['type'] = 'error';
        }

        $id_usuario = $this->session->get('id_usuario');
        $nome = $this->session->get('nome');

        $this->registerUserAction('Criou uma nova anamnese');
        
        return view('anamnese',[
            'id_usuario' => $id_usuario,
            'nome' => $nome,
            'message' => $data['message'],
            'type' => $data['type']
        ]);
    }

    public function storeEdit(){
        
        if($this->anamModel->save($this->request->getPost())){

            $data['message'] = 'Salvo com sucesso!';
            $data['type'] = 'success';
        
        }
        else{
            $data['message'] = 'Erro ao salvar!';
            $data['type'] = 'error';
        }

        $id_usuario = $this->session->get('id_usuario');
        $nome = $this->session->get('nome');

        $this->registerUserAction('Editou uma anamnese');
        
        return view('anamneseEdit',[
            'id_usuario' => $id_usuario,
            'nome' => $nome,
            'message' => $data['message'],
            'type' => $data['type'] 
        ]);
    }



    public function edit($id)
    {

        return view('anamneseEdit', ['anamnese' => $this->anamModel->find($id)]);
        
       
    }

    public function pdf($id)
    {

        $anamnese = $this->anamModel->find($id);
    
        if (!$anamnese) {
            echo "Registro não encontrado";
            return;
        }
    
        $mpdf = new \Mpdf\Mpdf();
    
        // Formata a data em PT-BR
        $data = date("d/m/Y", strtotime($anamnese['data']));
        $data_nascimento = date("d/m/Y", strtotime($anamnese['data_nascimento']));
    
        // Adicione conteúdo ao PDF
        $mpdf->SetHeader('<div style="text-align:center;"><img src="../public/img/nap2.png" width="200" height="80" style="display:block; margin:auto;"/></div><h3 style="color: #2D4A61; font-family: Arial, sans-serif; text-align: center;">NAP - Núcleo de Apoio Psicopedagógico</h3>');
    
        $mpdf->AddPage();

        $mpdf->SetHeader('');

        $mpdf->WriteHTML('<br>');
        $mpdf->WriteHTML('<h1 style="color: #2D4A61; font-size: 32px; font-family: Arial, sans-serif; text-align: center; margin-top: 100px; margin-bottom: 50px;">Ficha de Paciente - Anamnese</h1>');
        $mpdf->WriteHTML('<p style="font-size: 18px; font-family: Arial, sans-serif;"><strong>Responsável pelo atendimento:</strong> <span style="color: #2D4A61;">' . $anamnese['responsavel_ficha'] . '</span></p>');
        $mpdf->WriteHTML('<p style="font-size: 18px; font-family: Arial, sans-serif;"><strong>Paciente:</strong> <span style="color: #2D4A61;">' . $anamnese['paciente'] . '</span></p>');
        $mpdf->WriteHTML('<p style="font-size: 18px; font-family: Arial, sans-serif;"><strong>Data:</strong> <span style="color: #2D4A61;">' . $data .'</span></p>');
        $mpdf->WriteHTML('<p style="font-size: 18px; font-family: Arial, sans-serif;"><strong>Responsável:</strong> <span style="color: #2D4A61;">' . $anamnese['responsavel'] . '</span></p>');
        $mpdf->WriteHTML('<p style="font-size: 18px; font-family: Arial, sans-serif;"><strong>Curso:</strong> <span style="color: #2D4A61;">' . $anamnese['curso'] . '</span></p>');
        $mpdf->WriteHTML('<p style="font-size: 18px; font-family: Arial, sans-serif;"><strong>E-mail:</strong> <span style="color: #2D4A61;">' . $anamnese['email'] . '</span></p>');
        $mpdf->WriteHTML('<p style="font-size: 18px; font-family: Arial, sans-serif;"><strong>Data de nascomento:</strong> <span style="color: #2D4A61;">' . $data_nascimento . '</span></p>');
        $mpdf->WriteHTML('<p style="font-size: 18px; font-family: Arial, sans-serif;"><strong>Idade:</strong> ' . $anamnese['idade'] . '</span></p>');
        $mpdf->WriteHTML('<p style="font-size: 18px; font-family: Arial, sans-serif;"><strong>Telefone:</strong> <span style="color: #2D4A61;"> ' . $anamnese['telefone'] . '</span></p>');
        $mpdf->WriteHTML('<p style="font-size: 18px; font-family: Arial, sans-serif;"><strong>Periodo:</strong> <span style="color: #2D4A61;"> ' . $anamnese['periodo_turno'] . '</span></p>');
        $mpdf->WriteHTML('<div style="border: 1px solid #2D4A61; padding: 10px; margin-top: 20px;"><p style="font-size: 20px; font-family: Arial, sans-serif; font-weight: bold; color: #2D4A61;">Descrição:</p><p style="font-size: 18px; font-family: Arial, sans-serif;">' . $anamnese['descricao'] . '</p></div>');
        $mpdf->WriteHTML('<div style="border: 1px solid #2D4A61; padding: 10px; margin-top: 20px;"><p style="font-size: 20px; font-family: Arial, sans-serif; font-weight: bold; color: #2D4A61;">Historico:</p><p style="font-size: 18px; font-family: Arial, sans-serif;">'. $anamnese['historico'] . '</p></div');
        $mpdf->WriteHTML('<div style="border: 1px solid #2D4A61; padding: 10px; margin-top: 20px;"><p style="font-size: 20px; font-family: Arial, sans-serif; font-weight: bold; color: #2D4A61;">Historico Familiar:</p><p style="font-size: 18px; font-family: Arial, sans-serif;">' . $anamnese['historico_familia'] . '</p></div>');
        $mpdf->WriteHTML('<div style="border: 1px solid #2D4A61; padding: 10px; margin-top: 20px;"><p style="font-size: 20px; font-family: Arial, sans-serif; font-weight: bold; color: #2D4A61;">Relação Familiar:</p><p style="font-size: 18px; font-family: Arial, sans-serif;">' . $anamnese['relacao_familiar'] . '</p></div>');

    
        // Salve o PDF em um arquivo
        $mpdf->Output('Anamnese.pdf', 'D');
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