<?php

	require("../../config.php");
	require("Functions.php");
	
	
	$loginUsername = "";
	$loginPassword = "";
	$signupUsername = "";
	$signupPassword = "";
	$signupEmail = "";
	$signupEmailError = "";
	$signupPasswordError = "";
	$signupEmailError = "";
	$signupUsernameError = "";
	$loginPasswordError = "";
	$loginUsernameError = "";
	
	if(isset($_POST["loginUsername"])) {
		
		if(empty($_POST["loginUsername"])) {
			
			$loginUsernameError = "Palun sisestage enda kasutajatunnus";
			
		}
		
	}
	
	if(isset($_POST["loginPassword"])) {
		
		if(empty($_POST["loginPassword"])) {
			
			$loginPasswordError = "Palun sisesta enda parool";
			
		}
		
	}
	
	if(isset($_POST["signupEmail"])) {
		
		if(empty($_POST["signupEmail"])) {
			
			$signupEmailError = "Palun sisestage enda email";
			
		} else {
			
			$signupEmail = $_POST["signupEmail"];
			
		}
		
	}
	
	if(isset($_POST["signupUsername"])) {
		
		if(empty($_POST["signupUsername"])) {
			
			$signupUsernameError = "Palun sisestage endale sobiv kasutajatunnus";
			
		} else {
			
			$signupUsername = $_POST["signupUsername"];
			
		}
		
	}
	
	if(isset($_POST["signupPassword"])) {
		
		if(empty($_POST["signupPassword"])) {
			
			$signupPassword = "Palun sisestage endale meelepärane parool";
			
		} else {
			
			$signupPassword = $_POST["signupPassword"];
			
		}
		
	}

?>

<form method="POST">

	<h2>Loo Kasutaja</h2>
	
	<label>Kasutajanimi</label><br>
	<input type="text" name="signupUsername"><?php echo $signupUsernameError; ?>
	
	<br><br>
	
	<label>Parool</label><br>
	<input type="password" name="signupPassword"><?php echo $signupPassword; ?>
	
	<br><br>
	
	<label>E-post</label><br>
	<input type="email" name="signupEmail"><?php echo $signupEmailError; ?>
	
	<br><br>
	
	<input type="submit" value="Loo Kasutaja">
	
</form>

<form method="POST">

	<h2>Logi Sisse</h2>
	
	<label>Kasutajatunnus</label><br>
	<input type="text" name="loginUsername"><?php echo $loginUsernameError; ?>
	
	<br><br>
	
	<label>Parool</label><br>
	<input type="password" name ="loginPassword"><?php $loginPasswordError; ?>
	
	<br><br>
	
	<input type="submit" value="Logi Sisse">

</form>