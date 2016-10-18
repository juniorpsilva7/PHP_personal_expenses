<?php

require '../db/database.php';
include '../util/mes_toString.php';

//Arquivos de login
include('../login/config.php');
include('../login/verifica_login.php');
include('../login/redirect.php');

$nroMescorrente = date('m');

$id = null;
if ( !empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}
     
if ( null==$id ) {
    header("Location: index.php");
}
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
            <div class="alert alert-success"><h2>Compras do cartão <?php echo $id ?></h2></div>
            <a class="btn btn-default" href="index.php">Voltar ao Painel</a>
            <br/><br/>
    
            <!--LISTA TODAS AS PARCELAS DO MES-->
            <div>
                <h4>Vencendo esse Mês</h4>
                <table class="table table-bordered table-condensed">
                  <thead bgcolor="#D3D3D3">
                    <tr>
                      <th>Descrição</th>
                      <th>Data Compra</th>
                      <th>Valor Compra</th>
                      <th>Valor Parcela</th>
                      <th>Nro Parcela</th>
                      <th>Total Parcelas</th>
                      <th>Vencimento</th>
                    </tr>
                  </thead>
                  <tbody>
                   
                   <?php
                   $totalCompras = 0;
                   $pdo_index = Database::connect();
                   $prepara = $pdo_index->prepare('SELECT * FROM compras_cartao where MONTH(vencParcela) = ?');
                   $prepara->execute(array($nroMescorrente));
                   while ( $row = $prepara->fetch()) {                        
                       $idCompra = $row['idCompraCartao'];
                       echo '<tr>';
                       echo '<td>'. $row['descricao'] . '</td>';
                       echo '<td>'. date("d/m/Y", strtotime($row['dataCompra'])) . '</td>';
                       echo '<td>'. $row['valorTotal'] . '</td>';
                       echo '<td>'. $row['valorParcela'] . '</td>';
                       $totalCompras = $totalCompras + $row['valorParcela'];
                       echo '<td>'. $row['nrodaParcela'] . '</td>';
                       echo '<td>'. $row['parceladoEm'] . '</td>';
                       echo '<td>'. date("d/m/Y", strtotime($row['vencParcela'])) . '</td>';
                       
//                       echo '<td width=250 align="center">';
//                        echo '<a id="actionbtn" class="btn btn-success" href="update.php?id='.$row['idOperacao'].'">Update</a>';
//                        echo ' ';
//                        echo '<a id="actionbtn" class="btn btn-danger" href="delete.php?id='.$row['idOperacao'].'">Delete</a>';
//                        echo '</td>';
                       echo '</tr>';
                       
                   }
                   
                   Database::disconnect();
                  ?>   
                      
                  </tbody>
            </table>
                
                
                <h5><b>Compras no Cartão no Mês = R$
                    <?php echo $totalCompras ?></b></h5>
                
        </div>
            <br/><br/>
            
            
            <!--***** CALCULA PARA O MES ATUAL + 1 *****-->
            <?php 
            $mesSeguinte = $nroMescorrente + 1; 
            $mesSeguinte_string = mes_toString($mesSeguinte);
            ?>
            <h4>Para os Próximos Meses</h4><br/>
            
            <h5><b><?php echo $mesSeguinte_string ?></b></h5>
            <div>
                <table class="table table-bordered table-condensed">
                  <thead bgcolor="#D3D3D3">
                    <tr>
                      <th>Descrição</th>
                      <th>Valor Compra</th>
                      <th>Valor Parcela</th>
                      <th>Nro Parcela</th>
                      <th>Total Parcelas</th>
                      <th>Vencimento</th>
                    </tr>
                  </thead>
                  <tbody>
                   
                   <?php
//                   $mesSeguinte = $nroMescorrente + 1;
                   $totalCompras2 = 0;
                   $pdo_index = Database::connect();
                   $prepara = $pdo_index->prepare('SELECT * FROM compras_cartao where MONTH(vencParcela) = ?');
                   $prepara->execute(array($mesSeguinte));
                   while ( $row = $prepara->fetch()) {                        
                       $idCompra = $row['idCompraCartao'];
                       echo '<tr>';
                       echo '<td>'. $row['descricao'] . '</td>';
                       echo '<td>'. $row['valorTotal'] . '</td>';
                       echo '<td>'. $row['valorParcela'] . '</td>';
                       $totalCompras2 = $totalCompras2 + $row['valorParcela'];
                       echo '<td>'. $row['nrodaParcela'] . '</td>';
                       echo '<td>'. $row['parceladoEm'] . '</td>';
                       echo '<td>'. date("d/m/Y", strtotime($row['vencParcela'])) . '</td>';
                       echo '</tr>';
                       
                   }
                   
                   Database::disconnect();
                  ?>   
                      
                  </tbody>
            </table>
                <h5><b>Vencendo em <?php echo $mesSeguinte_string ?> = R$
                    <?php echo $totalCompras2 ?></b></h5>
            </div>
            <br/><br/>
            
            <!--***** CALCULA PARA O MES ATUAL + 2 *****-->
            <?php 
            $mesSeguinte2 = $nroMescorrente + 2; 
            $mesSeguinte2_string = mes_toString($mesSeguinte2);
            ?>
            <h5><b><?php echo $mesSeguinte2_string ?></b></h5>
            <div>
                <table class="table table-bordered table-condensed">
                  <thead bgcolor="#D3D3D3">
                    <tr>
                      <th>Descrição</th>
                      <th>Valor Compra</th>
                      <th>Valor Parcela</th>
                      <th>Nro Parcela</th>
                      <th>Total Parcelas</th>
                      <th>Vencimento</th>
                    </tr>
                  </thead>
                  <tbody>
                   
                   <?php
//                   $mesSeguinte = $nroMescorrente + 1;
                   $totalCompras3 = 0;
                   $pdo_index = Database::connect();
                   $prepara = $pdo_index->prepare('SELECT * FROM compras_cartao where MONTH(vencParcela) = ?');
                   $prepara->execute(array($mesSeguinte2));
                   while ( $row = $prepara->fetch()) {                        
                       $idCompra = $row['idCompraCartao'];
                       echo '<tr>';
                       echo '<td>'. $row['descricao'] . '</td>';
                       echo '<td>'. $row['valorTotal'] . '</td>';
                       echo '<td>'. $row['valorParcela'] . '</td>';
                       $totalCompras3 = $totalCompras3 + $row['valorParcela'];
                       echo '<td>'. $row['nrodaParcela'] . '</td>';
                       echo '<td>'. $row['parceladoEm'] . '</td>';
                       echo '<td>'. date("d/m/Y", strtotime($row['vencParcela'])) . '</td>';
                       echo '</tr>';
                       
                   }
                   
                   Database::disconnect();
                  ?>   
                      
                  </tbody>
            </table>
                <h5><b>Vencendo em <?php echo $mesSeguinte2_string ?>= R$
                    <?php echo $totalCompras3 ?></b></h5>
            </div>
            <br/><br/>
            
            
            <!--***** CALCULA PARA O MES ATUAL + 3 *****-->
            <?php 
            $mesSeguinte3 = $nroMescorrente + 3; 
            $mesSeguinte3_string = mes_toString($mesSeguinte3);
            ?>
            <h5><b><?php echo $mesSeguinte3_string ?></b></h5>
            <div>
                <table class="table table-bordered table-condensed">
                  <thead bgcolor="#D3D3D3">
                    <tr>
                      <th>Descrição</th>
                      <th>Valor Compra</th>
                      <th>Valor Parcela</th>
                      <th>Nro Parcela</th>
                      <th>Total Parcelas</th>
                      <th>Vencimento</th>
                    </tr>
                  </thead>
                  <tbody>
                   
                   <?php
//                   $mesSeguinte = $nroMescorrente + 1;
                   $totalCompras4 = 0;
                   $pdo_index = Database::connect();
                   $prepara = $pdo_index->prepare('SELECT * FROM compras_cartao where MONTH(vencParcela) = ?');
                   $prepara->execute(array($mesSeguinte3));
                   while ( $row = $prepara->fetch()) {                        
                       $idCompra = $row['idCompraCartao'];
                       echo '<tr>';
                       echo '<td>'. $row['descricao'] . '</td>';
                       echo '<td>'. $row['valorTotal'] . '</td>';
                       echo '<td>'. $row['valorParcela'] . '</td>';
                       $totalCompras4 = $totalCompras4 + $row['valorParcela'];
                       echo '<td>'. $row['nrodaParcela'] . '</td>';
                       echo '<td>'. $row['parceladoEm'] . '</td>';
                       echo '<td>'. date("d/m/Y", strtotime($row['vencParcela'])) . '</td>';
                       echo '</tr>';
                       
                   }
                   
                   Database::disconnect();
                  ?>   
                      
                  </tbody>
            </table>
                <h5><b>Vencendo em <?php echo $mesSeguinte3_string ?>= R$
                    <?php echo $totalCompras4 ?></b></h5>
            </div>
            <br/><br/>
            
            
            <h4>Todas Parcelas</h4>
            <!--LISTA TODAS AS PARCELAS-->
            <div>
                <table class="table table-bordered table-condensed">
                  <thead bgcolor="#D3D3D3">
                    <tr>
                      <th>Descrição</th>
                      <th>Valor Compra</th>
                      <th>Valor Parcela</th>
                      <th>Nro Parcela</th>
                      <th>Total Parcelas</th>
                      <th>Vencimento</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                   
                   <?php
                   $pdo_index = Database::connect();
                   $prepara2 = $pdo_index->prepare('SELECT * FROM compras_cartao');
                   $prepara2->execute();
                   while ( $row = $prepara2->fetch()) {                        
                       $idCompra = $row['idCompraCartao'];
                       echo '<tr>';
                       echo '<td>'. $row['descricao'] . '</td>';
                       echo '<td>'. $row['valorTotal'] . '</td>';
                       echo '<td>'. $row['valorParcela'] . '</td>';
                       echo '<td>'. $row['nrodaParcela'] . '</td>';
                       echo '<td>'. $row['parceladoEm'] . '</td>';
                       echo '<td>'. date("d/m/Y", strtotime($row['vencParcela'])) . '</td>';
                       
                       echo '<td width=250 align="center">';
//                        echo '<a id="actionbtn" class="btn btn-success" href="update.php?id='.$row['idOperacao'].'">Update</a>';
//                        echo ' ';
                        echo '<a id="actionbtn" class="btn btn-danger btn-xs" href="delete_compra.php?id='.$row['idCompraCartao'].'">Delete</a>';
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
