<?php $page = $_SERVER['REQUEST_URI']; 
include '../db/database.php';
//Arquivos de login
include('../login/config.php');
include('../login/verifica_login.php');
include('../login/redirect.php');


?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />     
</head>

<?php //include ('../layout/headerlogado.php'); ?>
<?php include ('../layout/header.php'); ?>

<body>
    <div class="container">
        <div class="alert alert-info"><h3>Gerenciar Contas</h3></div>
    <!--<h3>Painel do Administrador</h3>-->
    <a class="btn btn-default" href="../conta/create.php">Criar Nova CONTA</a>
    <br/><br/>
    
    
            <div>
                <table class="table table-bordered table-hover">
                  <thead bgcolor="#D3D3D3">
                    <tr>
                      <th>Imagem</th>
                      <th>Descrição</th>
                      <th>Saldo</th>
                      <th>Ação</th>
                    </tr>
                  </thead>
                  <tbody>
                   
                   <?php
                   $pdo_index = Database::connect();
                   $prepara = $pdo_index->prepare('SELECT * FROM contas');
                   $prepara->execute();
                   while ( $row = $prepara->fetch()) {
                       $idConta = $row['idConta'];
                       echo '<tr>';
                       echo "<td><img height='70' width='70' src="
                                ."'".$row['foto']."'"
                               ."\></td>";
                       echo '<td>'. $row['descricao'] . '</td>';
                       echo '<td>'. $row['saldo'] . '</td>';
                       
                       echo '<td width=250 align="center">';
                        echo '<a id="actionbtn" class="btn btn-success" href="update.php?id='.$row['idConta'].'">Update</a>';
                        echo ' ';
                        echo '<a id="actionbtn" class="btn btn-danger" href="delete.php?id='.$row['idConta'].'">Delete</a>';
                        echo '</td>';
                        echo '</tr>';
                       
                   }
                   
                   Database::disconnect();
                  ?>   
                      
                  </tbody>
            </table>
        </div>
        <br/><br/>
        
    <?php // echo $page; ?>

    </div> <!-- /container -->

  </body>
</html>