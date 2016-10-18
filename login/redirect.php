<?php
if ( $_SESSION['logado'] != true ) {
	header('location: ../index/login.php');
}