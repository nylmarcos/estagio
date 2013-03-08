<?php

/** @View("viewusuariounidade") */
class Viewusuariounidade extends Model {

	/** @Column(Type="Int") */
	public $IdUsuarioUnidade;

	/** @Column(Type="Int") */
	public $IdUnidade;

	/** @Column(Type="Int") */
	public $IdUsuario;

	/** @Column(Type="Int") */
	public $Permissao;

	/** @Column(Type="Int") */
	public $UsuarioBloqueado;

	/** @Column(Type="Int") */
	public $ReceberEmail;

	/** @Column(Type="String") */
	public $NomeUnidade;

	/** @Column(Type="String") */
	public $EmailUnidade;

	/** @Column(Type="String") */
	public $TelefoneUnidade;

	/** @Column(Type="String") */
	public $NomeUsuario;

	/** @Column(Type="String") */
	public $EmailUsuario;

	/** @Column(Type="String") */
	public $TelefoneUsuario;

	/** @Column(Type="String") */
	public $CargoUsuario;

	public static function getAllByIdUnidade($IdUnidade) {
		$bd = Database::getInstance();
		return $bd->Viewusuariounidade->where('IdUnidade = ? AND IdUsuario IS NOT NULL', $IdUnidade)->all();
	}

	public static function listar($IdUsuario, $p, $s) {
		$bd = Database::getInstance();
		$p--;
		$p = ($p < 0 ? 0 : $p) * 10;
		$resultado = new stdClass;
		if ($s) {
			$resultado->Dados = $bd->viewusuariounidade->where('IdUsuario = ? OR IdUsuario IS NULL OR IdUnidade NOT IN (SELECT guu.IdUnidade FROM usuariounidade guu WHERE guu.IdUsuario = ?) AND NomeUnidade like ?', $IdUsuario, $IdUsuario, '%' . $s . '%')->limit(10, $p)->groupBy('IdUnidade')->orderby('NomeUnidade ASC')->all();
			$resultado->Total = count($resultado->Dados);
		} else {

			$resultado->Dados = $bd->Viewusuariounidade->where('IdUsuario = ? OR IdUsuario IS NULL OR IdUnidade NOT IN (SELECT guu.IdUnidade FROM usuariounidade guu WHERE guu.IdUsuario = ?)', $IdUsuario, $IdUsuario)->groupBy('IdUnidade')->limit(10, $p)->all();
			//Debug::show();
			//exit(var_dump($resultado));
			$resultado->Total = count($resultado->Dados);
		}
		return $resultado;
	}

	public static function allByIdUsuario($idUsuario, $permissao = NULL) {
		$bd = Database::getInstance();
		if ($permissao)
			return $bd->Viewusuariounidade->where('IdUsuario = ? AND Permissao', $idUsuario, $permissao)->all();
		else
			return $bd->Viewusuariounidade->where('IdUsuario = ?', $idUsuario)->all();
	}

	public static function allByIdUnidade($idUnidade, $permissao = NULL) {
		$bd = Database::getInstance();
		if ($permissao)
			return $bd->Viewusuariounidade->where('IdUnidade = ? AND Permissao = ?', $idUnidade, $permissao)->all();
		else
			return $bd->Viewusuariounidade->where('IdUnidade = ?', $idUnidade)->all();
	}

	public static function allEmail($IdUnidade) {
		$bd = Database::getInstance();
		$usuarios = $bd->Viewusuariounidade->where('IdUnidade = ? AND UsuarioBloqueado = ? AND ReceberEmail = ? ', $IdUnidade, 0, 1)->all();
		if ($usuarios) {
			$retorno = "";
			foreach ($usuarios as $u) {
				$retorno .= $u->Login_Email . ',';
			}
			return $retorno;
		}
		return false;
		
	}

}
