<?php

require '../db/database.php';
//Arquivos de login
include('../login/config.php');
include('../login/verifica_login.php');
include('../login/redirect.php');


$valid = true;

if ( !empty($_POST)) {
    
    $descricao = $_POST['descricao'];
    $valor = $_POST['valor'];
    $dataVenc = $_POST['dataVenc'];
    
    if ($valid) {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO contas_a_pagar (descricao, valor, dataVencimento, tipo, statusPgto) 
                values(?, ?, ?, ?, ?)";

        $q = $pdo->prepare($sql);
        $q->execute(array($descricao, $valor, $dataVenc, 'E', 'A'));

        Database::disconnect();
        header("Location: index.php");
        
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" /> 
    <link rel="stylesheet" href="../css/jquery-ui.css">
</head>
<?php include ('../layout/header.php'); ?>
<body>
    <div class="container">
        
        <a class="btn btn-default" href="index.php">Voltar ao Painel</a><br/><br/>
        
        <div class="col-xs-offset-1 col-md-6">
        <div class="bg-primary">
            <h3>Conta Extra</h3>
        </div>
        <br/>
        
        
        <!--INICIO DO FORMULARIO-->             
        <form class="form-horizontal" name="form1" action="createExtra.php" method="post" enctype="multipart/form-data">
            
           
            <div>
            <label>Descrição: </label>
                <input type="text" name="descricao" size="50" placeholder="Descricao"/>
            </div>
            <br/>
            
            <div>
            <label>Valor (usar ponto ao invés de vírgula): </label>
                <input type="float" name="valor" size="10" placeholder="Valor"/>
            </div>
            <br/>
            
            <!--DATA DE VENCIMENTO-->                
            <div class="control-group form-actions">
                <label class="control-label"><b>Data Vencimento</b></label>
                    <div class="controls">
                        <input name="dataVenc" type="text" id="datepicker"/>
                    </div>
            </div>
            <br/>            
            
            
            <!--   BOTÃO SUBMIT   --><br/><br/>
            <div class="form-actions">
                <button class="btn btn-success" type="submit">Criar</button>                
            </div>
        </form>
        </div>
    </div>    
</body>


<!--COMPONENTES DO DATEPICKER-->
  <script type="text/javascript" src="../js/jquery_1_6_2.min.js"></script>
  <script src="../js/jquery-ui_1_8.min.js"></script>
    <script>
    $(function() {
    $( "#datepicker" ).datepicker({
        dateFormat: "yy-mm-dd"}
        );
    });
    </script>

</html>
