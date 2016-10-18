<?php

require '../db/database.php';
//Arquivos de login
include('../login/config.php');
include('../login/verifica_login.php');
include('../login/redirect.php');


//Executa consulta à tabela CARTAO_CREDITO
$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $pdo->prepare("select idCartao, descricao from cartao_credito");
$stmt->execute();
//Executa consulta à tabela CATEGORIAS
$stmt2 = $pdo->prepare("select idCategoria, descricao from categorias");
$stmt2->execute();


function addMonthIntoDate($date) {
     $this_year = substr ( $date, 0, 4 );
     $this_month = substr ( $date, 5, 2 );
     $this_day =  substr ( $date, 8, 2 );
     $next_date = mktime ( 0, 0, 0, $this_month + 1, $this_day, $this_year );
     return strftime("%Y-%m-%d", $next_date);
}


$valid = true;

if ( !empty($_POST)) {
    
    $cartao = $_POST['cartao'];
    $categoria= $_POST['categoria'];
    $descricao = $_POST['descricao'];
    $valor = $_POST['valor'];
    $parcelas = $_POST['parcelas'];
    $dataCompra = $_POST['dataCompra'];
    $dataVencPrimeira = $_POST['dataPrimeira'];

    
    
    if ($valid) {
        $nroParcela = 1;
        $valorParcela = ($valor / $parcelas) ;
        $vencimento = $dataVencPrimeira;
        
        for($i = 1; $i <= $parcelas; $i++){
        
        $sql = "INSERT INTO compras_cartao (idCartao, idCategoria, descricao, valorTotal, parceladoEm, dataCompra, nrodaParcela, valorParcela, vencParcela) 
                values(?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $q = $pdo->prepare($sql);
        $q->execute(array($cartao, $categoria, $descricao, $valor, $parcelas, $dataCompra, $nroParcela, $valorParcela, $vencimento));
        
        $nroParcela = $nroParcela + 1;
        $vencimento = addMonthIntoDate($vencimento);

        Database::disconnect();
        header("Location: index.php");
        }
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
        <div class="bg-primary">
            <h3>Entrada</h3>
        </div>
        <br/>
        
        
        <!--INICIO DO FORMULARIO-->             
        <form class="form-horizontal" name="form1" action="novacompra.php" method="post" enctype="multipart/form-data">
            
            <div>
            <label>Cartão de Crédito: </label>
                <select name="cartao">
                <?php
                    while($registros = $stmt->fetch(PDO::FETCH_OBJ)){
                    ?>
                    <option value="<?php echo $registros->idCartao;?>"><?php echo $registros->descricao;?></option>
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
            <label>Valor (usar ponto ao invés de vírgula): </label>
                <input type="float" name="valor" size="10" placeholder="Valor"/>
            </div>
            <br/>
            
            <div>
            <label>Número de Parcelas: </label>
                <input type="number" name="parcelas" size="5" placeholder="Parcelas"/>
            </div>
            <br/>
            
            <!--DATA DA COMPRA-->                
            <div class="control-group form-actions">
                <label class="control-label"><b>Data da Compra</b></label>
                    <div class="controls">
                        <input name="dataCompra" type="text" id="datepicker"/>
                    </div>
            </div>
            <br/>
            
            <!-- PRIMEIRA OCORRENCIA SERÁ EM -->                
            <div class="control-group form-actions">
                <label class="control-label"><b>Primeira occorencia será em: </b></label>
                    <div class="controls">
                        <input name="dataPrimeira" type="text" id="datepicker2"/>
                    </div>
            </div>
            
            
            
            
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
    $( "#datepicker2" ).datepicker({
        dateFormat: "yy-mm-dd"}
        );
    });
    </script>

</html>
