<?php

require '../db/database.php';
//Arquivos de login
include('../login/config.php');
include('../login/verifica_login.php');
include('../login/redirect.php');


$valid = true;

if ( !empty($_POST)) {

    //$fornecedor = $_POST['fornecedor'];
    //
    //Atributos da imagem que foi passada
//    $imagem = $_FILES["imagem"];
    $arquivo_tmp = $_FILES['imagem']['tmp_name'];
    $nome = $_FILES['imagem']['name'];
    // Pega a extensao
    $extensao = strrchr($nome, '.');
    // Converte a extensao para mimusculo
    $extensao = strtolower($extensao);
    // Somente imagens, .jpg;.jpeg;.gif;.png
    // Aqui eu enfilero as extesões permitidas e separo por ';'
    // Isso server apenas para eu poder pesquisar dentro desta String
    if(strstr('.jpg;.jpeg;.gif;.png', $extensao))
	{
		// Cria um nome único para esta imagem
		// Evita que duplique as imagens no servidor.
		$novoNome = md5(microtime()) . $extensao;
		
		// Concatena a pasta com o nome
		$destino = '../img/' . $novoNome; 
		
		// tenta mover o arquivo para o destino
		@move_uploaded_file( $arquivo_tmp, $destino  );
	}
	else{
            echo '<script language="javascript">';
            echo 'alert("Você poderá enviar apenas arquivos \'*.jpg;*.jpeg;*.gif;*.png\' ");';
            echo 'window.location.href = "../conta/create.php";';
            echo '</script>';
        }
        

    $descricao = $_POST['descricao'];
    $saldo = $_POST['saldo'];
    
    
    if ($valid) {
        $mysqlImg = addslashes(file_get_contents($_FILES['imagem']['tmp_name']));
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO contas (foto, descricao, saldo) 
                values(?, ?, ?)";

        $q = $pdo->prepare($sql);
        $q->execute(array($destino, $descricao, $saldo));
        unlink($nomeFinal);

        Database::disconnect();
        header("Location: index.php");
        
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />       
</head>
<?php include ('../layout/header.php'); ?>
<body>
    <div class="container">
        
        <a class="btn btn-default" href="index.php">Voltar ao Painel</a><br/><br/>
        
        <div class="col-xs-offset-1 col-md-6">
        <div class="bg-primary">
            <h3>Nova Conta</h3>
        </div>
        <br/>
        
        
        <!--INICIO DO FORMULARIO-->             
        <form class="form-horizontal" name="form1" action="create.php" method="post" enctype="multipart/form-data">
            
            <div>
                <label for="imagem">Imagem:</label>
                <input type="file" name="imagem"/>
		<br/>
            </div>
            <div>
            <label>Descricao: </label>
                <input type="text" name="descricao" size="50" placeholder="Descricao"/>
            </div>
            <br/>
            <div>
            <label>Saldo: </label>
                <input type="float" name="saldo" size="10" placeholder="Saldo Inicial"/>
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
</html>
