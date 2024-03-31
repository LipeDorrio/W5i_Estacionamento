<?
include_once("Input.php");

$input = new CI_Input();
/*
echo "->xss_clean - Permite HTML: ".$input->xss_clean($_REQUEST["teste"], false, true);
echo "<br>";
echo "->xss_clean - Sem Html HTML: ".$input->xss_clean($_REQUEST["teste"], false, false);
*/

echo "->xss_clean - Permite HTML: ".$input->post("teste",true);
echo "<br>";
echo "->xss_clean - Sem Html HTML: ".$input->xss_clean($_REQUEST["teste"], false, false);

/*
<script>window.self.location = "http://www.seplan.ba.gov.br/"</script>
<script>alert( "http://www.seplan.ba.gov.br/");</script>
<a href='test'>Test</a>
<iframe src='http://www.seplan.ba.gov.br' ></iframe>
*/
?>