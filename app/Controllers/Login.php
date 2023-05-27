<?php

namespace App\Controllers;


use App\Controllers\BaseController;


class Login extends BaseController
{
	public function index()
	{
    $data['msg'] = '';

    if ($this->request->getMethod() === 'post') {
        $matricula = $this->request->getPost('matricula');
        $senha = $this->request->getPost('senha');

        $usuarioModel = model('UsuarioModel');
        $buscaUsuario = $usuarioModel->where('matricula', $matricula)->first();

        if ($buscaUsuario) {
			if (password_verify($senha, $buscaUsuario->senha)) {
				// Login válido, salvar dados na sessão
				$this->session->set('id_usuario', $buscaUsuario->id);
				$this->session->set('nome', $buscaUsuario->nome);
				$this->session->set('perfil', $buscaUsuario->perfil);
				return redirect()->to('menu'); // Redirecionar para a página restrita
			} else {
				// Senha incorreta
				$data['msg'] = 'Senha incorreta!';
			}
		} else {
			// Usuário não encontrado
			$data['msg'] = 'Matricula não encontrado!';
		}
		
    }

    return view('login', $data);
	}

}


