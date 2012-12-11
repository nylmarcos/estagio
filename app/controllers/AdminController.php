<?php 
class AdminController extends Controller
{
	/**
	* @Master("admin")
	* @Auth("admin","usuario")
	*/
	public function __construct()
	{
	}
	/** @Auth("*") */
	public function login()
	{
		if(Auth::isLogged())
			$this->_redirect('~/unidade');
		
		if(is_post)
		{
			
			$form = $this->_data();
			$usuario = Usuario::logar($form->oab, $form->senha);
			if($usuario)
			{	
				if($usuario->Bloqueado == 1)
				{
					$this->_flash('alert alert-error fade in', 'Usuário bloqueado');
				}
				else
				{
					Auth::set($usuario->EhAdmin == 1 ? "admin" : "usuario");
					Session::set('usuario', $usuario);
					$this->_redirect('~/inicio');
				}
			}
			else
			{
				$this->_flash('alert alert-error fade in', 'Login ou Senha incorreta!');
			}
		}
		return $this->_view();
	}
	public function sair()
	{
		Auth::clear();
		Session::clear();
		$this->_redirect('~/admin/login');
	}
}