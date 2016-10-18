<?php
//PEGA DATA ATUAL
$datacorrente = date('Y-m-d');
$page = $_SERVER['REQUEST_URI'];

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
            <div class="alert alert-info"><h2>Gerenciar Operações</h2></div>
            <a class="btn btn-default" href="entrada.php">Cadastrar Entrada</a>
            <a class="btn btn-default" href="saida.php">Cadastrar Saída</a>
            <a class="btn btn-default" href="transferencia.php">Transferência entre Contas</a>
            <br/><br/>
    
            <div>
                <table class="table table-bordered table-condensed">
                  <thead bgcolor="#D3D3D3">
                    <tr>
                      <th>Conta</th>
                      <th>Tipo</th>
                      <th>Descrição</th>
                      <th>Valor</th>
                      <th>Data</th>
                      <th>Ação</th>
                    </tr>
                  </thead>
                  <tbody>
                   
                   <?php
                   
                   
                   
                   $pdo_index = Database::connect();
                   $busca = 'SELECT * FROM operacoes';
                   $prepara = $pdo_index->prepare($busca);
                   $prepara->execute();
                   
                   //PAGINAÇAO

                   //verifica a página atual caso seja informada na URL, senão atribui como 1ª página
                   $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;
//                   $total = mysql_num_rows($prepara);
                   $rows = $prepara->fetchAll();
                   $total = count($rows);
                   echo $total;
                   //seta a quantidade de itens por página, neste caso, 2 itens
                   $registros = 2;
                   //calcula o número de páginas arredondando o resultado para cima
                   $numPaginas = ceil($total/$registros);
                   //variavel para calcular o início da visualização com base na página atual
                   $inicio = ($registros*$pagina)-$registros;
                   //seleciona os itens por página
                   $cmd = "$busca limit $inicio,$registros";
                   $prepara = $pdo_index->prepare($cmd);
//                   $total = mysql_num_rows($prepara2);
//                   $total = $prepara->fetchColumn();
                   
//                   while ( $row = $prepara->fetch()) {
                   while ( $row = $prepara->fetch()) {
                       
                       //Comparação para colorir as linhas de acordo com o tipo
                       if ($row['tipo']=='E'){echo "<tr bgcolor='#C7F5FF'>";
                       }elseif ($row['tipo']=='S'){echo "<tr bgcolor='#FFDCDC'>";
                           }else{
                               echo "<tr bgcolor='#B2FFDF' >";                               
                           }
                       $idConta = $row['idOperacao'];
//                       echo '<tr>';
                       echo '<td>'. $row['idConta'] . '</td>';
                       echo '<td>'. $row['tipo'] . '</td>';
                       echo '<td>'. $row['descricao'] . '</td>';
                       echo '<td>'. $row['valor'] . '</td>';
                       echo '<td>'. date("d/m/Y", strtotime($row['dataOperacao'])) . '</td>';
                       
                       echo '<td width=250 align="center">';
                        echo '<a id="actionbtn" class="btn btn-danger btn-xs" href="delete.php?id='.$row['idOperacao'].'">Delete</a>';
                        echo '</td>';
                        echo '</tr>';
                       
                   }
                   
                   //exibe a paginação
//                for($i = 1; $i < $numPaginas + 1; $i++) {
//                    echo "<a href='index.php?pagina=$i'>".$i."</a> ";
//        }
//                   
                   
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
