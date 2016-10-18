<?php

    require '../db/database.php';
    //Arquivos de login
    include('../login/config.php');
    include('../login/verifica_login.php');
    include('../login/redirect.php');

    
    $id = 0;
     
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( !empty($_POST)) {
        // keep track post values
        $id = $_POST['id'];
         
        // Remove e volta o valor à conta em questão
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //Identifica a Conta e o Valor a ser retornado
        $sql = "Select idConta, valor, tipo, transf_idContaOrig, transf_idContaDest 
            FROM operacoes where idOperacao = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $id_Conta = $data['idConta'];
        $tipoOp = $data['tipo'];
        $valorOp = $data['valor'];
        $conta_Orig = $data['transf_idContaOrig'];
        $conta_Dest = $data['transf_idContaDest'];
        
        //Retorna o valor à conta
        if($tipoOp=='E'){
            //Se for entrada deve subtrair o valor
            $sql2 = "UPDATE contas set saldo = saldo-? where idConta = ?";
            $q2 = $pdo->prepare($sql2);
            $q2->execute(array($valorOp, $id_Conta));
        }elseif($tipoOp=='S'){
            //Se for saída deve somar o valor
            $sql2 = "UPDATE contas set saldo = saldo+? where idConta = ?";
            $q2 = $pdo->prepare($sql2);
            $q2->execute(array($valorOp, $id_Conta));
        }elseif ($tipoOp=='T') {
            //Se for Transferencia ou Saque devolve os valores
            $sql2 = "UPDATE contas set saldo = saldo+? where idConta = ?";
            $q2 = $pdo->prepare($sql2);
            $q2->execute(array($valorOp, $conta_Orig));
            $sql3 = "UPDATE contas set saldo = saldo-? where idConta = ?";
            $q3 = $pdo->prepare($sql3);
            $q3->execute(array($valorOp, $conta_Dest));
        }
        
        
        $sql4 = "DELETE FROM operacoes WHERE idOperacao = ?";
        $q4 = $pdo->prepare($sql4);
        $q4->execute(array($id));
        Database::disconnect();
        header("Location: ../index.php");
         
    }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
</head>
<?php include ('../layout/header.php'); ?>
<br/>

<body>
    <div class="container" align="center">
        
                <div class="col-md-6 col-md-offset-3">
                    <div class="row">
                        <h3>Deletar esta Operacao?</h3>
                    </div>
                     
                    <form class="form-horizontal" action="delete.php" method="post">
                      <input type="hidden" name="id" value="<?php echo $id;?>"/>
                      <p class="alert alert-danger">Você tem certeza que deseja apagar ?</p>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-danger">Yes</button>
                          <a class="btn btn-info" href="index.php">No</a>
                        </div>
                    </form>
                </div>
        
    </div> <!-- /container -->
  </body>
  <script src="../js/bootstrap.min.js"></script>
</html>