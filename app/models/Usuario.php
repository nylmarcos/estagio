<?php


/** @Entity("usuario") */
class Usuario extends Model {
    
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
    public $Login_Email;
	
	/** @Column(Type="String")
     * @Required() 
     */
    public $Senha;
	
    /** @Column(Type="String") 
     * @Required() 
     */
    public $Telefone;
	
	/** @Column(Type="String") 
     * @Required() 
     */
    public $Cargo;
	
	/** 
	 * @Column(Type="Int")
	 * @Label("Administrador")
     * @Required() 
     */
    public $EhAdmin;
	
	/** @Column(Type="Int") 
     * @Required() 
     */
    public $Bloqueado;

    public static function get($Id) {
        $bd = Database::getInstance();
        return $bd->Usuario->where('Id = ?', $Id)->single();
    }

    public static function salvar(Usuario $usuario) {
        $bd = Database::getInstance();
        if ($usuario->Id) {
            $bd->Usuario->update($usuario);
        } else {
            $bd->Usuario->insert($usuario);
        }
        $bd->save();
    }
	public static function excluir(Usuario $usuario) {
        $bd = Database::getInstance();
        $bd->Usuario->delete($usuario);
        $bd->save();
    }
	
	public static function logar($lodin_email, $senha)
	{
		$bd = DataBase::getInstance();
		return $bd->Usuario->where('Login_Email = ? AND Senha = ?', $lodin_email, $senha)->single();		
	}
	
    public static function listar($p, $s) {
       $bd = Database::getInstance();
        $resultado = new stdClass;
		$p--;
		$p = ($p < 0 ? 0 : $p) * 10;
        if ($s) {
            $resultado->Dados = $bd->Usuario->where('Nome like ?', '%'.$s.'%')->limit(10, $p)->orderby('Nome ASC')->all();
            $resultado->Total = count($resultado->Dados);
        } else {
            $resultado->Dados = $bd->Usuario->limit(10, $p)->orderby('Nome ASC')->all();
            $resultado->Total = $bd->Usuario->count();
        }
        return $resultado;
    }
}
