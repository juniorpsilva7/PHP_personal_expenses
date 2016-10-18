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
$stmt2 = $pdo->prepare("select idConta, descricao from contas");
$stmt2->execute();


$valid = true;

if ( !empty($_POST)) {
    
    $valor = $_POST['valor'];
    $dataOperacao = $_POST['dataOp'];
    $contaOrig = $_POST['contaOrig'];
    $contaDest = $_POST['contaDest'];
    
    //***** String para o campo Descricação deve ficar "TRANSF de X para Y"
    //Consulta tabela Contas pra pegar o nome
    $stmt3 = $pdo->prepare("select descricao from contas where idConta=?");
    $stmt3->execute(array($contaOrig));
    // Pesquisa conta de Origem
    $data = $stmt3->fetch(PDO::FETCH_ASSOC);
    $desc_contaOrig = $data['descricao'];
    // Pesquisa conta de Destino
    $stmt3->execute(array($contaDest));
    $data = $stmt3->fetch(PDO::FETCH_ASSOC);
    $desc_contaDest = $data['descricao'];
    // Concatena
    $string_descricao = "Transf " .$desc_contaOrig." >> ".$desc_contaDest;
    //***** FIM Concatenação para descricao
    
    
    if ($valid) {
        $sql = "INSERT INTO operacoes (tipo, descricao, valor, dataOperacao, transf_idContaOrig, transf_idContaDest) 
                values(?, ?, ?, ?, ?, ?)";

        $q = $pdo->prepare($sql);
        $q->execute(array('T', $string_descricao, $valor, $dataOperacao, $contaOrig, $contaDest));


//Subtrai da Conta Origem
        $sql2 = "UPDATE contas set saldo = saldo-? where idConta = ?";
        $q2 = $pdo->prepare($sql2);
        $q2->execute(array($valor, $contaOrig));

//Soma na conta destino
        $sql3 = "UPDATE contas set saldo = saldo+? where idConta = ?";
        $q3 = $pdo->prepare($sql3);
        $q3->execute(array($valor, $contaDest));
        
        
        Database::disconnect();
        header("Location: ../index.php");
        
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" /> 
    <link rel="stylesheet" href="../css/jquery-ui.css">
</head>
<?php include ('../layout/header.php'); ?>
<body>
    <div class="container">
        
        <a class="btn btn-default" href="index.php">Voltar ao Painel</a><br/><br/>
        
        <div class="col-xs-offset-1 col-md-6">
        <div class="bg-info">
            <h3>Transferir</h3>
        </div>
        <br/>
        
        
        <!--INICIO DO FORMULARIO-->             
        <form class="form-horizontal" name="form1" action="transferencia.php" method="post" enctype="multipart/form-data">            
            
            <!--DATA DA OPERAÇÃO-->                
            <div class="control-group form-actions">
                <label class="control-label"><b>Data Operação</b></label>
                    <div class="controls">
                        <input name="dataOp" type="text" id="datepicker"/>
                    </div>
            <br/>
            
            <div>
            <label>Valor (usar ponto ao invés de vírgula): </label>
                <input type="float" name="valor" size="10" placeholder="Valor"/>
            </div>
            <br/>
            
            <div>
            <label>Conta Origem: </label>
                <select name="contaOrig">
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
            <label>Conta Destino: </label>
                <select name="contaDest">
                <?php
                    while($registros = $stmt2->fetch(PDO::FETCH_OBJ)){
                    ?>
                    <option value="<?php echo $registros->idConta;?>"><?php echo $registros->descricao;?></option>
                    <?php                
                    }
                    ?>
                </select>
            </div>
            <br/>
            
            
            
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
