<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\UsuarioModel;
use App\Models\UserActionModel;

use function PHPUnit\Framework\returnSelf;

class Usuarios extends BaseController

{

    private $usuarioModel;
    private $createModel;
    private $userActionModel;

    public function __construct()
    {
        $this->usuarioModel = new UserModel();
        $this->createModel = new UsuarioModel();
        $this->userActionModel = new UserActionModel();
    }

    public function index()
    {

        $usuarios = $this->usuarioModel->select('id, nome, matricula, perfil')->orderBy('id', 'DESC')->get()->getResult();

        $usuarios = json_decode(json_encode($usuarios), true);

        // Pagination variables
        $totalItems = count($usuarios);
        $itemsPerPage = 5;
        $totalPages = ceil($totalItems / $itemsPerPage);
        $currentPage = $this->request->getVar('page') ? $this->request->getVar('page') : 1;

        // Slice the array based on the current page
        $offset = ($currentPage - 1) * $itemsPerPage;
        $usuarios = array_slice($usuarios, $offset, $itemsPerPage);

        return view('usuarios', [
            'usuarios' => $usuarios,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
        ]);
    }

    public function actionUser()
    {

        $user_actions = $this->userActionModel->select('id, id_usuario, nome, action, timestamp')->orderBy('timestamp', 'DESC')->get()->getResult();

        $user_actions = json_decode(json_encode($user_actions), true);

        // Pagination variables
        $totalItems = count($user_actions);
        $itemsPerPage = 5;
        $totalPages = ceil($totalItems / $itemsPerPage);
        $currentPage = $this->request->getVar('page') ? $this->request->getVar('page') : 1;

        // Slice the array based on the current page
        $offset = ($currentPage - 1) * $itemsPerPage;
        $user_actions = array_slice($user_actions, $offset, $itemsPerPage);

        return view('userActions', [
            'user_action' => $user_actions,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
        ]);
    }

    public function search_Action()
    {
        $searchTerm = $this->request->getVar('searchTerm'); // Obtém o termo de busca enviado através do formulário
        $user_actions = $this->userActionModel->select('id, id_usuario, nome, action, timestamp')
            ->like('nome', $searchTerm)
            ->orLike('action', $searchTerm)
            ->orderBy('timestamp', 'DESC')
            ->get()
            ->getResult();

        $user_actions = json_decode(json_encode($user_actions), true);

        

        // Pagination variables
        $totalItems = count($user_actions);
        $itemsPerPage = 5;
        $totalPages = ceil($totalItems / $itemsPerPage);
        $currentPage = $this->request->getVar('page') ? $this->request->getVar('page') : 1;

        // Slice the array based on the current page
        $offset = ($currentPage - 1) * $itemsPerPage;
        $user_actions = array_slice($user_actions, $offset, $itemsPerPage);

        return view('userActions', [
            'user_action' => $user_actions,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
        ]);
    }

    public function search()
    {
        $searchTerm = $this->request->getVar('searchTerm'); // Obtém o termo de busca enviado através do formulário
        $usuarios = $this->usuarioModel->select('id, nome, matricula, perfil')
            ->like('nome', $searchTerm)
            ->orLike('matricula', $searchTerm)
            ->orderBy('id', 'DESC')
            ->get()
            ->getResult();

        $usuarios = json_decode(json_encode($usuarios), true);


        // Pagination variables
        $totalItems = count($usuarios);
        $itemsPerPage = 5;
        $totalPages = ceil($totalItems / $itemsPerPage);
        $currentPage = $this->request->getVar('page') ? $this->request->getVar('page') : 1;

        // Slice the array based on the current page
        $offset = ($currentPage - 1) * $itemsPerPage;
        $usuarios = array_slice($usuarios, $offset, $itemsPerPage);

        return view('usuarios', [
            'usuarios' => $usuarios,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
            'searchTerm' => $searchTerm
        ]);
    }

    public function delete($id)
    {
        if ($this->usuarioModel->delete($id)) {
            $data['message'] = 'Usuario excluido com sucesso!';
            $data['type'] = 'success';
        } else {
            $data['message'] = 'Erro!';
            $data['type'] = 'error';
        }

        // recarrega os usuários do banco de dados
        $usuarios = $this->usuarioModel->select('id, nome, matricula, perfil')->orderBy('id', 'DESC')->limit(5)->get()->getResult();
        $usuarios = json_decode(json_encode($usuarios), true);

        // Pagination variables
        $totalItems = count($usuarios);
        $itemsPerPage = 5;
        $totalPages = ceil($totalItems / $itemsPerPage);
        $currentPage = $this->request->getVar('page') ? $this->request->getVar('page') : 1;

        // Slice the array based on the current page
        $offset = ($currentPage - 1) * $itemsPerPage;
        $usuarios = array_slice($usuarios, $offset, $itemsPerPage);

        return view('usuarios', [
            'usuarios' => $usuarios,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
            'message' => $data['message'],
            'type' => $data['type']
        ]);
    }


    public function create()
    {

        return view('formcreate');
    }

    public function storeCreate()
    {
        $matricula = $this->request->getPost('matricula');

        $buscamatricula = $this->createModel->where('matricula', $matricula)->first();

        if ($buscamatricula) {
            $data['message_erro'] = 'Matrícula já existente!';
        } else {
            if ($this->createModel->save($this->request->getPost())) {
                $data['message'] = 'Usuário criado com sucesso!';
                $data['type'] = 'success';
            } else {
                $data['message'] = 'Erro ao criar usuário!';
                $data['type'] = 'error';
            }
        }

        return view('formcreate', $data);
    }



    public function storeEdit()
    {

        if ($this->createModel->save($this->request->getPost())) {
            $data['message'] = 'Salvo com sucesso!';
            $data['type'] = 'success';
        } else {
            $data['message'] = 'Erro!';
            $data['type'] = 'error';
        }

        return view('formedit', $data);
    }


    public function edit($id)
    {

        return view('formedit', ['usuarios' => $this->usuarioModel->find($id)]);
    }
}
