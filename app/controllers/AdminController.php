<?php

class AdminController extends Controller {

	/**
	 * @Master("admin")
	 * @Auth("admin","usuario")
	 */
	public function __construct() {
		
	}

	public function configuracao() {
		$usuario = Usuario::get(Session::get('usuario')->Id);
		$aba = 'padrao';
		if (is_post) {
			if ($_POST['Salvar'] == "Alterar") {
				$aba = 'senha';
				$u = Usuario::logar(Session::get('usuario')->Login_Email, $_POST['SenhaAtual']);
				if ($u) {
					if ($_POST['NovaSenha'] == $_POST['CNovaSenha']) {
						try {
							$u->Senha = $_POST['NovaSenha'];
							Usuario::salvar($u);
							$this->_flash('alert alert-success fade in', 'Senha do usuário alterada com sucesso');
						} catch (Exception $e) {
							$this->_flash('alert alert-error fade in', 'Ocorreu um erro ao tentar alterar a senha do usuário');
						}
					} else {
						$this->_flash('alert alert-error fade in', 'O campo Nova Senha e Confirmar Nova Senha devem ser iguais');
					}
				} else {
					$this->_flash('alert alert-error fade in', 'Senha atual do usuário não confere');
				}
			} else {
				$aba = 'notificacao';

				$usuario->ReceberEmailNovaCI = isset($_POST['ReceberEmailNovaCI']) ? 1 : 0;
				$usuario->ReceberEmailNovaObs = isset($_POST['ReceberEmailNovaObs']) ? 1 : 0;




				try {
					Usuario::salvar($usuario);
					$this->_flash('alert alert-success fade in', 'Opções de notificações salvas com sucesso');
				} catch (Exception $e) {
					$this->_flash('alert alert-error fade in', 'Ocorreu um erro ao tentar salvar as opções de notificações');
				}
			}
		}
		$this->_set('usuario', $usuario);
		$this->_set('aba', $aba);
		return $this->_view();
	}

	/** @Auth("*") */
	public function login() {
		if (Auth::isLogged())
			$this->_redirect('~/unidade');

		if (is_post) {

			$form = $this->_data();
			$usuario = Usuario::logar($form->oab, $form->senha);
			if ($usuario) {
				if ($usuario->Bloqueado == 1) {
					$this->_flash('alert alert-error fade in', 'Usuário bloqueado');
				} else {
					Auth::set($usuario->EhAdmin == 1 ? "admin" : "usuario");
					Session::set('usuario', $usuario);
					$url = '~/ci/rascunho';
					if (isset($_GET['forwarded']))
						$url = '~/' . $_GET['forwarded'];
					$this->_redirect($url);
				}
			} else {
				$this->_flash('alert alert-error fade in', 'Login ou Senha incorreta!');
			}
		}
		return $this->_view();
	}

	public function sair() {
		Auth::clear();
		Session::clear();
		$this->_redirect('~/admin/login');
	}

}