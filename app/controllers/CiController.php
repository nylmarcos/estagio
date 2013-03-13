<?php

date_default_timezone_set('America/Araguaina');

class CiController extends AdminController {

	public function modalvisualizar($id) {
		$ci = Ci::get($id);
		//echo ($ci->Conteudo);
		//exit;
		return $this->_json($ci);
	}

	public function gerarpdf($idCi) {
		require_once("../helpers/dompdf/dompdf_config.inc.php");

		$ci = Viewci::get($idCi);
		if ($ci) {
			$html = '<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> <link rel="Stylesheet" type="text/css" href="' . ROOT_VIRTUAL . '/css/style-cipdf.css" /> </head>';
			for ($i = 1; $i <= 2; $i++) {
				$observacoes = Viewobservacao::allByCi($ci->Id);
				$html .= '<body><center> <b>' . $i . 'º Via </b> Data:' . date('d/m/Y H:i:s', time()) . '</center><table style="margin:auto;" class="bordasimples">' .
						'<tbody>' .
						'<tr>' .
						'<th rowspan=4><img src="' . ROOT_VIRTUAL . 'img/logo-ulbra.png" width="50%"/></th>' .
						'<td><b>Data: </b>' . date('d/m/Y', $ci->Data) . '</td>' .
						'</tr>
						<tr><td><b>Assunto: </b>' . $ci->Assunto . '</td></tr>' .
						'<tr><td><b>De: </b>' . $ci->NomeDe . ' </td></tr>' .
						'<tr><td><b>Para: </b>' . $ci->NomePara . '</td></tr>' .
						'<tr><td colspan="2">' . $ci->Conteudo . '<br><br>Atenciosamente, <br><br><center>' . $ci->NomeUsuarioAtenciosamente . '</center><center>' . $ci->CargoUsuarioAtenciosamente . '</center><br></td></tr>' .
						'</tbody>' .
						'</table >';
				if ($observacoes) {
					$html .= '<center><h3>Observações</h3></center><table style="margin:auto;" class="bordasimples" width="80%"> <tbody>';
					foreach ($observacoes as $ob) {
						$html .= '
						<tr>
						  <td>' . $ob->Nome . '  -  ' . date('d/m/Y H:i', $ob->Data) . '</td>
						  </tr><tr><td>' . $ob->Conteudo . '</td>
						</tr>';
					}
					$html .= '</table>';
				}
				$html .= '<br><br><hr><br>';
			}
			$html .='</body></html>';
			$dompdf = new DOMPDF();
			$dompdf->load_html($html);
			$dompdf->set_host('localhost');
			$dompdf->set_protocol('http://');
			$dompdf->render();
			$dompdf->stream("sample.pdf");
		} else {
			$this->_flash('alert alert-error fade in', 'CI não encontrada');
		}
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

	private static function get_modelo($modelo) {
		switch ($modelo) {
			case 2:
				return '<table style="border-collapse: collapse; border:1px solid #000;" width="100%">
			<tr style="border:1px solid #000;">
				<td style="border:1px solid #000;" colspan="2"><b>Solicitante: </b> <br /><br /></td>
				<td style="border:1px solid #000;" colspan="2"><b>Fone contato: </b> <br /><br /></td>
			</tr>
			<tr style="border:1px solid #000;">
				<td style="border:1px solid #000;" colspan="2"><b>Evento: </b> <br /><br /></td>
				<td style="border:1px solid #000;" colspan="2"><b>Nº participantes: </b> <br /><br /></td>
			</tr>
			<tr style="border:1px solid #000;">
				<td style="border:1px solid #000;">
					<b>Data:</b><br />
					Turno: M( ) V( ) N( )<br />
					Período: 1º( ) 2º( )
				</td>
				<td style="border:1px solid #000;">
					<b>Data:</b><br />
					Turno: M( ) V( ) N( )<br />
					Período: 1º( ) 2º( )
				</td>
				<td style="border:1px solid #000;">
					<b>Data:</b><br />
					Turno: M( ) V( ) N( )<br />
					Período: 1º( ) 2º( )
				</td>
				<td style="border:1px solid #000;">
					<b>Data:</b><br />
					Turno: M( ) V( ) N( )<br />
					Período: 1º( ) 2º( )
				</td>
			</tr>
			<tr style="border:1px solid #000;">
				<td style="border:1px solid #000;" colspan="4"><b>Software Utilizado na Apresentação: </b> <br /><br /></td>
			</tr>
			<tr style="border:1px solid #000;">
				<td style="border:1px solid #000;" colspan="2"><b>Email do solicitante: </b> <br /><br /></td>
				<td style="border:1px solid #000;" colspan="2"><b>Email do Secretário de Curso: </b> <br /><br /></td>
			</tr>
			<tr style="border:1px solid #000;">
				<td style="border:1px solid #000;" colspan="4">
					<b>Comentários: </b><br /><br />
				</td>
			</tr>
		</table>';
				break;
			case 3:
				return '<table style="border-collapse: collapse; border:1px solid #000;" width="100%">
				<tr style="border:1px solid #000;">
					<td style="border:1px solid #000;"><b>QUANT</b></td>
					<td style="border:1px solid #000;"><b>DISCRIMINAÇÃO DO MATERIAL </b> </td>
				</tr>
				<tr style="border:1px solid #000;">
					<td style="border:1px solid #000;"><br></td>
					<td style="border:1px solid #000;"><br></td>
				</tr>
				<tr style="border:1px solid #000;">
					<td style="border:1px solid #000;"><br></td>
					<td style="border:1px solid #000;"><br></td>
				</tr>
				<tr style="border:1px solid #000;">
					<td style="border:1px solid #000;"><br></td>
					<td style="border:1px solid #000;"><br></td>
				</tr>
				</table>';
				break;
			default:
				return '';
		}
	}

	public function cadastrar($modelo = 1) {
		$ci = new Ci();
		$html_modelo = self::get_modelo($modelo);
		$usuarios_u = null;
		if (is_post) {
			$form = $this->_data();

			try {
				$ci->Assunto = $_POST['Assunto'];
				$ci->Conteudo = strip_tags($_POST['Conteudo'], '<body><p><strong><br><em><ol><li><u><table><hr><a><br><tr><td><table><b>');
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

					$u_pertence = true;
					if ($ci->TipoPara == 0) {
						if (Usuariounidade::virificar_permissao($ci->IdPara, Session::get('usuario')->Id)) {
							$u_pertence = false;
						}
					}
					if ($u_pertence) {
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
								if ($ci->Enviado == 1) {
									$this->_flash('alert alert-success fade in', 'CI enviada com sucesso!');
									$this->_redirect('~/ci/enviadas');
								} else {
									$this->_flash('alert alert-success fade in', 'CI salva como rascunho!');
									$this->_redirect('~/ci/rascunho');
								}
							} else {
								$this->_flash('alert alert-error fade in', 'Os campos "Para" e "Autorização" não podem ser iguais!');
							}
						} else {
							$this->_flash('alert alert-error fade in', 'Os campos "Atenciosamente" e "Autorização" não podem ser iguais!');
						}
					} else {
						$this->_flash('alert alert-error fade in', 'O campo "Para" não pode ser uma unidade que você pussui vínculo!');
					}
				} else {
					$this->_flash('alert alert-error fade in', 'Os campos "De" e "Para" não podem ser iguais!');
				}
			} catch (ValidationException $e) {
				$this->_flash('alert alert-error fade in', $e->getMessage());
			} catch (Exception $e) {
				//pre($e);
				$this->_flash('alert alert-error fade in', 'Ocorreu um erro ao tentar salvar a ci!');
			}
			if ($ci->TipoPara == 0)
				$usuarios_u = Viewusuariounidade::allByIdUnidade((int) $IdDe_Tipo[0], 2);

			//print_r($ci);
			//exit;
		}

		$usuarios = Usuario::all();
		$unidades = Unidade::all();
		//print_r($usuarios);
		//exit;
		$m_unidades = Viewusuariounidade::allByIdUsuario(Session::get("usuario")->Id);
		$this->_set('html_modelo', $html_modelo);
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

					$u_pertence = true;
					if ($ci->TipoPara == 0) {
						if (Usuariounidade::virificar_permissao($ci->IdPara, Session::get('usuario')->Id)) {
							$u_pertence = false;
						}
					}
					if ($u_pertence) {

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
								if ($ci->Enviado == 1) {
									$this->_flash('alert alert-success fade in', 'CI enviada com sucesso!');
									$this->_redirect('~/ci/enviadas');
								} else {
									$this->_flash('alert alert-success fade in', 'CI salva como rascunho!');
									$this->_redirect('~/ci/rascunho');
								}
							} else {
								$this->_flash('alert alert-error fade in', 'Os campos "Atenciosamente" e "Autorização" não podem ser iguais!');
							}
						} else {
							$this->_flash('alert alert-error fade in', 'Os campos "De" e "Para" não podem ser iguais!');
						}
					} else {
						$this->_flash('alert alert-error fade in', 'O campo "Para" não pode ser uma unidade que você pussui vínculo!');
					}
				} catch (ValidationException $e) {
					$this->_flash('alert alert-error fade in', $e->getMessage());
				} catch (Exception $e) {
					pre($e);
					$this->_flash('alert alert-error fade in', 'Ocorreu um erro ao tentar editar a CI!');
				}
			}
			if ($ci->TipoPara == 0)
				$usuarios_u = Viewusuariounidade::allByIdUnidade($ci->IdDe, 2);
		}else {
			$this->_flash('alert alert-error fade in', 'CI não pode ser encontrada!');
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
					$this->_flash('alert alert-success fade in', 'CI exluída com sucesso!');
					$this->_redirect('~/ci/rascunho');
				} else {
					$this->_flash('alert alert-error fade in', 'CI NÃO PODE ser excluida!');
				}
			} else {
				throw new AuthException("Sem permissão", 403);
			}
		} else {
			$this->_flash('erro', 'CI não encontrada!');
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
					$this->_flash('alert alert-success fade in', 'CI enviada com sucesso!');
					$this->_redirect('~/ci/rascunho');
					// notificar por email
				} else {
					$this->_flash('alert alert-error fade in', 'CI NÃO PODE ser enviada!');
				}
			} else {
				throw new AuthException("Sem permissão", 403);
			}
		} else {
			$this->_flash('erro', 'CI não encontrada!');
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
				$this->_flash('alert alert-success fade in', 'Observação salva com sucesso!');
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
			$this->_flash('erro', 'CI não encontrada!');
		}
		return $this->_view();
	}

	public function autorizar_naoautorizar($acao, $idCi) {
		$ci = Ci::get($idCi);
		if ($ci) {
			if ($ci->IdUsuarioAutorizacao == Session::get('usuario')->Id) {
				if ($ci->Autorizado != 1 && $ci->Autorizado != 2) {
					$ci->Autorizado = (int) $acao;
					Ci::salvar($ci);
					$mensagem = $acao == 1 ? 'Ci autorizada com sucesso!' : 'Ci não autorizada com sucesso!';
					$this->_flash('alert alert-success fade in', $mensagem);
					//Enviar E-mail
				} else {
					$this->_flash('alert alert-error fade in', 'Depois que uma CI é Autorizada ou Não autorizado, não é permitido alterar');
				}
				$this->_redirect('~/ci/autoriza');
			}
		}
	}

	public function executada_naoexecutada($acao, $idCi) {

		$ci = Ci::get($idCi);

		if ($ci) {
			if ($ci->DataStatus == 0 || $ci->DataStatus == null) {
				$per = false;
				if ($ci->TipoPara == 0) {
					if (Usuariounidade::virificar_permissao($ci->IdPara, Session::get('usuario')->Id))
						$per = true;
				}else {
					if ($ci->IdPara == Session::get('usuario')->Id)
						$per = true;
				}
				if ($per) {
					$ci->IdUsuarioStatus = Session::get('usuario')->Id;
					$ci->DataStatus = time();
					$ci->Status = (int) $acao;
					try {
						Ci::salvar($ci);
						$mensagem = $acao == 1 ? 'CI marcada como EXECUTADA!' : 'CI marcada como NÃO EXECUTADA!';
						$this->_flash('alert alert-success fade in', $mensagem);

						$emails = '';
						if ($ci->ParaPara == 0) {
							$emails .= Viewusuariounidade::allEmail($ci->IdPara);
						} else {
							$emails .= Session::get('usuario')->Login_Email;
						}
						//Enviar E-mail		
					} catch (ValidationException $e) {
						$this->_flash('alert alert-error fade in', $e->getMessage());
					} catch (Exception $e) {
						//pre($e);
						$this->_flash('alert alert-error fade in', 'Ocorreu um erro');
					}

					$this->_redirect('~/ci/recebidas');
				} else {
					throw new AuthException("Sem permissão", 403);
				}
			}else{
				$this->_flash('alert alert-error fade in', 'O Status da CI não pode ser alterado mais de uma vez!');
			}
		} else {
			$this->_flash('alert alert-error fade in', 'CI não encontrada!');
		}
		$this->_redirect('~/ci/recebidas');
	}

}