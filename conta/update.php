<?php

require '../db/database.php';
//Arquivos de login
include('../login/config.php');
include('../login/verifica_login.php');
include('../login/redirect.php');


$id = null;
if ( !empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}
     
if ( null==$id ) {
    header("Location: index.php");
}
     
if ( !empty($_POST)) {
    
    $descricao = $_POST['descricao'];
    $saldo = $_POST['saldo'];

    // validate input
    $valid = true;
         
        // update data
    if ($valid) {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE contas set descricao = ?, saldo = ? WHERE idConta = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($descricao, $saldo, $id));
        Database::disconnect();
        header("Location: index.php");
    }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM contas where idConta = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        
        $descricao = $data['descricao'];
        $saldo = $data['saldo'];
        
        Database::disconnect();
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
    <div class="container">
        <a class="btn btn-default" href="index.php">Voltar ao painel</a><br/>
        
                <div class="col-xs-offset-1 col-md-6">
                    
                    <div class="bg-warning">
                        <h3>Editar</h3>
                    </div>
             
                    <form class="form-horizontal" action="update.php?id=<?php echo $id?>" method="post">
                      
                        
                        <div>
                        <label>Descricao: </label>
                            <input type="text" name="descricao" size="50" placeholder="Descricao" value="<?php echo !empty($descricao)?$descricao:'';?>"/>
                        </div>
                        <br/>
                        
                        <div>
                        <label>Saldo: </label>
                            <input type="float" name="saldo" size="10" placeholder="Saldo Inicial" value="<?php echo !empty($saldo)?$saldo:'';?>"/>
                        </div>
                        <br/>                     
                        
                        
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Atualizar</button>
                          <br/><br/>
                          
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>