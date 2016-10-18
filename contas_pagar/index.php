<?php
//PEGA DATA ATUAL
$datacorrente = date('Y-m-d');
$page = $_SERVER['REQUEST_URI'];

require '../db/database.php';
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
            <div class="alert alert-info"><h2>Contas à Pagar</h2></div>
            <a class="btn btn-default" href="createMensal.php">Criar Conta Mensal</a>
            <a class="btn btn-default" href="createExtra.php">Criar Conta Extra</a>
            <br/><br/>
            
            <div>
                <table class="table table-condensed">
                  <thead bgcolor="#D3D3D3">
                    <tr>
                      <th>Descrição</th>
                      <th>Valor</th>
                      <th>Vencimento</th>
                      <th>Tipo</th>
                      <th>Status</th>
                      <th>Ação</th>
                    </tr>
                  </thead>
                  <tbody>
                   
                   <?php
                   $pdo_index = Database::connect();
                   $prepara = $pdo_index->prepare('SELECT * FROM contas_a_pagar');
                   $prepara->execute();
                   while ( $row = $prepara->fetch()) {
                       if ($row['tipo']=='M'){echo "<tr bgcolor='#C7F5FF'>";
                       }else{echo "<tr bgcolor='#FDFFC7'>";}
                       $idConta = $row['idContaPagar'];
                       echo '<td>'. $row['descricao'] . '</td>';
                       echo '<td>'. $row['valor'] . '</td>';
                       echo '<td>'. date("d/m/Y", strtotime($row['dataVencimento'])) . '</td>';
                       echo '<td>'. $row['tipo'] . '</td>';
                       echo '<td>'. $row['statusPgto'] . '</td>';
                       
                       echo '<td width=250 align="center">';
                        echo '<a id="actionbtn" class="btn btn-success btn-xs" href="update.php?id='.$row['idContaPagar'].'">Update</a>';
                        echo ' ';
                        echo '<a id="actionbtn" class="btn btn-danger btn-xs" href="delete.php?id='.$row['idContaPagar'].'">Delete</a>';
                        echo ' ';
                        echo '<a id="actionbtn" class="btn btn-info btn-xs" href="pagar.php?id='.$row['idContaPagar'].'">Pagar</a>';
                        echo '</td>';
                        echo '</tr>';
                       
                   }
                   
                   Database::disconnect();
                  ?>   
                      
                  </tbody>
            </table>
        </div>
            
            
            <?php // echo $page; ?>
        </div>
    </body>
</html>
