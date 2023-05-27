<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;

class Menu extends BaseController
{

    public function index()
    {
        return view('menu', ['perfil' => $this->session->get('perfil'), 'nome' => $this->session->get('nome'), 'id_usuario' => $this->session->get('id_usuario')]);
        
    }
}

?>
