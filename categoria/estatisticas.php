<?php
include '../db/database.php';
include '../util/mes_toString.php';
//Arquivos de login
include('../login/config.php');
include('../login/verifica_login.php');
include('../login/redirect.php');



//PEGA DATA ATUAL
$datacorrente = date('Y-m-d');
$page = $_SERVER['REQUEST_URI'];
$nroMescorrente = date('m');
$mescorrente = mes_toString($nroMescorrente);

if ( !empty($_POST)) {
    $mesEstatistica = $_POST['mes'];
    $nroMescorrente = $mesEstatistica;
    $mescorrente = mes_toString($nroMescorrente);
}


//Calculos
$pdo_index = Database::connect();
$prepara = $pdo_index->prepare('
    SELECT idOperacao, idCategoria, valor, dataOperacao 
    FROM operacoes
    WHERE MONTH(dataOperacao) = ?');
$prepara->execute(array($nroMescorrente));
//variáveis
$aluguel_cond = 0;
$luz_tv_net_tel = 0;
$bar_restaurantes = 0;
$combustivel = 0;
$carroGeral = 0;
$cartaoCredito = 0;
$taxasJuros = 0;
$vestuario = 0;
$viagens = 0;
$farmacia = 0;

//Seta todas as cores para verde
$cor1=$cor2=$cor3=$cor4=$cor5=$cor6=$cor7=$cor8=$cor9=$cor10='#CBFFC9';

  while ( $row = $prepara->fetch()) {
     //SE FOR Aluguel/Condomínio
     if ($row['idCategoria']==3){
         $max1 = 1101;
         $aluguel_cond = $aluguel_cond + $row['valor'];
         
         if(($aluguel_cond/$max1)<0.3){
            $cor1='#CBFFC9';    
         }elseif(($aluguel_cond/$max1)<0.7){
            $cor1='#FFF1C9';
         }elseif(($aluguel_cond/$max1)<1){
             $cor1='#FFDE82';
         }else{
             $cor1='#FFDCDC';
         }
     }
     // SE FOR Luz / TC / Net / Telefone
     elseif($row['idCategoria']==17 || $row['idCategoria']==31 || $row['idCategoria']==30){
         $max2 = 200;
         $luz_tv_net_tel = $luz_tv_net_tel + $row['valor'];
         
         if(($luz_tv_net_tel/$max2)<0.3){
            $cor2='#CBFFC9';    
         }elseif(($luz_tv_net_tel/$max2)<0.7){
            $cor2='#FFF1C9';
         }elseif(($luz_tv_net_tel/$max2)<1){
             $cor2='#FFDE82';
         }else{
             $cor2='#FFDCDC';
         }
         
     }
     //SE FOR bar / restaurantes
     elseif ($row['idCategoria']==4){
         $max3 = 150;
         $bar_restaurantes = $bar_restaurantes + $row['valor'];
         
         if(($bar_restaurantes/$max3)<0.3){
            $cor3='#CBFFC9';    
         }elseif(($bar_restaurantes/$max3)<0.7){
            $cor3='#FFF1C9';
         }elseif(($bar_restaurantes/$max3)<1){
             $cor3='#FFDE82';
         }else{
             $cor3='#FFDCDC';
         }
     }
     //SE FOR combustível
     elseif($row['idCategoria']==8){
         $max4=120;
         $combustivel = $combustivel + $row['valor'];
         
         if(($combustivel/$max4)<0.3){
            $cor4='#CBFFC9';    
         }elseif(($combustivel/$max4)<0.7){
            $cor4='#FFF1C9';
         }elseif(($combustivel/$max4)<1){
             $cor4='#FFDE82';
         }else{
             $cor4='#FFDCDC';
         }
         
     }
     //SE FOR carro em geral
     elseif($row['idCategoria']==8 || $row['idCategoria']==11 || $row['idCategoria']==15 || 
             $row['idCategoria']==16 || $row['idCategoria']==19 || $row['idCategoria']==26 ||
             $row['idCategoria']==27){
         $max5=700;
         $carroGeral = $carroGeral + $row['valor'];
         
         if(($carroGeral/$max5)<0.3){
            $cor5='#CBFFC9';    
         }elseif(($carroGeral/$max5)<0.7){
            $cor5='#FFF1C9';
         }elseif(($carroGeral/$max5)<1){
             $cor5='#FFDE82';
         }else{
             $cor5='#FFDCDC';
         }
         
     }
     //SE FOR cartao de credito
     elseif($row['idCategoria']==6){
         $max6=600;
         $cartaoCredito = $cartaoCredito + $row['valor'];
         
         if(($cartaoCredito/$max6)<0.3){
            $cor6='#CBFFC9';    
         }elseif(($cartaoCredito/$max6)<0.7){
            $cor6='#FFF1C9';
         }elseif(($cartaoCredito/$max6)<1){
             $cor6='#FFDE82';
         }else{
             $cor6='#FFDCDC';
         }
         
     }
     //SE FOR taxas e Juros
     elseif($row['idCategoria']==29){
         $max7 = 100;
         $taxasJuros = $taxasJuros + $row['valor'];
         
         if(($taxasJuros/$max7)<0.3){
            $cor7='#CBFFC9';    
         }elseif(($taxasJuros/$max7)<0.7){
            $cor7='#FFF1C9';
         }elseif(($taxasJuros/$max7)<1){
             $cor7='#FFDE82';
         }else{
             $cor7='#FFDCDC';
         }
         
     }
     //SE FOR Vestuario
     elseif($row['idCategoria']==32){
         $max8=100;
         $vestuario = $vestuario + $row['valor'];
         
         if(($vestuario/$max8)<0.3){
            $cor8='#CBFFC9';    
         }elseif(($vestuario/$max8)<0.7){
            $cor8='#FFF1C9';
         }elseif(($vestuario/$max8)<1){
             $cor8='#FFDE82';
         }else{
             $cor8='#FFDCDC';
         }
         
     }
     //SE FOR Viagens
     elseif($row['idCategoria']==33){
         $max9 = 100;
         $viagens = $viagens + $row['valor'];
         
         if(($viagens/$max9)<0.3){
            $cor9='#CBFFC9';    
         }elseif(($viagens/$max9)<0.7){
            $cor9='#FFF1C9';
         }elseif(($viagens/$max9)<1){
             $cor9='#FFDE82';
         }else{
             $cor9='#FFDCDC';
         }
         
     }
     //SE FOR Farmacia
     elseif($row['idCategoria']==21){
         $max10 = 100;
         $farmacia = $farmacia + $row['valor'];
         
         if(($farmacia/$max10)<0.3){
            $cor10='#CBFFC9';    
         }elseif(($farmacia/$max10)<0.7){
            $cor10='#FFF1C9';
         }elseif(($farmacia/$max10)<1){
             $cor10='#FFDE82';
         }else{
             $cor10='#FFDCDC';
         }
         
     }
     
 }


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
            <div class="alert alert-info"><h2 align='center'>Estatísticas</h2></div>
            <h4>Gastos por Categorias</h4>
            
            <h5>Escolha o Mês</h5>
            <form class="form-horizontal" name="form1" action="estatisticas.php" method="post" enctype="multipart/form-data">
                <div>
                <label>Mês: </label>
                    <select name="mes">
                        <option value="1">Janeiro</option>
                        <option value="2">Fevereiro</option>
                        <option value="3">Março</option>
                        <option value="4">Abril</option>
                        <option value="5">Maio</option>
                        <option value="6">Junho</option>
                        <option value="7">Julho</option>
                        <option value="8">Agosto</option>
                        <option value="9">Setembro</option>
                        <option value="10">Outubro</option>
                        <option value="11">Novembro</option>
                        <option value="12">Drzembro</option>
                    </select>
                
                <button type="submit">Ok</button>                
                
                </div>

            </form>
            <br/>
            
            <div align="center"><h3><b><?php echo $mescorrente; ?></b></h3></div>
            <table class="table table-hover table-condensed">
                  <thead bgcolor="#D3D3D3">
                    <tr>
                      <th class="col-md-1">Categoria</th>
                      <th class="col-md-1">Valor (R$)</th>
                    </tr>
                  </thead>
                  <tbody>
                      <tr>
                          <td>Aluguel/Condomínio</td>
                          <?php echo '<td bgcolor='.$cor1.'>'.$aluguel_cond ?></td>
                      </tr>
                      <tr>
                          <td>Luz / TV / Net / Telefone</td>
                          <?php echo '<td bgcolor='.$cor2.'>'.$luz_tv_net_tel ?></td>
                      </tr>
                      <tr>
                          <td>Bares/Restaurantes</td>
                          <?php echo '<td bgcolor='.$cor3.'>'.$bar_restaurantes ?></td>
                      </tr>
                      <tr>
                          <td>Combustível</td>
                          <?php echo '<td bgcolor='.$cor4.'>'.$combustivel ?></td>
                      </tr>
                      <tr>
                          <td>Carro em geral (com combustível)</td>
                          <?php echo '<td bgcolor='.$cor5.'>'.$carroGeral ?></td>
                      </tr>
                      <tr>
                          <td>Cartão de Crédito</td>
                          <?php echo '<td bgcolor='.$cor6.'>'.$cartaoCredito ?></td>
                      </tr>
                      <tr>
                          <td>Taxas e Juros</td>
                          <?php echo '<td bgcolor='.$cor7.'>'.$taxasJuros ?></td>
                      </tr>
                      <tr>
                          <td>Vestuário</td>
                          <?php echo '<td bgcolor='.$cor8.'>'.$vestuario ?></td>
                      </tr>
                      <tr>
                          <td>Viagens</td>
                          <?php echo '<td bgcolor='.$cor9.'>'.$viagens ?></td>
                      </tr>
                      <tr>
                          <td>Farmácia</td>
                          <?php echo '<td bgcolor='.$cor9.'>'.$farmacia ?></td>
                      </tr>
                      
                  </tbody>
            </table>
            <br/><br/>
            
        </div>
    </body>
</html>
