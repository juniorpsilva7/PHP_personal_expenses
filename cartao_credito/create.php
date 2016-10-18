<?php

require '../db/database.php';
//Arquivos de login
include('../login/config.php');
include('../login/verifica_login.php');
include('../login/redirect.php');

$valid = true;

if ( !empty($_POST)) {        

    $descricao = $_POST['descricao'];
    $diaVenc = $_POST['diaVencimento'];
    
    
    if ($valid) {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO cartao_credito (descricao, diaVencimento) 
                values(?, ?)";

        $q = $pdo->prepare($sql);
        $q->execute(array($descricao, $diaVenc));

        Database::disconnect();
        header("Location: index.php");
        
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />       
</head>
<?php include ('../layout/header.php'); ?>
<body>
    <div class="container">
        
        <a class="btn btn-default" href="index.php">Voltar ao Painel de Cartões</a><br/><br/>
        
        <div class="col-xs-offset-1 col-md-6">
        <div class="bg-primary">
            <h3>Novo Cartão</h3>
        </div>
        <br/>
        
        
        <!--INICIO DO FORMULARIO-->             
        <form class="form-horizontal" name="form1" action="create.php" method="post" enctype="multipart/form-data">
            
            <div>
            <label>Descricao: </label>
                <input type="text" name="descricao" size="50" placeholder="Descricao"/>
            </div>
            <br/>
            
            <div>
            <label>Dia de Vencimento: </label>
                <input type="number" name="diaVencimento" size="10" placeholder="Descricao"/>
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
</html>
