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

	public static function excluir(Usuariounidade $usuariounidade) {
		$bd = Database::getInstance();
		$bd->Usuariounidade->delete($usuariounidade);
		$bd->save();
	}
	public static function excluirAllByIdUnidade($idunidade) {
		$bd = Database::getInstance();
		$bd->Usuariounidade->where('IdUnidade = ?', $idunidade)->deleteAll();;
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
