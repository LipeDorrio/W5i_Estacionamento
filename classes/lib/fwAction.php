<?php
Class ActionAlert {
	
	public function __construct(){

	}
	public function mensagem($msg, $get = '', $form_limpa = '', $get_raiz = ''){
		$mensagem = "<script language='javascript'>";
		if ($msg!=''){ $mensagem =	$mensagem."alert('".$msg."');"; }
		if ($get!=''){ 
			if ($get=='exclui') {
				$mensagem = $mensagem."window.parent.refresch(5);"; 
			} else {
				if ($get!='erro') {
					$mensagem = $mensagem."window.parent.self.location = '../../".$get."';"; 
				}
			}
		} else if ($get_raiz==''){
			$mensagem = $mensagem."window.parent.parent.refresch(5);"; 
		}
		if ($form_limpa!=''){ $mensagem = $mensagem."window.parent.".$form_limpa.".reset();"; }
		if ($get_raiz!=''){ $mensagem = $mensagem."window.parent.self.location = '".$get_raiz."';"; }
		$mensagem = $mensagem."</script>";
		return $mensagem;	
	}
}
?>