<?php

require '../db/database.php';
//Arquivos de login
include('../login/config.php');
include('../login/verifica_login.php');
include('../login/redirect.php');


//Executa consulta à tabela CONTAS
$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $pdo->prepare("select idConta, descricao from contas");
$stmt->execute();
//Executa consulta à tabela CATEGORIAS
$stmt2 = $pdo->prepare("select idCategoria, descricao from categorias");
$stmt2->execute();

$valid = true;

if ( !empty($_POST)) {
    
    $conta = $_POST['conta'];
    $categoria= $_POST['categoria'];
    $descricao = $_POST['descricao'];
    $valor = $_POST['valor'];
    $dataOperacao = $_POST['dataOp'];
//    $contaOrig = $_POST['contaOrig'];
//    $contaDest = $_POST['contaDest'];
    
    
    if ($valid) {
        $sql = "INSERT INTO operacoes (idConta, idCategoria, tipo, descricao, valor, dataOperacao) 
                values(?, ?, ?, ?, ?, ?)";

        $q = $pdo->prepare($sql);
        $q->execute(array($conta, $categoria, 'E', $descricao, $valor, $dataOperacao));


//Soma ao Saldo da Conta em questao
        $sql2 = "UPDATE contas set saldo = saldo+? where idConta = ?";
        $q2 = $pdo->prepare($sql2);
        $q2->execute(array($valor, $conta));

        Database::disconnect();
        header("Location: ../index.php");
        
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" /> 
    <!--<link rel="stylesheet" href="../css/jquery-ui.css">-->
</head>
<?php include ('../layout/header.php'); ?>
<body>
    <div class="container">
        
        <a class="btn btn-default" href="index.php">Voltar ao Painel</a><br/><br/>
        
        <div class="col-xs-offset-1 col-md-6">
        <div class="bg-primary">
            <h3>Entrada</h3>
        </div>
        <br/>
        
        
        <!--INICIO DO FORMULARIO-->             
        <form class="form-horizontal" name="form1" action="entrada.php" method="post" enctype="multipart/form-data">
            
            <div>
            <label>Conta: </label>
                <select name="conta">
                <?php
                    while($registros = $stmt->fetch(PDO::FETCH_OBJ)){
                    ?>
                    <option value="<?php echo $registros->idConta;?>"><?php echo $registros->descricao;?></option>
                    <?php                
                    }
                    ?>
                </select>
            </div>
            <br/>
            
            <div>
            <label>Categoria: </label>
                <select name="categoria">
                <?php
                    while($registros = $stmt2->fetch(PDO::FETCH_OBJ)){
                    ?>
                    <option value="<?php echo $registros->idCategoria;?>"><?php echo $registros->descricao;?></option>
                    <?php                
                    }
                    ?>
                </select>
            </div>
            <br/>
            
            <div>
            <label>Descrição: </label>
                <input type="text" name="descricao" size="50" placeholder="Descricao"/>
            </div>
            <br/>
            
            <div>
            <label>Valor (usar ponto ao invés de vírgula): </label>
                <input type="float" name="valor" size="10" placeholder="Valor"/>
            </div>
            <br/>
            
            <!--DATA DA OPERAÇÃO-->                
            <div class="control-group form-actions">
                <label class="control-label"><b>Data Operação</b></label>
                    <div class="controls">
                        <input name="dataOp" type="text" id="datepicker"/>
                    </div>
            <br/>
            
<!--            <div>
            <label>Conta Origem: </label>
                <input type="text" name="contaOrig" size="20" disabled/>
            </div>
            <br/>
            
            <div>
            <label>Conta Destino: </label>
                <input type="text" name="contaDest" size="20" disabled/>
            </div>
            <br/>-->
            
            
            
            <!--   BOTÃO SUBMIT   --><br/><br/>
            <div class="form-actions">
                <button class="btn btn-success" type="submit">Criar</button>                
            </div>
        </form>
        </div>
    </div>    
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
