<?php

/** @Entity("ci") */
class Ci extends Model {

	/**
	 * @AutoGenerate()
	 * @Column(Type="Int",Key="Primary")
	 */
	public $Id;

	/** @Column(Type="Int") */
	public $IdUsuarioAutor; 
	
	/** @Column(Type="Int") */
	public $Numero;

	/** @Column(Type="Int") */
	public $Data;

	/** @Column(Type="Int") */
	public $IdUsuarioVisualizou;
	
	/** @Column(Type="Int") */
	public $DataVisualizou;

	/** @Column(Type="Int") */
	public $IdDe;

	/** @Column(Type="Int") */
	public $TipoDe;

	/** @Column(Type="Int") */
	public $IdPara;

	/** @Column(Type="Int") */
	public $TipoPara;

	/** @Column(Type="Int") */
	public $DataStatus;

	/** @Column(Type="Int") */
	public $IdUsuarioStatus;

	/** @Column(Type="Int") */
	public $Status;

	/** @Column(Type="String") 
	 * @Required()
	 */
	public $Assunto;

	/** @Column(Type="Int") */
	public $IdUsuarioAutorizacao;

	/** @Column(Type="Int") */
	public $Autorizado;

	/** @Column(Type="String") 
	 * @Required()
	 */
	public $Conteudo;

	/** @Column(Type="Int") */
	public $Enviado;

	/** @Column(Type="Int")
	 *  @Required()
	 *  @Label("Atenciosamente")
	 */
	public $IdUsuarioAtenciosamente;

	 public static function salvar(Ci $ci) {
        $bd = Database::getInstance();
        if ($ci->Id) {
            $bd->Ci->update($ci);
        } else {
            $bd->Ci->insert($ci);
        }
        $bd->save();
    }
	
	public static function excluir(Ci $ci)
	{
		$bd = Database::getInstance();
		$bd->Ci->delete($ci);
        $bd->save();
	}
	public static function get_ultima_ci(Ci $ci){
		$bd = Database::getInstance();
		$resultado = $bd->Ci->where('FROM_UNIXTIME(Data, "%Y") = ? AND Enviado = ?', date("Y", $ci->Data),1)->all();
		return count($resultado);
	}


	public static function listar($tipo, $p, $s) {
		$bd = Database::getInstance();
		$p--;
		$p = ($p < 0 ? 0 : $p) * 10;
		$resultado = new stdClass;
		if ($tipo == 1) {
			if ($s) {
				$resultado->Dados = $bd->Ci->where('Conteudo like ?', '%' . $s . '%')->limit(10, $p)->orderby('Data ASC')->all();
				$resultado->Total = count($resultado->Dados);
			} else {
				$resultado->Dados = $bd->Ci->limit(10, $p)->orderby('Data ASC')->all();
				$resultado->Total = $bd->Ci->count();
			}
		} else {
			if ($s) {
				$resultado->Dados = $bd->Ci->where('Conteudo like ?', '%' . $s . '%')->limit(10, $p)->orderby('Data ASC')->all();
				$resultado->Total = count($resultado->Dados);
			} else {
				$resultado->Dados = $bd->Ci->limit(10, $p)->orderby('Data ASC')->all();
				$resultado->Total = $bd->Ci->count();
			}
		}
		return $resultado;
	}

}
