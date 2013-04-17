<?php
class InicioController extends AdminController
{
	public function index()
	{
		//print_r(Session::get('token'));
		
		return $this->_view();
	}
	
}