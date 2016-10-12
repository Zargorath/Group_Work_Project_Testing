<?php 
	// functions.php
	require("../../config.php");
	
	// et saab kasutada $_SESSION muutujaid
	// k�igis failides mis on selle failiga seotud
	session_start();
	
	
	$database = "if16_kliiva";
	
	//var_dump($GLOBALS);
	
	function signup($email, $password) {
		
		$mysqli = new mysqli(
		
		$GLOBALS["serverHost"], 
		$GLOBALS["serverUsername"],  
		$GLOBALS["serverPassword"],  
		$GLOBALS["database"]
		
		);
		$stmt = $mysqli->prepare("INSERT INTO user_sample (email, password) VALUES (?, ?)");
		echo $mysqli->error;
		
		$stmt->bind_param("ss", $email, $password );
		if ( $stmt->execute() ) {
			echo "salvestamine �nnestus";	
		} else {	
			echo "ERROR ".$stmt->error;
		}
		
	}
	
	
	function login($email, $password) {
		
		$notice = "";
		
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"],  $GLOBALS["serverPassword"],  $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("
		
			SELECT id, email, password, created
			FROM user_sample
			WHERE email = ?
		
		");
		// asendan ?
		$stmt->bind_param("s", $email);
		
		// m��ran muutujad reale mis k�tte saan
		$stmt->bind_result($id, $emailFromDb, $passwordFromDb, $created);
		
		$stmt->execute();
		
		// ainult SLECTI'i puhul
		if ($stmt->fetch()) {
			
			// v�hemalt �ks rida tuli
			// kasutaja sisselogimise parool r�siks
			$hash = hash("sha512", $password);
			if ($hash == $passwordFromDb) {
				// �nnestus 
				echo "Kasutaja ".$id." logis sisse";
				
				$_SESSION["userId"] = $id;
				$_SESSION["userEmail"] = $emailFromDb;
				
				header("Location: data.php");
				
			} else {
				$notice = "Vale parool!";
			}
			
		} else {
			// ei leitud �htegi rida
			$notice = "Sellist emaili ei ole!";
		}
		
		return $notice;
	}
	
	function saveFPost($forumPost) {
		
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("INSERT INTO forumPosts (forumPost) VALUES (?)");
		echo $mysqli->error;
		
		$stmt->bind_param("s", $forumPost);
		
		if ( $stmt->execute() ) {
			
			echo "Salvestamine �nnestus";
			
		} else {
			
			echo "Error ".$stmt->error;
			
		}
		
	}
	
	function getAllFPosts() {
		
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("SELECT id, forumPost FROM forumPosts");
		
		$stmt->bind_result($id, $forumPost);
		$stmt->execute();
		
		$result = array();
		
		while ($stmt->fetch()) {
			
			$object = new StdClass();
			$object->id = $id;
			$object->forumPost = $forumPost;
			
			array_push($result, $object);
			
		}
		
		return $result;
		
	}