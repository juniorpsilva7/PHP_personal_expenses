<?php

require '../db/database.php';
//Arquivos de login
include('../login/config.php');
include('../login/verifica_login.php');
include('../login/redirect.php');


$nroMescorrente = date('m');
include '../util/mes_toString.php';
$mescorrente = mes_toString($nroMescorrente);

$valid = true;

if ( !empty($_POST)) {
    
    $saldoContaPrincipal = $_POST['saldoContaPrincipal'];
    $dataFech = $_POST['dataFechamento'];
    
    if ($valid) {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO fechamento (dataFechamento, saldoContaPrinc) 
                values(?, ?)";

        $q = $pdo->prepare($sql);
        $q->execute(array($dataFech, $saldoContaPrincipal));

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
        
        <a class="btn btn-default" href="../index.php">Voltar</a><br/><br/>
        
        <div class="col-xs-offset-1 col-md-6">
        <div class="bg-primary">
            <h3>Fechamento do mês de <?php echo $mescorrente ?></h3>
        </div>
        <br/>
        
        
        <!--INICIO DO FORMULARIO-->             
        <form class="form-horizontal" name="form1" action="fechamento.php" method="post" enctype="multipart/form-data">
            
            <!--DATA DE FECHAMENTO-->                
            <div class="control-group form-actions">
                <label class="control-label"><b>Data do Fechamento: </b></label>
                    <div class="controls">
                        <input name="dataFechamento" type="text" id="datepicker"/>
                    </div>
            </div>
            <br/> 
            
            <div>
            <label>Saldo na conta Principal (usar ponto ao invés de vírgula): </label>
                <input type="float" name="saldoContaPrincipal" size="10" placeholder="Valor"/>
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
