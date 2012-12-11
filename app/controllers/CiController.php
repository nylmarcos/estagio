<?php

class CiController extends AdminController {

    public function index($p = 1) {
        $s = isset($_GET['s']) ? $_GET['s'] : '';
        $unidades = Unidade::listar($p, $s);
        $this->_set('unidades', $unidades);
        $this->_set('s', $s);
        return $this->_view();
    }

    public function cadastrar() {

        return $this->_view();
    }

    public function editar() {
    }


    public function visualizar($id) {
        $unidade = Unidade::get($id);
        if ($unidade) {
            $usuarios = Viewusuariounidade::getAllByIdUnidade($id);
            $this->_set('unidade', $unidade);
            $this->_set('usuarios', $usuarios);
        } else {
            $this->_flash('erro', 'Unidade não encontrada!');
        }
        return $this->_view();
    }
}