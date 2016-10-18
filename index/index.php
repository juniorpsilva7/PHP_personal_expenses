<?php
include '../db/database.php';

//Arquivos de login
include('../login/config.php');
include('../login/verifica_login.php');
include('../login/redirect.php');

//PEGA DATA ATUAL
$datacorrente = date('Y-m-d');
$nroMescorrente = date('m');



include '../util/mes_toString.php';
$mescorrente = mes_toString($nroMescorrente);

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
            <div align="center" class="alert alert-success"><h1><b><?php echo $mescorrente; ?></b></h1></div>
            
            <!--<a class="btn btn-warning" href="#">Registrar Saque</a>-->
            <!--<br/><br/>-->
            
            <!-- DIV DAS CONTAS A PAGAR -->
            <div class="container-fluid">
                <h4>Contas à Pagar</h4>
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
                   $totalMensalNP = 0;
                   $pdo_index = Database::connect();
                   $prepara = $pdo_index->prepare('SELECT * FROM contas_a_pagar where statusPgto="A" AND (MONTH(dataVencimento) = ? OR dataVencimento < ?) order by dataVencimento;');
                   $prepara->execute(array($nroMescorrente, $datacorrente));
                   while ( $row = $prepara->fetch()) {
                       if ($row['tipo']=='M'){echo "<tr bgcolor='#C7F5FF'>";
                       }else{echo "<tr bgcolor='#FDFFC7'>";}
                       $idConta = $row['idContaPagar'];
                       echo '<td>'. $row['descricao'] . '</td>';
                       echo '<td>'. $row['valor'] . '</td>';
                       $totalMensalNP = $totalMensalNP + $row['valor'];
                       echo '<td>'. date("d/m/Y", strtotime($row['dataVencimento'])) . '</td>';
                       echo '<td>'. $row['tipo'] . '</td>';
                       echo '<td>'. $row['statusPgto'] . '</td>';
                       
                       if($row['dataVencimento'] <= $datacorrente){
                            echo '<td width=250 align="center">';
                       echo '<a id="actionbtn" class="btn btn-danger btn-xs" href="../contas_pagar/pagar.php?id='.$row['idContaPagar'].'">Pagar</a>';
                       echo '</td>';
                       }else{
                            echo '<td width=250 align="center">';
                       echo '<a id="actionbtn" class="btn btn-primary btn-xs" href="../contas_pagar/pagar.php?id='.$row['idContaPagar'].'">Pagar</a>';
                       echo '</td>';
                       }
                       
                      
                       
                       echo '</tr>';
                       
                   }
                   
                   Database::disconnect();
                  ?>   
                      
                  </tbody>
            </table>
                
            <h5><b>Contas Pagas</b></h5>        
            <table class="table table-condensed">
                  <thead bgcolor="#D3D3D3">
                    <tr>
                      <th>Descrição</th>
                      <th>Valor</th>
                      <th>Vencimento</th>
                      <th>Tipo</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                   
                   <?php
                   $totalMensalPG = 0;
                   $pdo_index = Database::connect();
                   $prepara = $pdo_index->prepare('SELECT * FROM contas_a_pagar where statusPgto="P" AND MONTH(dataVencimento) = ? order by dataVencimento;');
                   $prepara->execute(array($nroMescorrente));
                   while ( $row = $prepara->fetch()) {
                        if ($row['tipo']=='M'){echo "<tr bgcolor='#C7F5FF'>";
                        }else{echo "<tr bgcolor='#FDFFC7'>";}
                        $idConta = $row['idContaPagar'];
                        echo '<td>'. $row['descricao'] . '</td>';
                        echo '<td>'. $row['valor'] . '</td>';
                        $totalMensalPG = $totalMensalPG + $row['valor'];
                        echo '<td>'. date("d/m/Y", strtotime($row['dataVencimento'])) . '</td>';
                        echo '<td>'. $row['tipo'] . '</td>';
                        echo '<td>'. $row['statusPgto'] . '</td>';
                        echo '</tr>';
                       
                   }
                   
                   Database::disconnect();
                  ?>   
                      
                  </tbody>
            </table>       
            
            <h5><b>Gasto Médio Mensal = 
                    <?php echo $totalMensal=$totalMensalNP+$totalMensalPG; ?></b></h5>
                    
            </div>
                
            </div>
        </div>
            
            <div class="container">
            <!-- DIV DAS CONTAS BANCÁRIAS -->
            <div class="container col-lg-6">
            <!--<div class="alert alert-info" class="col-md-2">-->
            <div class="alert badge" class="col-md-2">
                <div align='center'>
                    <a class="btn btn-success btn-xs" href="../operacao/entrada.php">Cadastrar Entrada</a>
                    <a class="btn btn-danger btn-xs" href="../operacao/saida.php">Cadastrar Saída</a>
                    <a class="btn btn-info btn-xs" href="../operacao/transferencia.php">Transferência ou Saque</a>
                    
                    </div><br/>
            <table class="table table-condensed">
                  <thead bgcolor="#D3D3D3">
                    <tr>
                      <th class="col-md-1">Imagem</th>
                      <th class="col-md-3">Descrição</th>
                      <th class="col-md-1">Saldo</th>
                    </tr>
                  </thead>
                  <tbody>
                   
                   <?php
                   $saldoTotal = 0;
                   $pdo_index = Database::connect();
                   $prepara = $pdo_index->prepare('SELECT * FROM contas');
                   $prepara->execute();
                   while ( $row = $prepara->fetch()) {
                       $idConta = $row['idConta'];
                       echo '<tr>';
                       echo "<td><img height='40' width='40' src="
                                ."'".$row['foto']."'"
                               ."\></td>";
                       echo '<td>'. $row['descricao'] . '</td>';
                       echo '<td><b>'. $row['saldo'] . '</b></td>';
                       $saldoTotal = $saldoTotal + $row['saldo'];
                        echo '</tr>';
                       
                   }
                   
                   Database::disconnect();
                  ?>   
                      
                  </tbody>
            </table>
                <h4><b>Saldo Total = 
                    <?php if($saldoTotal<0){
                        echo '<font color="#FF9090">'.$saldoTotal.'</font>';
                    }else{echo $saldoTotal;} 
                ?></b></h4><a class="btn btn-default btn-xs" href="../conta/fechamento.php">Fechamento</a>
            </div>
            
            <br/>
            <?php include '../categoria/estatistica_tabela.php'; ?>
            
            </div>
            
            <!-- DIV DAS OPERAÇÕES -->
            <div class="container col-lg-6">
            
                <div>
                <table class="table table-bordered table-condensed">
                  <thead bgcolor="#D3D3D3">
                    <tr>
                      <th>Conta</th>
                      <th>Tipo</th>
                      <th>Descrição</th>
                      <th>Valor</th>
                      <th>Data</th>
                    </tr>
                  </thead>
                  <tbody>
                   
                   <?php
                   $pdo_index = Database::connect();
                   $prepara = $pdo_index->prepare('
                       SELECT op.idOperacao, op.tipo, op.descricao, op.valor, op.dataOperacao, ct.descricao 
                       FROM operacoes as op join contas as ct 
                       where op.idConta=ct.idConta
                       AND MONTH(op.dataOperacao) = ?
                       order by op.dataOperacao');
                   $prepara->execute(array($nroMescorrente));
                   
                   $totalEntradas = 0;
                   $totalSaidas = 0;
                   
                   while ( $row = $prepara->fetch()) {
                       
                       //Comparação para colorir as linhas de acordo com o tipo
                       if ($row['tipo']=='E'){
                           echo "<tr bgcolor='#C7F5FF'>";
                           $totalEntradas = $totalEntradas + $row['valor'];
                       }elseif ($row['tipo']=='S'){
                           echo "<tr bgcolor='#FFDCDC'>";
                           $totalSaidas = $totalSaidas + $row['valor'];
                           }else{
                               echo "<tr bgcolor='#B2FFDF' >";                               
                           }
                       $idConta = $row['idOperacao'];
                       echo '<td>'. $row['descricao'] . '</td>';
                       echo '<td>'. $row['tipo'] . '</td>';
                       echo '<td>'. $row[2] . '</td>';
                       echo '<td>'. $row['valor'] . '</td>';
                       echo '<td>'. date("d/m/Y", strtotime($row['dataOperacao'])) . '</td>';
                   }
                   
                   ;
                   
                   Database::disconnect();
                  ?>   
                      
                  </tbody>
            </table>
                    <h4>Total de Entradas: <?php echo $totalEntradas; ?></h4>
                    <h4>Total de Saídas: <?php echo $totalSaidas; ?></h4>
            </div>
            </div>
            
            </div>
        <br/><br/>
                
        
        <!--***** CARTÃO DE CRÉDITO *****-->
        <font size=2px>
            <div class="container">
            
            <div class="panel panel-primary">
                <div class="panel-heading"><h4 class="panel-title">Cartão de Crédito</h4></div>
                <div class="panel-body">
                <h5><b><?php echo $mescorrente ?></b></h5>
                <table class="table table-bordered table-hover table-condensed">
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
                   $totalCompras = 0;
                   $pdo_index = Database::connect();
                   $prepara = $pdo_index->prepare('SELECT * FROM compras_cartao where MONTH(vencParcela) = ?');
                   $prepara->execute(array($nroMescorrente));
                   while ( $row = $prepara->fetch()) {                        
                       $idCompra = $row['idCompraCartao'];
                       echo '<tr>';
                       echo '<td>'. $row['descricao'] . '</td>';
                       echo '<td>'. $row['valorTotal'] . '</td>';
                       echo '<td>'. $row['valorParcela'] . '</td>';
                       $totalCompras = $totalCompras + $row['valorParcela'];
                       echo '<td>'. $row['nrodaParcela'] . '</td>';
                       echo '<td>'. $row['parceladoEm'] . '</td>';
                       echo '<td>'. date("d/m/Y", strtotime($row['vencParcela'])) . '</td>';
                       echo '</tr>';                   
                   }
                   Database::disconnect();
                  ?>   
                  </tbody>
            </table>
                <h5><b>Vencendo em <?php echo $mescorrente ?> = R$
                    <?php echo $totalCompras ?></b></h5>
                <br/>
            
            <!--***** CALCULA PARA O MES ATUAL + 1 *****-->
            <?php 
            $mesSeguinte = $nroMescorrente + 1; 
            $mesSeguinte_string = mes_toString($mesSeguinte);
            ?>            
            <h5><b><?php echo $mesSeguinte_string ?></b></h5>
            <div>
                <table class="table table-bordered table-hover table-condensed">
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
            </div>
            </div>
            
        </div></font>
        <br/>
    </body>
</html>
