<?
/*
* @author Fabricio Silva
* @framework frameWorkMax - gerador automático de código
* @use_case 
*/
require_once($path_inc."/classes/conexao/adodb5/adodb.inc.php");

Class Connect {
	//public $retorno;
	public  $conexao;
	private $servidor;
	private $usuario;
	private $senha;
	private $bd;
	private $banco;

    public function __construct() {
		global $config;
		
		$this->servidor	= $config["servidor"];
		$this->usuario	= $config["usuario"];
		$this->senha	= $config["senha"];
		$this->bd		= $config["bd"];
		$this->banco	= $config["banco"];
	}
	
	public function open(){
		if(empty($this->banco))throw new Exception("Informe o banco de dados!");
		if ($this->banco == "mysql"){
			if (!$this->conexao = NewADOConnection($this->banco))throw new Exception("Erro ao instanciar o objeto ADOConnection. Banco:".$this->banco."!");
			if(!$this->conexao->Connect($this->servidor, $this->usuario, $this->senha, $this->bd))throw new Exception("Não foi possível conectar!");
			$this->conexao->setCharSet('latin1');
		} else {
			if (!$this->conexao = NewADOConnection($this->banco))throw new Exception("Erro ao instanciar o objeto ADOConnection. Banco:".$this->banco."!");
			if(!$this->conexao->Connect($this->servidor, $this->usuario, $this->senha, $this->bd))throw new Exception("Não foi possível conectar!");			
		}
		return $this->conexao;
	}
}
?>