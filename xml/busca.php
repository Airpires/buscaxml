<?php include_once("connection.php");

error_reporting(0);
ini_set(“display_errors”, 0 );

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap.min.css">
    <style type="text/css">
      body{margin-left: 35%;}
      .form-control{border-radius: 0px;}
      .btn-primary{border-radius: 0px;}
    </style>


    <title>Consulta Notas Base Histórica</title>
  </head>
  <body>

    <div id="content">
                  <h4>Pesquisar Nota Fiscal</h4>

      <form name="pesquisa" method="POST" class="form-inline">
        <input type="text" name="busca" class="form-control col-sm-5"/>
        <input type="submit" class="btn btn-primary" value="Buscar" />
        <input type="hidden" name="env" value="envBusca">
      </form>

      <?php
	  

        if($busca = $_POST['env'] && $_POST['env'] == "envBusca"){
			
          if($_POST['busca']){
            $busca = htmlspecialchars("%{$_POST['busca']}%");
            $sql = $conn->prepare("SELECT * FROM nf WHERE (nf LIKE'%".$busca."%') OR (dtemi LIKE'%".$busca."%') OR (nome LIKE'%".$busca."%')  ORDER BY nf ASC");
            $sql->bind_param("sss", $busca, $busca, $busca);
            $sql->execute(); 
            $resultado = $sql->get_result();
            $conta = $resultado->num_rows;
			

            if($conta > 0){
              while($dados = $resultado->fetch_array()){
				
          ?>
		  
          <td><p><b>Nome Fornecedor:</b> <?php echo $dados['nome'];?></p></td>
          <p><b>Numero NF:</b> <?php echo $dados['nf'];?></p>
		  <p><b>UF Emitente:</b> <?php echo $dados['uf'];?></p>
          <p><b>Chave da NF:</b> <?php echo $dados['chavenf'];?></p>
		  <p><b>Data de Emissão:</b> <?php echo $dados['dtemi'];?></p>
		  <p><b>Situação Sefaz:</b> <?php echo $dados['motivo'];?></p>
		  <p><b>CNPJ Cliente:</b> <?php echo $dados['cnpljcli'];?></p>
		  <p><b>XML NF:</b> <a href='<?php echo $dados['xmlnf'];?>' target='_blank' download><?php echo $dados['xmlnf'];?></a></p>
          <hr>

        <?php }}}}
			?>
    </div>

    <!-- Optional JavaScript -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js"></script>
  </body>
</html>