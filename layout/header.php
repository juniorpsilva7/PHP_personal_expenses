<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<?php $page = $_SERVER['REQUEST_URI']; ?>

<!DOCTYPE html>
<meta http-equiv="content-type" content="text/html; charset=utf-8" /> 
<link   href="../css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../css/jquery-ui.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">


<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->

    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <img height='50' width='50' src="../img/money3.png"/>&nbsp;&nbsp;&nbsp;
      <a class="navbar-brand" href="../index.php">ControleGastos</a>
    </div>
    
    
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li <?php echo ($page == '/finan/index/index.php') ? 'class="active"' : '';?> ><a href="../index.php">Home <span class="sr-only">(current)</span></a></li>
        <li <?php echo ($page == '/finan/conta/index.php') ? 'class="active"' : '';?> ><a href="../conta/index.php">Contas <span class="sr-only">(current)</span></a></li>
        
        <!--<li <?php // echo ($page == '/finan/operacao/index.php') ? 'class="active"' : '';?> ><a href="../operacao/index.php">Operações <span class="sr-only">(current)</span></a></li>-->
        <li class="dropdown">
          <a href="../operacao/index.php" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Operações <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="../operacao/entrada.php">Cadastrar Entrada</a></li>
            <li><a href="../operacao/saida.php">Cadastrar Saída</a></li>
            <li><a href="../operacao/transferencia.php">Transferência ou Saque</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="../operacao/index.php">Ver todas Operações</a></li>
          </ul>
        </li>
        
        <!--<li <?php // echo ($page == '/finan/cartao_credito/index.php') ? 'class="active"' : '';?> ><a href="../cartao_credito/index.php">Cartões de Crédito <span class="sr-only">(current)</span></a></li>-->
        <li class="dropdown">
          <a href="../cartao_credito/index.php" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cartões de Crédito<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="../cartao_credito/novacompra.php">Nova Compra</a></li>
            <li><a href="../cartao_credito/create.php">Novo Cartão</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="../cartao_credito/index.php">Ver Cartões</a></li>
          </ul>
        </li>
        
        
        <!--<li <?php // echo ($page == '/finan/contas_pagar/index.php') ? 'class="active"' : '';?> ><a href="../contas_pagar/index.php">Contas à Pagar<span class="sr-only">(current)</span></a></li>-->   
        <li class="dropdown">
          <a href="../contas_pagar/index.php" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Contas à Pagar<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="../contas_pagar/createMensal.php">Criar conta Mensal</a></li>
            <li><a href="../contas_pagar/createExtra.php">Criar conta Extra</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="../contas_pagar/index.php">Ver Contas</a></li>
          </ul>
        </li>
        
        
        <li <?php echo ($page == '/finan/categoria/estatisticas.php') ? 'class="active"' : '';?> ><a href="../categoria/estatisticas.php">Estatísticas<span class="sr-only">(current)</span></a></li>
        <li <?php echo ($page == '/cria-usuarios/index.php') ? 'class="active"' : '';?> ><a href="../cria-usuarios/index.php">Usuários<span class="sr-only">(current)</span></a></li>
      
        
        
      </ul>
        
      <ul class="nav navbar-nav navbar-right">
        <li <button><a href="../login/sair.php"><b>Logout</b></a></button></li>
      </ul>
    </div><!-- /.navbar-collapse -->
    
        
        
    </div><!-- /.container-fluid -->    
</nav>


<script src="../js/jquery-1.11.2.js"></script>
<script src="../js/bootstrap.js"></script>