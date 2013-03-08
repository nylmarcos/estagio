<?php

class UsuarioController extends Controller {

	/**
	* @Master("admin")
	* @Auth("admin")
	*/
	public function __construct()
	{
	}
	public function index($p = 1) {
		$s = isset($_GET['s']) ? $_GET['s'] : '';
		$usuarios = Usuario::listar($p, $s);
		$this->_set('usuarios', $usuarios);

		$this->_set('s', $s);
		return $this->_view();
	}
	

	public function cadastrar() {
		$usuario = new Usuario();
		if (is_post) {
			$form = $this->_data();
			try {

				if ($form->Senha == $form->ConfirmarSenha) {
					$usuario = $this->_data(new Usuario());
					$usuario->Bloqueado = 0;
					Usuario::salvar($usuario);
					$this->_flash('alert alert-info fade in', 'Usuário cadastrado com sucesso');
					$this->_redirect('~/usuario/');
				} else {
					$this->_flash('alert alert-error fade in', "Os campos Senha e Confirmar Senha devem ser iguais");
				}
			} catch (ValidationException $e) {
				$this->_flash('alert alert-error fade in', $e->getMessage());
			} catch (Exception $e) {
				//pre($e);
				$this->_flash('alert alert-error fade in', 'Ocorreu um erro ao tentar salvar o usuário');
			}
		}
		$this->_set('usuario', $usuario);
		return $this->_view();
	}
	public function alterar_permissao_sistema($id){
		$usuario = Usuario::get($id);
		if ($usuario) {
			$usuario->EhAdmin = $usuario->EhAdmin == 1 ? 0 : 1;
			Usuario::salvar($usuario);
			$this->_flash('alert alert-success fade in', 'Permissão do usuário no sistema foi alterada com sucesso');
		}
		else{
			$this->_flash('alert alert-error fade in', 'Ocorreu um erro ao tentar alterar a permissão do usuario no sistema');
		}
		$this->_redirect('~/usuario/');
	}
	public function editar($id) {
		$usuario = Usuario::get($id);
		if ($usuario) {
			if (is_post) {
				$form = $this->_data();
				if ($form->Senha == null || $form->Senha == $form->ConfirmarSenha) {
					$usuario->Nome = $form->Nome;
					$usuario->Login_Email = $form->Login_Email;
					$usuario->Cargo = $form->Cargo;
					$usuario->EhAdmin = (int) $form->EhAdmin;
					if ($form->Senha)
						$usuario->Senha = $form->Senha;
					try {
						Usuario::salvar($usuario);
						$this->_flash('alert alert-success fade in', 'Usuário alterado com sucesso');
						$this->_redirect('~/usuario/');
					} catch (ValidationException $e) {
						$this->_flash('alert alert-error fade in', $e->getMessage());
					} catch (Exception $e) {
						$this->_flash('alert alert-error fade in', 'Ocorreu um erro ao tentar alterar a usuário');
					}
				}
			}
			$this->_set('usuario', $usuario);
			return $this->_view('cadastrar');
		}
		return $this->_snippet('notfound');
	}

	public function excluir($id) {
		$usuario = Usuario::get($id);
		if ($usuario) {
			try {
				Usuario::excluir($usuario);
				$this->_flash('alert alert-success fade in', 'Usuário excluído com sucesso');
				$this->_redirect('~/usuario/');
			} catch (Exception $e) {
				pre($e);
				$this->_flash('alert alert-error fade in', 'Erro ao tentar excluir usuario');
			}
		} else {
			$this->_flash('alert alert-error fade in', 'Usuário não encontrado');
		}
		$this->_redirect('~/usuario/');
	}

	public function vincular($idUnidade, $idUsuario, $permissao) {
		try {

			$usuariounidade = new Usuariounidade();
			$usuariounidade->IdUnidade = (int)$idUnidade;
			$usuariounidade->IdUsuario = (int)$idUsuario;
			$usuariounidade->Permissao = (int)$permissao;
			Usuariounidade::salvar($usuariounidade);
			$this->_flash('alert alert-info fade in', 'Vinculo criado com sucesso!');
			$this->_redirect('~/usuario/v/'.$idUsuario);
		} catch (Exception $e) {
			pre($e);
			$this->_flash('erro', 'Erro ao tentar vincular');
			$this->_redirect('~/usuario/v/'.$idUsuario);
		}
	}

	public function v($idUsuario, $p = 1) {
		$usuario = Usuario::get($idUsuario);
		if ($usuario) {
			$s = isset($_GET['s']) ? $_GET['s'] : '';
			$unidades = Viewusuariounidade::listar($idUsuario,$p, $s);
			$this->_set('s', $s);
			$this->_set('usuario', $usuario);
			$this->_set('unidades', $unidades);
		} else {
			$this->_flash('erro', 'Usuario não encontrado');
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
				$this->_redirect('~/usuario/v/' . $usuariounidade->IdUsuario);
			} catch (Exception $e) {
				$this->_flash('erro', 'Erro ao tentar alterar a permissão!');
			}
		} else {
			$this->_flash('erro', 'Vinculo não encontrada!');
		}
	}
	public function excluir_vinculo($idUsuarioUnidade) {
        $usuariounidade = Usuariounidade::get($idUsuarioUnidade);
        if ($usuariounidade) {
            try {
                Usuariounidade::excluir($usuariounidade);
                $this->_flash('alert alert-success fade in', 'Vinculo excluído com sucesso!');
                $this->_redirect('~/usuario/v/' . $usuariounidade->IdUsuario);
            } catch (Exception $e) {
				
                $this->_flash('erro', 'Erro ao tentar excluir Vinculo!');
            }
        } else {
            $this->_flash('erro', 'Vinculo não encontrada!');
        }
        return $this->_view();
    }
	public function bloquear_desbloquear($idUsuario) {
		$usuario = Usuario::get($idUsuario);
		if ($usuario) {
			try {
				$usuario->Bloqueado = $usuario->Bloqueado ? 0 : 1;
				Usuario::salvar($usuario);
				if($usuario->Bloqueado){
					$this->_flash('alert alert-success fade in', 'Usuário bloqueado com sucesso!');
				}else{
					$this->_flash('alert alert-success fade in', 'Usuário desbloqueado com sucesso!');
				}
				
				$this->_redirect('~/usuario');
			} catch (Exception $e) {
				$this->_flash('erro', 'Erro ao tentar bloquear ou desbloquear usuário!');
			}
		} else {
			$this->_flash('erro', 'Usuário não encontrado!');
		}
	}
}