<?php include_once("connection.php");

error_reporting(0);
ini_set(“display_errors”, 0 );

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Consulta Notas</title>
</head>





<?php


	

    ini_set('default_charset', 'UTF-8');
    echo "<table border=\"1\" width=\"1500px\">";
    echo "<td><b>Numero da Nota</b></td>";
    echo "<td><b>Nome do Cliente</b></td>";
	echo "<td><b>UF Emitente</b></td>";
	echo "<td><b>Data de Emissão</b></td>";
	echo "<td><b>CHAVE DA NOTA</b></td>";
	echo "<td><b>Motivo</b></td>";
	echo "<td><b>CNPJ Cliente</b></td>";
	echo "<td><b>LINK</b></td>";
	

	
    {	
	

	
    echo "<tr>";
    foreach(glob('*.xml') as $xmlFile){
		
	
    $xml = simplexml_load_file($xmlFile);
    echo "<td>".substr ($xml->NFe->infNFe->ide->nNF,0,20).'</td>';
    echo "<td>".$xml->NFe->infNFe->dest->xNome.'</td>';
	echo "<td>".$xml->NFe->infNFe->emit->enderEmit->UF.'</td>';
	echo "<td>".$xml->NFe->infNFe->ide->dEmi.'</td>';
	echo "<td>".$xml->protNFe->infProt->chNFe.'</td>';
	echo "<td>".$xml->protNFe->infProt->xMotivo.'</td>';
	echo "<td>".$xml->NFe->infNFe->dest->CNPJ.'</td>';
	echo "<td><a href='$xmlFile' target='_blank' download>$xmlFile</a></td>";
	
    echo "</tr>";
	
	$sql = "INSERT INTO nf (nf, nome, uf, dtemi, chavenf, motivo, cnpljcli, xmlnf)
VALUES (".$xml->NFe->infNFe->ide->nNF.", '".$xml->NFe->infNFe->dest->xNome."', '".$xml->NFe->infNFe->emit->enderEmit->UF."', '".$xml->NFe->infNFe->ide->dEmi."', '".$xml->protNFe->infProt->chNFe."', '".$xml->protNFe->infProt->xMotivo."', '".$xml->NFe->infNFe->dest->CNPJ."', '$xmlFile')";





	if ($conn->query($sql) ) {
} else {
   
}


    }
	
	$conn->close();

    echo "</table>";

	
    }
?>
</body>
</form>
</html>