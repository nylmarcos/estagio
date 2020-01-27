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
				$u = Usuario::logar(Session::get('usuario')->Login_Email, sha1($_POST['SenhaAtual']));
				if ($u) {
					if ($_POST['NovaSenha'] == $_POST['CNovaSenha']) {
						try {
							$u->Senha = sha1($_POST['NovaSenha']);
							Usuario::salvar($u);
							$this->_flash('alert alert-success fade in', 'Senha do usuário alterada com sucesso');
						} catch (Exception $e) {
							$this->_flash('alert alert-error fade in', 'Ocorreu um erro ao tentar alterar a senha do usuário!');
						}
					} else {
						$this->_flash('alert alert-error fade in', 'O campo Nova Senha e Confirmar Nova Senha devem ser iguais!');
					}
				} else {
					$this->_flash('alert alert-error fade in', 'Senha atual do usuário não confere!');
				}
			} else {
				$aba = 'notificacao';
				$usuario->ReceberEmail = isset($_POST['ReceberEmail']) ? 1 : 0;
				$usuario->Telefone = $_POST['Telefone'];
				$usuario->Nome = $_POST['Nome'];
				$usuario->Cargo = $_POST['Cargo'];
				try {
					Usuario::salvar($usuario);
					$this->_flash('alert alert-success fade in', 'Opções de notificações salvas com sucesso!');
				} catch (Exception $e) {
					$this->_flash('alert alert-error fade in', 'Ocorreu um erro ao tentar salvar as opções de notificações!');
				}
			}
		}
		$this->_set('usuario', $usuario);
		$this->_set('aba', $aba);
		return $this->_view();
	}

	/** @Auth("*") */
	public function login() {
		$client = new Google_Client();
		$client->setApplicationName("Ceulp/Ulbra - CI");
		$client->setClientId('97042401106-o2lclrbkfato9gf2pnbo8v78vu939fus.apps.googleusercontent.com');
		$client->setClientSecret('');
		$client->setRedirectUri('http://localhost/estagio/admin/login');
		$client->setDeveloperKey('97042401106-o2lclrbkfato9gf2pnbo8v78vu939fus@developer.gserviceaccount.com');
		$oauth2 = new Google_Oauth2Service($client);

		if (isset($_GET['code'])) {
			$client->authenticate($_GET['code']);
			$_SESSION['token'] = $client->getAccessToken();
			Session::set('token', $client->getAccessToken());
			$user = $oauth2->userinfo->get();
			//print_r($user);
			if (isset($user["hd"]) && $user["hd"] == "ceulp.edu.br") {

				$usuario = Usuario::getByEmail($user["email"]);
				if ($usuario) {
					if(md5("google_ceulp.edu.br_".$user["email"]) != $usuario->Senha){
						$usuario->Senha = md5("google_ceulp.edu.br_".$user["email"]);
						$usuario->Nome = $user["name"];
						Usuario::salvar($usuario);
						$usuario = Usuario::get($usuario->Id);
					}
					if ($usuario->Bloqueado == 1) {
						$authUrl = $client->createAuthUrl();
						$this->_flash('alert alert-error fade in', 'Sua conta foi bloqueada pelo Administrador do Sistema!'); //Usuário bloqueado!
					} else {
						Auth::set($usuario->EhAdmin == 1 ? "admin" : "usuario");
						Session::set('usuario', $usuario);
						$url = '~/ci/rascunho';
						if (isset($_GET['forwarded']) && $_GET['forwarded'] != '')
							$url = '~/' . $_GET['forwarded'];

						$this->_redirect($url);
					}
				} else {
					$usuarionovo = new Usuario();
					$usuarionovo->Nome = $user["name"];
					$usuarionovo->Login_Email = $user["email"];
					$usuarionovo->Telefone = "(63)0000-0000";
					$usuarionovo->Cargo = "Colocar Cargo";
					$usuarionovo->EhAdmin = 0;
					$usuarionovo->Senha = md5("google_ceulp.edu.br_".$user["email"]);
					$usuarionovo->ReceberEmail = 0;
					$usuarionovo->Bloqueado = 0;
					Usuario::salvar($usuarionovo);
					$u = Usuario::getByEmail($usuarionovo->Login_Email);
					Auth::set($usuarionovo->EhAdmin == 1 ? "admin" : "usuario");
					Session::set('usuario', $u);
					$url = '~/ci/rascunho';
					if (isset($_GET['forwarded']) && $_GET['forwarded'] != '')
						$url = '~/' . $_GET['forwarded'];
					$this->_redirect($url);
				}
			}else {
				$authUrl = $client->createAuthUrl();
				$this->_flash('alert alert-error fade in', 'Apenas contas do domínio <b>@ceulp.edu.br</b> possui permissão para acessar este aplicativo!'); //Usuário do gmail
				$this->_redirect('~/admin/login');
			}
		} else {
			$authUrl = $client->createAuthUrl();
		}
		if (Auth::isLogged())
			$this->_redirect('~/unidade');

		if (is_post) {
			$form = $this->_data();
			$usuario = Usuario::logar($form->email, sha1($form->senha));
			if ($usuario) {
				if ($usuario->Bloqueado == 1) {
					$this->_flash('alert alert-error fade in', 'Sua conta foi bloqueada pelo Administrador do Sistema!'); //Usuário bloqueado!
				} else {
					Auth::set($usuario->EhAdmin == 1 ? "admin" : "usuario");
					Session::set('usuario', $usuario);
					$url = '~/ci/rascunho';
					if (isset($_GET['forwarded']) && $_GET['forwarded'] != '')
						$url = '~/' . $_GET['forwarded'];
					$this->_redirect($url);
				}
			} else {
				$this->_flash('alert alert-error fade in', 'Login ou Senha incorreta!');
			}
		}
		$this->_set('authUrl', $authUrl);
		return $this->_view();
	}

	public function sair() {
		Auth::clear();
		Session::clear();
		$this->_redirect('~/admin/login');
	}

}
