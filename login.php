<!DOCTYPE html>
<html>
<head>

	<?php 
        include_once 'functions.php'; 
	    getHead("Login");
     ?>   
          
  </head>

<?php getMenu1("Login");?>
<?php getMenu2("Login");?>

<?php getBreadcumbs("Login");?>

<div class="pageLogin">

	<div class=" box-login-left" >
		<?php getMessage();?>
	

		<form action="login.php" method="post" name="login">
	
		
		<div class="form">
			<form action="login.php" method="post" name="login">
		
			

			<div class="input">
								<label for="Username" class="label username">Username</label>
								<input class="insertBox" id="Username" type="text" name="username" class="input username" placeholder="Inserisci username">
								<p class="error"><?php getUsernameError($errors); ?></p>
			</div>
			<div class="input password">
								<label for="Password" class="label password"> Password</label>
								<input class="insertBox" id="Password" type="password" name="password" class="input password" placeholder="********">
								
			</div>
							<button type="submit" class="button" name="Login">Login</button>
			</form>
		</div>
	</div>
	

	<div class="box-login-right box-login-descr" >

	<p id="notRegistered">Non ancora registrato? Che aspetti? </br> Entra nella nostra community per restare aggiornato sugli eventi nelle città del Veneto, non perdere l'occasione di iscriverti ai tuoi avvenimenti preferiti prima che i posti finiscano! Già milioni di utenti utilizzano il nostro servizio e ne sono entusiasti!</p>
	<h1 class="titolo">Registrati <a class="link-parola" href='registrazione_utente.php'>qui</a></h1>
	</div>


</div>
</body>
<?php getfooter()?>

