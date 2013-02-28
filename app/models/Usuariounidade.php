<?php

/** @Entity("usuariounidade") */
class Usuariounidade extends Model {

	/**
	 * @AutoGenerate()
	 * @Column(Type="Int",Key="Primary")
	 */
	public $Id;

	/** @Column(Type="Int") */
	public $IdUnidade;

	/** @Column(Type="Int") */
	public $IdUsuario;

	/** @Column(Type="Int") */
	public $Permissao;

	public static function get($Id) {
		$bd = Database::getInstance();
		return $bd->Usuariounidade->where('Id = ?', $Id)->single();
	}
	public static function getByUsuario($idUsuario,$permissao = null) {
		$bd = Database::getInstance();
		if($permissao)
			return $bd->Usuariounidade->where('IdUsuario = ? AND Permissao = ?', $idUsuario, $permissao)->all();
		else
			return $bd->Usuariounidade->where('IdUsuario = ?', $idUsuario)->all();
	}
	public static function getByUnidade($idUnidade,$permissao = null) {
		$bd = Database::getInstance();
		if($permissao)
			return $bd->Usuariounidade->where('IdUnidade = ? AND Permissao = ?', $idUnidade, $permissao)->all();
		else
			return $bd->Usuariounidade->where('IdUnidade = ?', $idUnidade)->all();
	}
	public static function virificar_permissao($idUnidade,$idUsurio) {
		$bd = Database::getInstance();
		return $bd->Usuariounidade->where('IdUnidade = ? AND IdUsuario = ?', $idUnidade, $idUsurio)->all();
	}
	public static function excluir(Usuariounidade $usuariounidade) {
		$bd = Database::getInstance();
		$bd->Usuariounidade->delete($usuariounidade);
		$bd->save();
	}
	public static function excluirAllByIdUnidade($idUnidade) {
		$bd = Database::getInstance();
		$bd->Usuariounidade->where('IdUnidade = ?', $idUnidade)->deleteAll();;
		$bd->save();
	}

	public static function salvar(Usuariounidade $usuariounidade) {
		$bd = Database::getInstance();
		if ($usuariounidade->Id) {
			$bd->Usuariounidade->update($usuariounidade);
		} else {
			$bd->Usuariounidade->insert($usuariounidade);
		}
		$bd->save();
	}

}
