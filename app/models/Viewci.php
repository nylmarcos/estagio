<?php

/** @View("viewci") */
class Viewci extends Model {

	/** @Column(Type="Int") */
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

	/** @Column(Type="String") */
	public $Assunto;

	/** @Column(Type="Int") */
	public $IdUsuarioAutorizacao;

	/** @Column(Type="Int") */
	public $Autorizado;

	/** @Column(Type="String") */
	public $Conteudo;

	/** @Column(Type="Int") */
	public $Enviado;

	/** @Column(Type="Int") */
	public $IdUsuarioAtenciosamente;

	/** @Column(Type="String") */
	public $NomeDe;

	/** @Column(Type="String") */
	public $EmailDe;

	/** @Column(Type="String") */
	public $TelefoneDe;

	/** @Column(Type="String") */
	public $NomePara;

	/** @Column(Type="String") */
	public $EmailPara;

	/** @Column(Type="String") */
	public $TelefonePara;

	/** @Column(Type="String") */
	public $NomeUsuarioVisualizou;

	/** @Column(Type="String") */
	public $NomeUsuarioStatus;

	/** @Column(Type="String") */
	public $NomeUsuarioAutorizacao;

	/** @Column(Type="String") */
	public $NomeUsuarioAutor;
	
	/** @Column(Type="String") */
	public $NomeUsuarioAtenciosamente;
	
	/** @Column(Type="String") */
	public $CargoUsuarioAtenciosamente;
	
	 public static function get($Id) {
        $bd = Database::getInstance();
        return $bd->Viewci->where('Id = ?', $Id)->single();
    }
	public static function allAutorizacaoByUsuario($idUsuario, $p, $s, $i, $f) {
		$bd = Database::getInstance();

		$p--;
		$p = ($p < 0 ? 0 : $p) * 10;
		
		$i = strtotime(preg_replace('@([\d]{2})/([\d]{2})/([\d]{4})@','$3-$2-$1 00:00:00',$i));
		$f = strtotime(preg_replace('@([\d]{2})/([\d]{2})/([\d]{4})@','$3-$2-$1 23:59:59',$f));
		//echo date('d/m/Y', $i) . '|';
		//echo date('d/m/Y', $f);
		$resultado = new stdClass;
		if ($i) {
			if ($s) {
				$resultado->Dados = $bd->Viewci->where('(IdUsuarioAutorizacao = ? AND Enviado = ? AND (Data >= ? AND Data <= ?) AND Conteudo like ?)', $idUsuario, 1, $i, $f, '%' . $s . '%')->limit(10, $p)->orderby('Data DESC')->all();
				$resultado->Total = $bd->Viewci->where('(IdUsuarioAutorizacao = ? AND Enviado = ? AND (Data >= ? AND Data <= ?) AND Conteudo like ?)', $idUsuario, 1, $i, $f, '%' . $s . '%')->count();
				
			} else {
				$resultado->Dados = $bd->Viewci->where('IdUsuarioAutorizacao = ? AND Enviado = ? AND Data >= ? AND Data <= ?', $idUsuario, 1, $i, $f)->limit(10, $p)->orderby('Data DESC')->all();
				$resultado->Total = $bd->Viewci->where('IdUsuarioAutorizacao = ? AND Enviado = ? AND Data >= ? AND Data <= ?', $idUsuario, 1, $i, $f)->count();
			}
		} else if ($s) {
			$resultado->Dados = $bd->Viewci->where('IdUsuarioAutorizacao = ? AND Enviado = ? AND Conteudo like ?', $idUsuario, 1, '%' . $s . '%' )->limit(10, $p)->orderby('Data DESC')->all();
			$resultado->Total = $bd->Viewci->where('IdUsuarioAutorizacao = ? AND Enviado = ? AND Conteudo like ?', $idUsuario, 1, '%' . $s . '%')->count();
		} else {
			$resultado->Dados = $bd->Viewci->where('IdUsuarioAutorizacao = ? AND Enviado = ?', $idUsuario,1)->limit(10, $p)->orderby('Data DESC')->all();
			$resultado->Total = $bd->Viewci->where('IdUsuarioAutorizacao = ? AND Enviado = ?', $idUsuario,1)->count();
		}
		return $resultado;
		
		
		return $bd->Viewci->where('IdUsuarioAutorizacao = ?', $idUsuario)->orderby('Autorizado ASC')->all();
	}

	public static function allRascunho($idUsuario, $p, $s, $i, $f) {
		$bd = Database::getInstance();

		$p--;
		$p = ($p < 0 ? 0 : $p) * 10;
		
		$i = strtotime(preg_replace('@([\d]{2})/([\d]{2})/([\d]{4})@','$3-$2-$1 00:00:00',$i));
		$f = strtotime(preg_replace('@([\d]{2})/([\d]{2})/([\d]{4})@','$3-$2-$1 23:59:59',$f));
		//echo date('d/m/Y', $i) . '|';
		//echo date('d/m/Y', $f);
		$resultado = new stdClass;
		if ($i) {
			if ($s) {
				$resultado->Dados = $bd->Viewci->where('(Enviado = ? AND (IdUsuarioAutor = ? OR IdUsuarioAtenciosamente = ?) AND (Data >= ? AND Data <= ?) AND Conteudo like ?)', 0, $idUsuario, $idUsuario, $i, $f, '%' . $s . '%')->limit(10, $p)->orderby('Data DESC')->all();
				$resultado->Total = $bd->Viewci->where('(Enviado = ? AND (IdUsuarioAutor = ? OR IdUsuarioAtenciosamente = ?) AND (Data >= ? AND Data <= ?) AND Conteudo like ?)', 0, $idUsuario, $idUsuario, $i, $f, '%' . $s . '%')->count();
				
			} else {
				$resultado->Dados = $bd->Viewci->where('Enviado = ? AND (IdUsuarioAutor = ? OR IdUsuarioAtenciosamente = ?) AND Data >= ? AND Data <= ?', 0, $idUsuario, $idUsuario, $i, $f)->limit(10, $p)->orderby('Data DESC')->all();
				$resultado->Total = $bd->Viewci->where('Enviado = ? AND (IdUsuarioAutor = ? OR IdUsuarioAtenciosamente = ?) AND Data >= ? AND Data <= ?', 0, $idUsuario, $idUsuario, $i, $f)->count();
			}
		} else if ($s) {
			$resultado->Dados = $bd->Viewci->where('(Enviado = ? AND (IdUsuarioAutor = ? OR IdUsuarioAtenciosamente = ?)) AND Conteudo like ?', 0, $idUsuario, $idUsuario, '%' . $s . '%')->limit(10, $p)->orderby('Data DESC')->all();
			$resultado->Total = $bd->Viewci->where('(Enviado = ? AND (IdUsuarioAutor = ? OR IdUsuarioAtenciosamente = ?)) AND Conteudo like ?', 0, $idUsuario, $idUsuario, '%' . $s . '%')->count();
		} else {
			$resultado->Dados = $bd->Viewci->where('Enviado = ? AND (IdUsuarioAutor = ? OR IdUsuarioAtenciosamente = ?)', 0, $idUsuario, $idUsuario)->limit(10, $p)->orderby('Data DESC')->all();
			$resultado->Total = $bd->Viewci->where('Enviado = ? AND (IdUsuarioAutor = ? OR IdUsuarioAtenciosamente = ?)', 0, $idUsuario, $idUsuario)->count();
		}
		return $resultado;
	}
	
	public static function allRecebida($idUsuario, $p, $s, $i, $f) {
		$bd = Database::getInstance();

		$p--;
		$p = ($p < 0 ? 0 : $p) * 10;
		
		$i = strtotime(preg_replace('@([\d]{2})/([\d]{2})/([\d]{4})@','$3-$2-$1 00:00:00',$i));
		$f = strtotime(preg_replace('@([\d]{2})/([\d]{2})/([\d]{4})@','$3-$2-$1 23:59:59',$f));
		
		$unidades = Usuariounidade::getByUsuario($idUsuario);
		$interrogacoes = array();
		foreach ($unidades as $u) {
			$interrogacoes[] = $u->IdUnidade;
		}
		if(!$interrogacoes)
			$interrogacoes [] = 0;
		
		$resultado = new stdClass;
		if ($i && $f) {
			if ($s) {
				$resultado->Dados = $bd->Viewci->where('Enviado = ? AND IdUsuarioAtenciosamente != ? AND IdUsuarioAutor != ? AND ((IdUsuarioAutorizacao IS NULL OR IdUsuarioAutorizacao = 0) OR (IdUsuarioAutorizacao IS NOT NULL AND Autorizado = 1)) AND (TipoPara = ? AND IdPara IN ('. implode(',', $interrogacoes) .') OR TipoPara = ? AND IdPara = ?) AND (Data >= ? AND Data <= ?) AND Conteudo like ?',1, $idUsuario, $idUsuario, 0, 1,$idUsuario, $i, $f, '%' . $s . '%')->limit(10, $p)->orderby('Data DESC')->all();
				$resultado->Total = $bd->Viewci->where('Enviado = ? AND IdUsuarioAtenciosamente != ? AND IdUsuarioAutor != ? AND ((IdUsuarioAutorizacao IS NULL OR IdUsuarioAutorizacao = 0) OR (IdUsuarioAutorizacao IS NOT NULL AND Autorizado = 1)) AND (TipoPara = ? AND IdPara IN ('. implode(',', $interrogacoes) .') OR TipoPara = ? AND IdPara = ?) AND (Data >= ? AND Data <= ?) AND Conteudo like ?',1, $idUsuario, $idUsuario, 0, 1,$idUsuario, $i, $f, '%' . $s . '%')->count();
				
			} else {
					$resultado->Dados = $bd->Viewci->where('Enviado = ? AND IdUsuarioAtenciosamente != ? AND IdUsuarioAutor != ? AND ((IdUsuarioAutorizacao IS NULL OR IdUsuarioAutorizacao = 0) OR (IdUsuarioAutorizacao IS NOT NULL AND Autorizado = 1)) AND (TipoPara = ? AND IdPara IN ('. implode(',', $interrogacoes) .') OR TipoPara = ? AND IdPara = ?) AND (Data >= ? AND Data <= ?)',1, $idUsuario, $idUsuario, 0, 1,$idUsuario, $i, $f)->limit(10, $p)->orderby('Data DESC')->all();
					$resultado->Total = $bd->Viewci->where('Enviado = ? AND IdUsuarioAtenciosamente != ? AND IdUsuarioAutor != ? AND ((IdUsuarioAutorizacao IS NULL OR IdUsuarioAutorizacao = 0) OR (IdUsuarioAutorizacao IS NOT NULL AND Autorizado = 1)) AND (TipoPara = ? AND IdPara IN ('. implode(',', $interrogacoes) .') OR TipoPara = ? AND IdPara = ?) AND (Data >= ? AND Data <= ?)',1, $idUsuario, $idUsuario, 0, 1,$idUsuario, $i, $f)->count();
			}
		} else if ($s) {
				$resultado->Dados = $bd->Viewci->where('Enviado = ? AND IdUsuarioAtenciosamente != ? AND IdUsuarioAutor != ? AND ((IdUsuarioAutorizacao IS NULL OR IdUsuarioAutorizacao = 0) OR (IdUsuarioAutorizacao IS NOT NULL AND Autorizado = 1)) AND (TipoPara = ? AND IdPara IN ('. implode(',', $interrogacoes) .') OR TipoPara = ? AND IdPara = ?) AND Conteudo like ?',1, $idUsuario, $idUsuario, 0, 1,$idUsuario, '%' . $s . '%')->limit(10, $p)->orderby('Data DESC')->all();
				$resultado->Total = $bd->Viewci->where('Enviado = ? AND IdUsuarioAtenciosamente != ? AND IdUsuarioAutor != ? AND ((IdUsuarioAutorizacao IS NULL OR IdUsuarioAutorizacao = 0) OR (IdUsuarioAutorizacao IS NOT NULL AND Autorizado = 1)) AND (TipoPara = ? AND IdPara IN ('. implode(',', $interrogacoes) .') OR TipoPara = ? AND IdPara = ?) AND Conteudo like ?',1, $idUsuario, $idUsuario, 0, 1,$idUsuario, '%' . $s . '%')->count();
		} else {
			$resultado->Dados = $bd->Viewci->where('Enviado = ? AND IdUsuarioAtenciosamente != ? AND IdUsuarioAutor != ? AND ((IdUsuarioAutorizacao IS NULL OR IdUsuarioAutorizacao = 0) OR (IdUsuarioAutorizacao IS NOT NULL AND Autorizado = 1)) AND (TipoPara = ? AND IdPara IN ('. implode(',', $interrogacoes) .') OR TipoPara = ? AND IdPara = ?)',1, $idUsuario, $idUsuario, 0, 1,$idUsuario)->limit(10, $p)->orderby('Data DESC')->all();
		$resultado->Total = $bd->Viewci->where('Enviado = ? AND IdUsuarioAtenciosamente != ? AND IdUsuarioAutor != ? AND ((IdUsuarioAutorizacao IS NULL OR IdUsuarioAutorizacao = 0) OR (IdUsuarioAutorizacao IS NOT NULL AND Autorizado = 1)) AND (TipoPara = ? AND IdPara IN ('. implode(',', $interrogacoes) .') OR TipoPara = ? AND IdPara = ?)',1, $idUsuario, $idUsuario, 0, 1,$idUsuario)->count();
		}
		return $resultado;
	}
	public static function count_recebidas_nao_lida()
	{
		$idUsuario = Session::get('usuario')->Id;
		$unidades = Usuariounidade::getByUsuario($idUsuario);
		$interrogacoes = array();
		foreach ($unidades as $u) {
			$interrogacoes[] = $u->IdUnidade;
		}
		if(!$interrogacoes)
			$interrogacoes [] = 0;
		
		$bd = Database::getInstance();
		return $bd->Viewci->where('Enviado = ? AND IdUsuarioAtenciosamente != ? AND IdUsuarioAutor != ? AND ((IdUsuarioAutorizacao IS NULL OR IdUsuarioAutorizacao = 0) OR (IdUsuarioAutorizacao IS NOT NULL AND Autorizado = 1)) AND (TipoPara = ? AND IdPara IN ('. implode(',', $interrogacoes) .') OR TipoPara = ? AND IdPara = ?) AND (IdUsuarioVisualizou IS NULL OR IdUsuarioVisualizou = ?)',1, $idUsuario, $idUsuario, 0, 1,$idUsuario,0)->count();
		
	}
	public static function count_autorizacao_pendentes() {
		$idUsuario = Session::get('usuario')->Id;	
		$bd = Database::getInstance();
		return $bd->Viewci->where('IdUsuarioAutorizacao = ? AND Enviado = ? AND Autorizado IS NULL', $idUsuario,1)->count();
	}
	public static function allEnviada($idUsuario, $p, $s, $i, $f) {
		$bd = Database::getInstance();

		$p--;
		$p = ($p < 0 ? 0 : $p) * 10;
		
		$i = strtotime(preg_replace('@([\d]{2})/([\d]{2})/([\d]{4})@','$3-$2-$1 00:00:00',$i));
		$f = strtotime(preg_replace('@([\d]{2})/([\d]{2})/([\d]{4})@','$3-$2-$1 23:59:59',$f));
		
		$unidades = Usuariounidade::getByUsuario($idUsuario);
		$interrogacoes = array();
		foreach ($unidades as $u) {
			$interrogacoes[] = $u->IdUnidade;
		}
		if(!$interrogacoes)
			$interrogacoes [] = 0;
		
		$resultado = new stdClass;
		if ($i && $f) {
			if ($s) {
				$resultado->Dados = $bd->Viewci->where('(TipoDe = ? AND IdDe IN ('. implode(',', $interrogacoes) .') || (TipoDe = ? AND IdDe = ?)) AND (Data >= ? AND Data <= ?) AND Enviado = ? AND Conteudo like ?', 0, 1, $idUsuario, $i, $f, 1, '%' . $s . '%')->limit(10, $p)->orderby('Data DESC')->all();
				$resultado->Total = $bd->Viewci->where('(TipoDe = ? AND IdDe IN ('. implode(',', $interrogacoes) .') || (TipoDe = ? AND IdDe = ?)) AND (Data >= ? AND Data <= ?) AND Enviado = ? AND Conteudo like ?', 0, 1, $idUsuario, $i, $f, 1, '%' . $s . '%')->count();
			} else {
				$resultado->Dados = $bd->Viewci->where('(TipoDe = ? AND IdDe IN ('. implode(',', $interrogacoes) .') || (TipoDe = ? AND IdDe = ?)) AND (Data >= ? AND Data <= ?) AND Enviado = ?',0,1,$idUsuario, $i, $f, 1)->limit(10, $p)->orderby('Data DESC')->all();
				$resultado->Total = $bd->Viewci->where('(TipoDe = ? AND IdDe IN ('. implode(',', $interrogacoes) .') || (TipoDe = ? AND IdDe = ?)) AND (Data >= ? AND Data <= ?) AND Enviado = ?',0,1,$idUsuario, $i, $f, 1)->count();
			}
		} else if ($s) {
				$resultado->Dados = $bd->Viewci->where('(TipoDe = ? AND IdDe IN ('. implode(',', $interrogacoes) .') || (TipoDe = ? AND IdDe = ?)) AND Enviado = ? AND Conteudo like ?', 0, 1, $idUsuario,1,'%' . $s . '%')->limit(10, $p)->orderby('Data DESC')->all();
				$resultado->Total = $bd->Viewci->where('(TipoDe = ? AND IdDe IN ('. implode(',', $interrogacoes) .') || (TipoDe = ? AND IdDe = ?)) AND Enviado = ? AND Conteudo like ?', 0, 1, $idUsuario,1,'%' . $s . '%')->count();
		} else {
				$resultado->Dados = $bd->Viewci->where('(TipoDe = ? AND IdDe IN ('. implode(',', $interrogacoes) .') || (TipoDe = ? AND IdDe = ?)) AND Enviado = ?',0, 1, $idUsuario,1)->limit(10, $p)->orderby('Data DESC')->all();
				$resultado->Total = $bd->Viewci->where('(TipoDe = ? AND IdDe IN ('. implode(',', $interrogacoes) .') || (TipoDe = ? AND IdDe = ?)) AND Enviado = ?',0, 1, $idUsuario,1)->count();
		}
		return $resultado;
	}
}
