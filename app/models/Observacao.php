<?php

/** @Entity("observacao") */
class Observacao extends Model {
	/**
	 * @AutoGenerate()
	 * @Column(Type="Int",Key="Primary")
	 */
	public $Id;

	/** @Column(Type="Int") 
	 * @Required()
	 */
	public $Data; 
	
	/** @Column(Type="Int") 
	 *  @Required()
	 */
	public $IdCi;

	/** @Column(Type="Int")
	 *  @Required()
	 */
	public $IdUsuario;

	/** @Column(Type="String") 
	 * @Required()
	 */
	public $Conteudo;
	
	public static function excluirAllByCi(Ci $ci) {
        $bd = Database::getInstance();
        $bd->Observacao->deleteAll('IdCi = ?',$ci->Id);
        $bd->save();
    }
	public static function salvar(Observacao $obs) {
        $bd = Database::getInstance();
        $bd->Observacao->insert($obs);
        $bd->save();
    }
}