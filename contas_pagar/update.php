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
    $valor = $_POST['valor'];
    $dataVenc = $_POST['dataVenc'];
    $tipo = $_POST['tipo'];
    $status = $_POST['status'];

    // validate input
    $valid = true;
         
        // update data
    if ($valid) {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE contas_a_pagar set descricao=?, valor=?, dataVencimento=?, tipo=?, statusPgto=? WHERE idContaPagar = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($descricao, $valor, $dataVenc, $tipo, $status, $id));
        Database::disconnect();
        header("Location: index.php");
    }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM contas_a_pagar where idContaPagar = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        
        $descricao = $data['descricao'];
        $valor = $data['valor'];
        $dataVenc = $data['dataVencimento'];
        $tipo = $data['tipo'];
        $status = $data['statusPgto'];
        
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
                        <label>Descrição: </label>
                            <input type="text" name="descricao" size="50" placeholder="Descricao" value="<?php echo !empty($descricao)?$descricao:'';?>"/>
                        </div>
                        <br/>
                        
                        <div>
                        <label>Valor (usar ponto ao invés de vírgula): </label>
                            <input type="float" name="valor" size="10" placeholder="Valor" value="<?php echo !empty($valor)?$valor:'';?>"/>
                        </div>
                        <br/>     
                        
                        <!--VENCIMENTO-->                
                        <div class="control-group form-actions">
                            <label class="control-label"><b>Vencimento: </b></label>
                                <div class="controls">
                                    <input name="dataVenc" type="text" id="datepicker" value="<?php echo !empty($dataVenc)?$dataVenc:'';?>"/>
                                </div>
                        </div>
                        <br/>  
                       
                        <div>
                        <label>Tipo: </label>
                            <input type="text" name="tipo" size="2" placeholder="Valor" value="<?php echo !empty($tipo)?$tipo:'';?>"/>
                        </div>
                        <br/> 
                        
                        <div>
                        <label>Status: </label>
                            <input type="text" name="status" size="2" placeholder="Valor" value="<?php echo !empty($status)?$status:'';?>"/>
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
  
  <!--COMPONENTES DO DATEPICKER-->
  <script type="text/javascript" src="../js/jquery_1_6_2.min.js"></script>
  <script src="../js/jquery-ui_1_8.min.js"></script>
    <script>
    $(function() {
    $( "#datepicker" ).datepicker({
        dateFormat: "yy-mm-dd"}
        );
    });
    </script>
  
</html>