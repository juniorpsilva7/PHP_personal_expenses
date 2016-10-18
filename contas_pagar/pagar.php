<?php

    require '../db/database.php';
    $id = 0;
     
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( !empty($_POST)) {
        // keep track post values
        $id = $_POST['id'];
         
        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "Update contas_a_pagar set statusPgto = 'P' WHERE idContaPagar = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        Database::disconnect();
        header("Location: ../index/index.php");
         
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
                        <h3>Pagar?</h3>
                    </div>
                     
                    <form class="form-horizontal" action="pagar.php" method="post">
                      <input type="hidden" name="id" value="<?php echo $id;?>"/>
                      <p class="alert alert-danger">Você tem certeza que deseja pagar essa Conta?</p>
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