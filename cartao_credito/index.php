<?php
////PEGA DATA ATUAL
//$datacorrente = date('Y-m-d');
//$page = $_SERVER['REQUEST_URI'];


include '../db/database.php';
//Arquivos de login
include('../login/config.php');
include('../login/verifica_login.php');
include('../login/redirect.php');


?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link   href="../css/bootstrap.min.css" rel="stylesheet">
        <title></title>
    </head>
    
    <?php include ('../layout/header.php'); ?>
    
    
    <body>
        <div class="container">
            <div class="alert alert-info"><h2>Gerenciar Cartões</h2></div>
            <a class="btn btn-default" href="create.php">Novo Cartão</a>
            <a class="btn btn-default" href="novacompra.php">Cadastrar Nova Compra</a>
            <br/><br/>

            <div>
                <!--<table class="table table-striped table-bordered">-->
                <table class="table table-bordered table-hover">
                  <thead bgcolor="#D3D3D3">
                    <tr>
                      <th>Descrição</th>
                      <th>Vence Dia</th>
                      <th>Ação</th>
                    </tr>
                  </thead>
                  <tbody>
                   
                   <?php
                   $pdo_index = Database::connect();
                   $prepara = $pdo_index->prepare('SELECT * FROM cartao_credito');
                   $prepara->execute();
                   while ( $row = $prepara->fetch()) {
                       $idCartao = $row['idCartao'];
                       echo '<tr>';
                       echo '<td>'. $row['descricao'] . '</td>';
                       echo '<td>'. $row['diaVencimento'] . '</td>';
                       
                       echo '<td width=250 align="center">';
                       echo '<a id="actionbtn" class="btn btn-warning" href="vercompras.php?id='.$row['idCartao'].'">Compras</a>';
                        echo ' ';
                        echo '<a id="actionbtn" class="btn btn-success" href="update.php?id='.$row['idCartao'].'">Update</a>';
                        echo ' ';
                        echo '<a id="actionbtn" class="btn btn-danger" href="delete.php?id='.$row['idCartao'].'">Delete</a>';
                        echo '</td>';
                        echo '</tr>';
                       
                   }
                   
                   Database::disconnect();
                  ?>   
                      
                    </tbody>
                    </table>
                </div>
            <br/>
            
            
            <?php // echo $page; ?>
        </div>
    </body>
</html>
