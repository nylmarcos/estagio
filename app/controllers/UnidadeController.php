<?php

class UnidadeController extends Controller {
	
	/**
	* @Master("admin")
	* @Auth("admin")
	*/
	public function __construct()
	{
	}
    public function index($p = 1) {
        $s = isset($_GET['s']) ? $_GET['s'] : '';
        $unidades = Unidade::listar($p, $s);
        $this->_set('unidades', $unidades);
        $this->_set('s', $s);
        return $this->_view();
    }

    public function cadastrar() {
        $unidade = new Unidade();

        if (is_post) {
            $unidade = $this->_data(new Unidade());
            try {
                Unidade::salvar($unidade);
                $this->_flash('alert alert-info fade in', 'Unidade cadastrada com sucesso');
                $this->_redirect('~/unidade/');
            } catch (ValidationException $e) {
                $this->_flash('alert alert-error fade in', $e->getMessage());
            } catch (Exception $e) {
                //pre($e);
                $this->_flash('alert alert-error fade in', 'Ocorreu um erro ao tentar cadastrar a unidade');
            }
        }
        $this->_set('unidade', $unidade);
        return $this->_view();
    }

    public function editar($id) {
        $unidade = Unidade::get($id);
        if ($unidade) {
            if (is_post) {
                try {
                    $unidade = $this->_data($unidade);
                    Unidade::salvar($unidade);
                    $this->_flash('alert alert-success fade in', 'Unidade alterada com sucesso');
                    $this->_redirect('~/unidade/');
                } catch (ValidationException $e) {
                    $this->_flash('alert alert-error fade in', $e->getMessage());
                } catch (Exception $e) {
                    $this->_flash('alert alert-error fade in', 'Ocorreu um erro ao tentar editar a unidade');
                }
            }
            $this->_set('unidade', $unidade);
            return $this->_view('cadastrar');
        }
        return $this->_snippet('notfound');
    }

    public function excluir($id) {
        $unidade = Unidade::get($id);
        if ($unidade) {
            try {
                Unidade::excluir($unidade);
				Usuariounidade::excluirAllByIdUnidade($id);
                $this->_flash('alert alert-success fade in', 'Unidade excluída com sucesso!');
                $this->_redirect('~/unidade/');
            } catch (Exception $e) {
                //pre($e);
                $this->_flash('alert alert-error fade in', 'Erro ao tentar excluir unidade!');
            }
        } else {
            $this->_flash('alert alert-error fade in', 'Unidade não encontrada!');
        }
       $this->_redirect('~/unidade/');
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

    public function excluir_vinculo($idUsuarioUnidade) {
        $usuariounidade = Usuariounidade::get($idUsuarioUnidade);
        if ($usuariounidade) {
            try {
                Usuariounidade::excluir($usuariounidade);
                $this->_flash('alert alert-success fade in', 'Vinculo excluído com sucesso!');
                $this->_redirect('~/unidade/');
            } catch (Exception $e) {
                $this->_flash('erro', 'Erro ao tentar excluir Vinculo!');
            }
        } else {
            $this->_flash('erro', 'Vinculo não encontrada!');
        }
        return $this->_view();
    }
	public function alterar_permissao($idUsuarioUnidade) {
        $usuariounidade = Usuariounidade::get($idUsuarioUnidade);
        if ($usuariounidade) {
            try {
					$usuariounidade->Permissao = $usuariounidade->Permissao == 2 ? 3 : 2;
					Usuariounidade::salvar($usuariounidade);
					$this->_flash('alert alert-success fade in', 'Permissão alterada com sucesso!');
					$this->_redirect('~/unidade/visualizar/'.$usuariounidade->IdUnidade);
            } catch (Exception $e) {
                $this->_flash('erro', 'Erro ao tentar alterar a permissão!');
            }
        } else {
            $this->_flash('erro', 'Vinculo não encontrada!');
        }
    }

}