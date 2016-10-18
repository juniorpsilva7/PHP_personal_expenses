<?php

require '../db/database.php';
//Arquivos de login
include('../login/config.php');
include('../login/verifica_login.php');
include('../login/redirect.php');


// FUNÇÃO QUE SOMA DIAS
//function addDayIntoDate($date,$days) {
//     $this_year = substr ( $date, 0, 4 );
//     $this_month = substr ( $date, 5, 2 );
//     $this_day =  substr ( $date, 8, 2 );
//     $next_date = mktime ( 0, 0, 0, $this_month, $this_day + $days, $this_year );
//     return strftime("%Y-%m-%d", $next_date);
//}

function addMonthIntoDate($date) {
     $this_year = substr ( $date, 0, 4 );
     $this_month = substr ( $date, 5, 2 );
     $this_day =  substr ( $date, 8, 2 );
     $next_date = mktime ( 0, 0, 0, $this_month + 1, $this_day, $this_year );
     return strftime("%Y-%m-%d", $next_date);
}


$valid = true;

if ( !empty($_POST)) {
    
    $descricao = $_POST['descricao'];
    $valor = $_POST['valor'];
    $dataVencPrimeira = $_POST['dataVencPrimeira'];
    $ocorrencias = $_POST['ocorrencias'];


    
    
    if ($valid) {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $vencimento = $dataVencPrimeira;
        
        for($i = 1; $i <= $ocorrencias; $i++){
        
        $sql = "INSERT INTO contas_a_pagar (descricao, valor, dataVencimento, tipo, statusPgto) 
                values(?, ?, ?, ?, ?)";

        $q = $pdo->prepare($sql);
        $q->execute(array($descricao, $valor, $vencimento, 'M', 'A'));
        
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
            <h3>Conta Mensal</h3>
        </div>
        <br/>
        
        
        <!--INICIO DO FORMULARIO-->             
        <form class="form-horizontal" name="form1" action="createMensal.php" method="post" enctype="multipart/form-data">
            
           
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
            
            <!--VENCIMENTO DA PRIMEIRA OCORRÊNCIA-->                
            <div class="control-group form-actions">
                <label class="control-label"><b>Vencimento da Primeira Ocorrencia</b></label>
                    <div class="controls">
                        <input name="dataVencPrimeira" type="text" id="datepicker"/>
                    </div>
            </div>
            <br/> 
            
            <div>
            <label>Gerar para quantos meses? </label>
                <input type="number" name="ocorrencias" size="50" placeholder="Ocorrencias"/>
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
