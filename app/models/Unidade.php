<?php


/** @Entity("unidade") */
class Unidade extends Model {
    
    /**
     * @AutoGenerate()
     * @Column(Type="Int",Key="Primary")
     */
    public $Id;
    
    /** @Column(Type="String") 
     * @Required() 
     */
    public $Nome;
	
    /** @Column(Type="String")
     * @Required() 
     */
    public $Email;
	
    /** @Column(Type="String") 
     * @Required()
     */
    public $Telefone;

    public static function get($Id) {
        $bd = Database::getInstance();
        return $bd->Unidade->where('Id = ?', $Id)->single();
    }

    public static function salvar(Unidade $unidade) {
        $bd = Database::getInstance();
        if ($unidade->Id) {
            $bd->Unidade->update($unidade);
        } else {
            $bd->Unidade->insert($unidade);
        }
        $bd->save();
    }

    public static function excluir(Unidade $unidade) {
        $bd = Database::getInstance();
        $bd->Unidade->delete($unidade);
        $bd->save();
    }

    public static function listar($p, $s) {
		$bd = Database::getInstance();
		$p--;
		$p = ($p < 0 ? 0 : $p) * 10;
        $resultado = new stdClass;
        if ($s) {
            $resultado->Dados = $bd->Unidade->where('Nome like ?', '%'.$s.'%')->limit(10, $p)->orderby('Nome ASC')->all();
            $resultado->Total = count($resultado->Dados);
        } else {
            $resultado->Dados = $bd->Unidade->limit(10, $p)->orderby('Nome ASC')->all();
            $resultado->Total = $bd->Unidade->count();
        }
        return $resultado;
    }
}
