<?php

class CiController extends AdminController {

	public function autorizacao($p = 1) {
		$s = isset($_GET['s']) ? $_GET['s'] : '';
		$unidades = Ci::listar($p, $s);
		$this->_set('unidades', $unidades);
		$this->_set('s', $s);
		return $this->_view();
	}

	public function modalvisualizar($id) {
		$ci = Ci::get($id);
		//echo ($ci->Conteudo);
		//exit;
		return $this->_json($ci);
	}

	public function gerarpdf($idCi) {
		require_once("../vendors/dompdf/dompdf_config.inc.php");

		$ci = Viewci::get($idCi);
		$html =
				'<html><body>' .
				'<p>Put your html here, or generate it with your favourite ' .
				'templating system.</p>' .
				'</body></html>';

		$dompdf = new DOMPDF();
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream("sample.pdf");
		exit;
	}

	public function rascunho($p = 1) {
		$s = isset($_GET['s']) ? $_GET['s'] : null;
		$i = isset($_GET['i']) ? $_GET['i'] : null;
		$f = isset($_GET['f']) ? $_GET['f'] : null;
		$cis_rascunho = Viewci::allRascunho(Session::get('usuario')->Id, $p, $s, $i, $f);


		$this->_set('s', isset($_GET['s']) ? $_GET['s'] : '');
		$this->_set('i', $i);
		$this->_set('f', $f);
		$this->_set('cis', $cis_rascunho);
		return $this->_view();
	}

	public function autoriza($p = 1) {

		$s = isset($_GET['s']) ? $_GET['s'] : null;
		$i = isset($_GET['i']) ? $_GET['i'] : null;
		$f = isset($_GET['f']) ? $_GET['f'] : null;
		$cis_autorizacao = Viewci::allAutorizacaoByUsuario(Session::get('usuario')->Id, $p, $s, $i, $f);

		$this->_set('s', isset($_GET['s']) ? $_GET['s'] : '');
		$this->_set('i', $i);
		$this->_set('f', $f);
		$this->_set('cis_autorizacao', $cis_autorizacao);
		return $this->_view('autorizacao');
	}

	public function recebidas($p = 1) {

		$s = isset($_GET['s']) ? $_GET['s'] : null;
		$i = isset($_GET['i']) ? $_GET['i'] : null;
		$f = isset($_GET['f']) ? $_GET['f'] : null;
		$cis_resposta_r = Viewci::allRecebida(Session::get('usuario')->Id, $p, $s, $i, $f);


		$this->_set('s', isset($_GET['s']) ? $_GET['s'] : '');
		$this->_set('i', $i);
		$this->_set('f', $f);
		$this->_set('cis_resposta_r', $cis_resposta_r);
		return $this->_view();
	}

	public function enviadas($p = 1) {

		$s = isset($_GET['s']) ? $_GET['s'] : null;
		$i = isset($_GET['i']) ? $_GET['i'] : null;
		$f = isset($_GET['f']) ? $_GET['f'] : null;
		$cis_resposta_v = Viewci::allEnviada(Session::get('usuario')->Id, $p, $s, $i, $f);


		$this->_set('s', isset($_GET['s']) ? $_GET['s'] : '');
		$this->_set('i', $i);
		$this->_set('f', $f);
		$this->_set('cis_resposta_v', $cis_resposta_v);
		return $this->_view();
	}

	public function index($p = 1) {
		$s = isset($_GET['s']) ? $_GET['s'] : '';
		$cis = Ci::listar(1, Session::get('usuario')->Id, $p, $s);
		$this->_set('cis', $cis);
		$this->_set('s', $s);
		return $this->_view();
	}

	public function todas($p = 1) {
		$s = isset($_GET['s']) ? $_GET['s'] : '';
		$cis = Viewci::listar(1, Session::get('usuario')->Id, $p, $s);
		$this->_set('cis', $cis);
		$this->_set('s', $s);
		return $this->_view();





		/* $s = isset($_GET['s']) ? $_GET['s'] : '';
		  $cis = Ci::listar(1, $p, $s);
		  $this->_set('cis', $cis);
		  $this->_set('s', $s);
		  return $this->_view(); */
	}

	public function cadastrar() {
		$ci = new Ci();
		$usuarios_u = null;
		if (is_post) {
			$form = $this->_data();

			try {
				$ci->Assunto = $_POST['Assunto'];
				$ci->Conteudo = strip_tags($_POST['Conteudo'],'<body><p><strong><br><em><ol><li><u><table><hr><a><br></td><td><table>');
				$ci->Data = time();
				$ci->IdUsuarioAutor = Session::get('usuario')->Id;
				$ci->IdUsuarioAutorizacao = $_POST['IdUsuarioAutorizacao'] != '-1' ? (int) $_POST['IdUsuarioAutorizacao'] : NULL;
				$IdDe_Tipo = explode('-', $_POST['IdDe']);

				$ci->IdDe = (int) $IdDe_Tipo[0];
				$ci->TipoDe = (int) $IdDe_Tipo[1];
				if ($_POST['IdDe'] != $_POST['IdPara']) {



					$IdPara_Tipo = explode('-', $_POST['IdPara']);

					$ci->IdPara = (int) $IdPara_Tipo[0];
					$ci->TipoPara = (int) $IdPara_Tipo[1];

					$ci->IdUsuarioAtenciosamente = (int) $form->IdUsuarioAtenciosamente;

					if ($ci->IdUsuarioAutorizacao != $ci->IdUsuarioAtenciosamente) {
						if (!($ci->TipoPara == 1 && $ci->IdUsuarioAutorizacao == $ci->IdPara)) {
							if ($_POST['Salvar'] == 'Salvar') {
								$ci->Enviado = 0;
							} else {
								if ($ci->IdUsuarioAtenciosamente == Session::get('usuario')->Id) {
									$ci->Enviado = 1;
									$n = Ci::get_ultima_ci($ci);
									$ci->Numero = ++$n;
								} else {
									throw new AuthException("Sem permissão", 403);
								}
							}
							Ci::salvar($ci);
							$this->_flash('alert alert-info fade in', 'Ci cadastrada com sucesso');
							//$this->_redirect('~/ci/');
						} else {
							$this->_flash('alert alert-error fade in', 'Os campos "Para" e "Autorização" não podem ser iguais');
						}
					} else {
						$this->_flash('alert alert-error fade in', 'Os campos "Atenciosamente" e "Autorização" não podem ser iguais');
					}
				} else {
					$this->_flash('alert alert-error fade in', 'Os campos "De" e "Para" não podem ser iguais');
				}
			} catch (ValidationException $e) {
				$this->_flash('alert alert-error fade in', $e->getMessage());
			} catch (Exception $e) {
				//pre($e);
				$this->_flash('alert alert-error fade in', 'Ocorreu um erro ao tentar salvar a ci');
			}
			if ($ci->TipoPara == 0)
				$usuarios_u = Viewusuariounidade::allByIdUnidade((int) $IdDe_Tipo[0], 2);

			//print_r($ci);
			//exit;
		}

		$usuarios = Usuario::all();
		$unidades = Unidade::all();
		$m_unidades = Viewusuariounidade::allByIdUsuario(Session::get("usuario")->Id);
		$this->_set('usuarios_u', $usuarios_u);
		$this->_set('usuarios', $usuarios);
		$this->_set('unidades', $unidades);
		$this->_set('m_unidades', $m_unidades);

		$this->_set('ci', $ci);
		return $this->_view();
	}

	public function get_adm_unidade($idUnidade) {
		$usuarios_a = Viewusuariounidade::allByIdUnidade($idUnidade, 2);
		$resultado = new stdClass();
		$resultado->Conteudo = '';
		if (count($usuarios_a) == 1) {
			$resultado->Conteudo .= '<option value="' . $usuarios_a[0]->IdUsuario . '" selected="selected">' . $usuarios_a[0]->NomeUsuario . '</option>';
		} else {
			$resultado->Conteudo .= '<option value="" selected="selected">Selecione</option>';
			foreach ($usuarios_a as $usuario) {

				$resultado->Conteudo .= '<option value="' . $usuario->IdUsuario . '">' . $usuario->NomeUsuario . '</option>';
			}
		}
		$resultado->Quantidade = count($usuarios_a);
		return $this->_json($resultado);
	}

	public function editar($id) {
		$ci = Ci::get($id);
		$usuarios_u = null;
		if ($ci) {
			if ($ci->Enviado == 1)
				throw new AuthException("Sem permissão", 403);
			if (is_post) {
				$form = $this->_data();
				try {
					$ci->Assunto = $_POST['Assunto'];
					$ci->Conteudo = $_POST['Conteudo'];
					$ci->Data = time();

					$ci->IdUsuarioAutor = Session::get('usuario')->Id;
					$ci->IdUsuarioAutorizacao = $_POST['IdUsuarioAutorizacao'] != '-1' ? (int) $_POST['IdUsuarioAutorizacao'] : NULL;
					$IdDe_Tipo = explode('-', $_POST['IdDe']);
					if ($_POST['IdDe'] != $_POST['IdPara']) {
						$ci->IdDe = (int) $IdDe_Tipo[0];
						$ci->TipoDe = (int) $IdDe_Tipo[1];
						$IdPara_Tipo = explode('-', $_POST['IdPara']);

						$ci->IdPara = (int) $IdPara_Tipo[0];
						$ci->TipoPara = (int) $IdPara_Tipo[1];
						$ci->IdUsuarioAtenciosamente = (int) $_POST['IdUsuarioAtenciosamente'];
						if ($ci->IdUsuarioAutorizacao != $ci->IdUsuarioAtenciosamente) {
							if ($_POST['Salvar'] == 'Salvar') {
								$ci->Enviado = 0;
							} else {
								if ($ci->IdUsuarioAtenciosamente == Session::get('usuario')->Id) {
									$ci->Enviado = 1;
									$n = Ci::get_ultima_ci($ci);
									$ci->Numero = ++$n;
								} else {
									throw new AuthException("Sem permissão", 403);
								}
							}
							Ci::salvar($ci);
							$this->_flash('alert alert-info fade in', 'Ci cadastrada com sucesso');
							$this->_redirect('~/ci/rascunho');
						} else {
							$this->_flash('alert alert-error fade in', 'Os campos "Atenciosamente" e "Autorização" não podem ser iguais');
						}
					} else {
						$this->_flash('alert alert-error fade in', 'Os campos "De" e "Para" não podem ser iguais');
					}
				} catch (ValidationException $e) {
					$this->_flash('alert alert-error fade in', $e->getMessage());
				} catch (Exception $e) {
					pre($e);
					$this->_flash('alert alert-error fade in', 'Ocorreu um erro ao tentar editar a ci');
				}
			}
			if ($ci->TipoPara == 0)
				$usuarios_u = Viewusuariounidade::allByIdUnidade($ci->IdDe, 2);
		}else {
			$this->_flash('alert alert-error fade in', 'Ci não pode ser encontrada');
			$this->_redirect('~/ci/rascunho');
		}
		//print_r($usuarios_u);
		//	exit;

		$unidades = Unidade::all();
		$usuarios = Usuario::all();
		$m_unidades = Viewusuariounidade::allByIdUsuario(Session::get("usuario")->Id);
		$this->_set('usuarios_u', $usuarios_u);
		$this->_set('usuarios', $usuarios);
		$this->_set('unidades', $unidades);
		$this->_set('m_unidades', $m_unidades);

		$this->_set('ci', $ci);
		return $this->_view('cadastrar');
	}

	public function excluir($id) {
		$ci = Ci::get($id);
		if ($ci) {
			if ($ci->IdUsuarioAtenciosamente == Session::get('usuario')->Id || $ci->IdUsuarioAutor == Session::get('usuario')->Id) {
				if ($ci->Enviado == 0) {
					Ci::excluir($ci);
					Observacao::excluirAllByCi($ci);
					$this->_flash('alert alert-info fade in', 'Ci exluída com sucesso');
					$this->_redirect('~/ci/rascunho');
				} else {
					$this->_flash('alert alert-error fade in', 'Ci não pode ser excluida  com sucesso');
				}
			} else {
				throw new AuthException("Sem permissão", 403);
			}
		} else {
			$this->_flash('erro', 'Ci não encontrada!');
		}
	}

	public function enviar($id) {
		$ci = Ci::get($id);
		if ($ci) {
			if ($ci->IdUsuarioAtenciosamente == Session::get('usuario')->Id) {
				if ($ci->Enviado == 0) {
					$ci->Data = time();
					$ci->Enviado = 1;
					$n = Ci::get_ultima_ci($ci);
					$ci->Numero = ++$n;
					Ci::salvar($ci);
					$this->_flash('alert alert-info fade in', 'Ci enviada com sucesso');
					$this->_redirect('~/ci/rascunho');
				} else {
					$this->_flash('alert alert-error fade in', 'Ci não pode ser enviada');
				}
			} else {
				throw new AuthException("Sem permissão", 403);
			}
		} else {
			$this->_flash('erro', 'Ci não encontrada!');
		}
		$this->_redirect('~/ci/rascunho');
	}

	private static function permissao(Viewci $ci) {
		if ($ci->IdUsuarioAtenciosamente == Session::get('usuario')->Id || $ci->IdUsuarioAutorizacao == Session::get('usuario')->Id) {
			return true;
		}
		if ($ci->TipoDe == 0) {
			if (Usuariounidade::virificar_permissao($ci->IdDe, Session::get('usuario')->Id)) {
				return true;
			}
		} else if ($ci->IdDe == Session::get('usuario')->Id) {
			return true;
		}
		if ($ci->TipoPara == 0) {
			if (Usuariounidade::virificar_permissao($ci->IdPara, Session::get('usuario')->Id)) {
				if (!$ci->IdUsuarioVisualizou) {
					$ci_u = Ci::get($ci->Id);
					$ci_u->IdUsuarioVisualizou = Session::get('usuario')->Id;
					$ci_u->DataVisualizou = time();
					Ci::salvar($ci_u);
				}
				return true;
			}
		} else if ($ci->IdPara == Session::get('usuario')->Id) {
			if (!$ci->IdUsuarioVisualizou) {
				$ci_u = Ci::get($ci->Id);
				$ci_u->IdUsuarioVisualizou = Session::get('usuario')->Id;
				$ci_u->DataVisualizou = time();
				Ci::salvar($ci_u);
			}
			echo 'd';
			return true;
		}

		return false;
	}

	public function visualizar($idCi) {
		$ci = Viewci::get($idCi);
		if (is_post) {
			$obs = $this->_data(new Observacao());
			$obs->IdCi = (int) $idCi;
			$obs->IdUsuario = Session::get('usuario')->Id;
			$obs->Data = time();
			$obs->Conteudo = trim($obs->Conteudo);
			try {
				Observacao::salvar($obs);
			} catch (ValidationException $e) {
				$this->_flash('alert alert-error fade in', $e->getMessage());
			} catch (Exception $e) {
				//pre($e);
				$this->_flash('alert alert-error fade in', 'Ocorreu um erro ao salvar a observação');
			}
		}
		if ($ci) {
			if (self::permissao($ci)) {
				$ci = Viewci::get($idCi);
				$observacoes = Viewobservacao::allByCi($ci->Id);

				$ci->NomeAtenciosamente = Usuario::get($ci->IdUsuarioAtenciosamente)->Nome; //Depois tem que adicionar na Viewci o Nome do Usuario
				$this->_set('ci', $ci);
				$this->_set('observacoes', $observacoes);
			} else {
				throw new AuthException("Sem permissão", 403);
			}
		} else {
			$this->_flash('erro', 'Ci não encontrada!');
		}
		return $this->_view();
	}

	public function autorizar_naoautorizar($acao, $idCi) {
		$ci = Ci::get($idCi);
		if ($ci) {
			if ($ci->IdUsuarioAutorizacao == Session::get('usuario')->Id) {
				$ci->Autorizado = (int) $acao;
				Ci::salvar($ci);
				$mensagem = $acao == 1 ? 'Ci autorizada com sucesso' : 'Ci não autorizada com sucesso';
				$this->_flash('alert alert-info fade in', $mensagem);
				$this->_redirect('~/ci/autoriza');
			}
		}
	}

	public function deferir_indeferir($acao, $idCi) {
		$ci = Ci::get($idCi);
		if ($ci) {
			if (Usuariounidade::virificar_permissao($ci->IdPara, Session::get('usuario')->Id)) {
				$ci->IdUsuarioStatus = Session::get('usuario')->Id;
				$ci->DataStatus = time();
				$ci->Status = (int)$acao;
				Ci::salvar($ci);
				$mensagem = $acao == 1 ? 'Ci deferida com sucesso' : 'Ci indefedida com sucesso';
				$this->_flash('alert alert-info fade in', $mensagem);
				$this->_redirect('~/ci/recebidas');
			}
		}else{
			$this->_flash('alert alert-error fade in', 'CI não encontrada');
		}
	}

}