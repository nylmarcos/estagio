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
	
	public static function getAllByIdUnidade($Id) {
        $bd = Database::getInstance();
        return $bd->Viewusuariounidade->where('IdUnidade = ? AND IdUsuario IS NOT NULL', $Id)->all();
    }
	
	public static function listar($IdUsuario, $p, $s) {
		$bd = Database::getInstance();
		$p--;
		$p = ($p < 0 ? 0 : $p) * 10;
        $resultado = new stdClass;
        if ($s) {
            $resultado->Dados = $bd->viewusuariounidade->where('IdUsuario = ? OR IdUsuario IS NULL OR IdUnidade NOT IN (SELECT guu.IdUnidade FROM usuariounidade guu WHERE guu.IdUsuario = ?) AND NomeUnidade like ?', $IdUsuario, $IdUsuario, '%'.$s.'%')->limit(10, $p)->orderby('NomeUnidade ASC')->all();
            $resultado->Total = count($resultado->Dados);
        } else {
			
            $resultado->Dados = $bd->Viewusuariounidade->where('IdUsuario = ? OR IdUsuario IS NULL OR IdUnidade NOT IN (SELECT guu.IdUnidade FROM usuariounidade guu WHERE guu.IdUsuario = ?)', $IdUsuario, $IdUsuario)->groupBy('IdUnidade')->limit(10, $p)->all();
            //Debug::show();
			//exit(var_dump($resultado));
			$resultado->Total = $bd->Viewusuariounidade->count();
        }
        return $resultado;
    }
	
	public static function allByIdUsuario($IdUsuario, $permissao = NULL) {
		$bd = Database::getInstance();
		if($permissao)
			return $bd->Viewusuariounidade->where('IdUsuario = ? AND Permissao', $IdUsuario, $permissao)->all();
		else
			return $bd->Viewusuariounidade->where('IdUsuario = ?', $IdUsuario)->all();
    }
	public static function allByIdUnidade($IdUnidade, $permissao = NULL) {
		$bd = Database::getInstance();
		if($permissao)
			return $bd->Viewusuariounidade->where('IdUnidade = ? AND Permissao = ?', $IdUnidade, $permissao)->all();
		else
			return $bd->Viewusuariounidade->where('IdUnidade = ?', $IdUnidade)->all();
    }
}
