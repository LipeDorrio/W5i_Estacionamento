<?php
Class Paginacao {

	public $inicio;
	public $limite;
	public $qtdPag;
	public $qtdSubPag;
	public $rodape;
	public $acao;
	public $acaoAux;
    public $topo;
	public $qtdTotal;
	public $jasonPaginacao;
	public $qtdRegPorPag;
	public $urlNextPg;
	public $urlPrevPg;

	public function __construct($contRegPorPag, $qtdRegConsulta, $form, $modulo, $pagina, $numPag){

		//setar as variáveis
		$this->qtdRegPorPag = $contRegPorPag;
		$this->limite = $contRegPorPag * $numPag;
		$this->incio = $this->limite - $contRegPorPag;
		$this->strLimite = " LIMIT ".$this->incio.", ".$contRegPorPag;
		$this->qtdPag = intval($qtdRegConsulta/$contRegPorPag) + ($qtdRegConsulta%$contRegPorPag>0?1:0);
		$this->qtdSubPag = intval($this->qtdPag/10) + ($this->qtdPag%10>0?1:0);
		if ($this->limite > $qtdRegConsulta) $this->limite = $qtdRegConsulta;
		$this->qtdTotal = $qtdRegConsulta;
		$this->rodape = $this->numeracao($form,$numPag);
		$this->acao = $this->action($modulo,$pagina);
		$this->acaoAux = $this->actionAux($modulo,$pagina);

	}
	
	private function geraUrl($numPag, $sentido="A"){

		$urlRetorno = "";
		//montar a url
		$protocolo = "";
		$pagA = ($numPag - 1);
		$pagP = ($numPag + 1);
		if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') $protocolo = "s";
		$urlAtual = "http".$protocolo."://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

		$urlQuebrada = explode("?",$urlAtual);
		if (isset($urlQuebrada[1])) {
			$parametros = "*".$urlQuebrada[1];

			//limpar 
			$parametros = str_replace("&pg=".$numPag, "", $parametros);
			//echo "Remove &pg=".$numPag." -> ".$parametros."<br><br>"; 

			$parametros = str_replace("&pg=", "", $parametros);
			//echo "Remove &pg= -> ".$parametros."<br><br>"; 

			$parametros = str_replace("*pg=".$numPag, "", $parametros);
			//echo "Remove ?pg=".$numPag." -> ".$parametros."<br><br>"; 

			$parametros = str_replace("*pg=", "", $parametros);
			//echo "Remove ?pg= -> ".$parametros."<br><br>"; 

			//inserir o parametro da paginação;
			$parametros = "?pg=".$numPag."&".str_replace("*", "", $parametros);
			//echo "Avrescentando o ? ".$parametros."<br><br>";
			$parametros = str_replace("&&", "&", $parametros);
			//echo "removendo & a mais ".$parametros."<br><br>";
			//echo "Ultimo caracter: ".substr($parametros, -1)."<br><br>";
			if (substr($parametros, -1)=="&") $parametros = substr($parametros, 0, strlen($parametros)-1);
			//echo "Final quando tem patametro ".$parametros."<br><br>";
		} else {
			$parametros = "?pg=".$numPag;
		}
		//echo "Final ".$parametros."<br><br>"; 
		if ($sentido=="A"){
			$parametros = str_replace("?pg=".$numPag, "?pg=".$pagA, $parametros);
		} else if ($sentido=="P"){
			$parametros = str_replace("?pg=".$numPag, "?pg=".$pagP, $parametros);
		}
		return $urlQuebrada[0].$parametros;
	}

	private function numeracao($form,$numPag){
		
		$retorno = "<div id='Paginacao'>";
		if ($this->qtdTotal>0) {
			$subPaginacao = $this->verificaSubPaginaPaginaPertence($numPag);
			if ($numPag <= 1) {
				$retorno .= "<span>Anterior</span> | ";
				$this->urlPrevPg = null;
			} else {
				$retorno .= "<a href='javascript:paginacao(1,document.".$form.");'>Primeira</a> | ";
				if ($subPaginacao["subPagInicial"] > 1){
					$retorno .= "<a href='javascript:paginacao(".($subPaginacao["subPagInicial"] - 10).",document.".$form.");'> Menos</a> | ";
				}
				if ($numPag > $this->qtdPag) $numPag = $this->qtdPag;
				$retorno .= "<a href='javascript:paginacao(".($numPag - 1).",document.".$form.");'>Anterior</a> | ";
				$this->urlPrevPg = $this->geraUrl($numPag,"A");
			}
			for($y=$subPaginacao["subPagInicial"];$y<=$subPaginacao["subPagFinal"];$y++){
				//if ($count==1) $primeiraPag = $y;
				$retorno .= ($y == $numPag)? "<span><strong>".$y."</strong></span> | ":"<a href='javascript:paginacao(".$y.",document.".$form.");'>".$y."</a> | ";
			}
			if ($numPag >= $this->qtdPag or $this->qtdPag == 0) {     
				$retorno .= "<span> Próxima</span>";
				$this->urlNextPg = null;
			} else {     
				//Próxima página
				$retorno .= "<a href='javascript:paginacao(".($numPag + 1).",document.".$form.");'> Pr?xima</a>";
				$this->urlNextPg = $this->geraUrl($numPag,"P");

				if ($subPaginacao["subPagina"]!=$this->qtdSubPag and $this->qtdSubPag>1){
					$retorno .= " | <a href='javascript:paginacao(".($subPaginacao["subPagFinal"] + 1).",document.".$form.");'>Mais</a>";
				}
				$retorno .= " | <a href='javascript:paginacao(".$this->qtdPag.",document.".$form.");'>?ltima</a>";

			}
			$primeiroReg = (($this->qtdRegPorPag*$numPag)-($this->qtdRegPorPag-1));
			$ultimoReg = (($this->qtdTotal<($numPag*$this->qtdRegPorPag))?$this->qtdTotal:($numPag*$this->qtdRegPorPag));
			$this->topo = "Registros de ".$primeiroReg." a ".$ultimoReg." no total de ".$this->qtdTotal;
			$this->jasonPaginacao = [
				"de"=>$primeiroReg,
				"ate"=>$ultimoReg,
				"qtdPag"=>$this->qtdPag,
				"pagAtual"=>$numPag,
				"totalRegEncontrados"=>$this->qtdTotal,
				"totalRegPorPagina"=>$this->qtdRegPorPag,
				"urlPrevPg"=>$this->urlPrevPg,
				"urlNextPg"=>$this->urlNextPg
			];
		} else {
			$this->topo = "Nenhuma registro encontrado nesta consulta.";
		}
		$retorno .= "</div>";
		return $retorno;
	}

	private function action($modulo,$pagina){
        global $caminho;
		$retorno = "<script>";
		$retorno .= "function paginacao(pagina,form){";
		$retorno .= "	form.pg.value = pagina;";
		$retorno .= "	form.m.value = \"".$modulo."\";";
		$retorno .= "	form.u.value = \"".$pagina.".php\";";
		$retorno .= "	form.action = \"".$caminho."index.php\";";
		$retorno .= "	form.target = \"\";";
		$retorno .= "	form.submit();";
		$retorno .= "}";
		$retorno .= "</script>";
		return $retorno;
	}

	private function actionAux($modulo,$pagina){
        global $caminho;
		$retorno = "<script>";
		$retorno .= "function paginacao(pagina,form){";
		$retorno .= "	form.pg.value = pagina;";
		$retorno .= "	form.action = \"".$caminho.$pagina."\";";
		$retorno .= "	form.target = \"\";";
		$retorno .= "	form.submit();";
		$retorno .= "}";
		$retorno .= "</script>";
		return $retorno;
	}

	private function verificaSubPaginaPaginaPertence($numPag){
		for ($x=0;$x<$this->qtdSubPag;$x++){
			$incre = $x*10;
			for($y=1;$y<=10;$y++){
				$numPagAux = $y+$incre;
				if ($numPag == $numPagAux){
					$subPagina = $x+1;
					$subPagInicial = 1+$incre;
					$subPagFinal = 10+$incre;
					if ($this->qtdPag <= $subPagFinal){
						$subPagFinal = $this->qtdPag;
					}
					$param = array("subPagina"=>$subPagina,"subPagInicial"=>$subPagInicial,"subPagFinal"=>$subPagFinal);
					return $param;
				}
			}
		}
	}
}
?>