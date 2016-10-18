<?php
// Inicia a sessão
session_start();
?>
<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<link   href="../css/bootstrap.min.css" rel="stylesheet">
                <script src="../js/bootstrap.min.js"></script>
		<title>Login</title>
	</head>
        
	<body>
            <div class="container">
                <div class="row">
                    <div class="span12">
                    <form class="form-horizontal" action="index.php" method="post">
                        <fieldset>			
                                <div id="legend">
                                  <legend class="">Login</legend>
                                </div>
                                <div class="control-group">
                                  <!-- Username -->
                                  <label class="control-label"  for="username">Username</label>
                                  <div class="controls">
                                    <input type="text" id="username" name="usuario" placeholder="Username" class="input-xlarge">
                                  </div>
                                </div>
                                <div class="control-group">
                                  <!-- Password-->
                                  <label class="control-label" for="password">Password</label>
                                  <div class="controls">
                                    <input type="password" id="password" name="senha" placeholder="Password" class="input-xlarge">
                                  </div>
                                </div>
                                <?php if ( ! empty( $_SESSION['login_erro'] ) ) :?>

                                                    <div style="color: red;"><?php echo $_SESSION['login_erro'];?></div>
                                                    <?php $_SESSION['login_erro'] = ''; ?>

                                    <?php endif; ?><br/>
                                <div class="control-group">
                                  <!-- Button -->
                                  <div class="controls">
                                    <button class="btn btn-success">Login</button>
                                  </div>
                                </div>
                        </fieldset>      
                    </form><br/>
                        <!--<a href="../cria-usuarios/index.php">Criar usuário</a>-->
                    </div>
                </div>
            </div>
	</body>
</html>