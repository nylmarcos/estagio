<?php

/** @View("viewobservacao") */
class Viewobservacao extends Model {
	
	/** @Column(Type="Int")
	 */
	public $IdObs;
	
	/** @Column(Type="Int") 
	 */
	public $Data; 
	
	/** @Column(Type="Int") 
	 */
	public $IdCi;

	/** @Column(Type="Int")
	 */
	public $IdUsuario;

	/** @Column(Type="String") 
	 * @Required()
	 */
	public $Conteudo;
	
	/** @Column(Type="String") 
	 */
	public $Nome;
	
	public static function allByCi($idCi) {
        $bd = Database::getInstance();
        return $bd->Viewobservacao->where('IdCi = ?', $idCi)->all();
    }
}