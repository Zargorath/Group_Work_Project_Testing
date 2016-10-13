<?php 
	// et saada ligi sessioonile
	require("functions.php");
	
	//ei ole sisseloginud, suunan login lehele
	if(!isset ($_SESSION["userId"])) {
		header("Location: login.php");
		exit();
	}
	
	
	//kas kasutaja tahab välja logida
	// kas aadressireal on logout olemas
	if (isset($_GET["logout"])) {
		
		session_destroy();
		
		header("Location: login.php");
		exit();
	}
	
	if(isset ($_POST["forumPost"])&&
		!empty($_POST["forumPost"])) {
			
			saveFPost($_POST["forumPost"]);
			
		}
		
		$Posts = getAllFPosts();
		//echo "<pre>";
		//var_dump($Posts);
		//echo "</pre>";
?>

<h1>Data</h1>
<p>
	Tere tulemast <?=$_SESSION["userEmail"];?>!
	<a href="?logout=1">Logi välja</a>
</p>

<h2>Postitused</h2>
<form method="POST">

	<label>Postitus</label><br>
	<input name="forumPost" type="text">

	<br><br>

	<input type="submit">

</form>

<h2 style="clear:both;">Postituste tabel</h2>
<?php

	$html = "<table>";
	
		$html .="<tr>";
			$html .="<th>id</th>";
			$html .="<th>Postitus</th>";
		$html .="</tr>";
		
	foreach ($Posts as $post) {
		$html .="<tr>";
			$html .="<td>".$post->id."</td>";
			$html .="<td>".$post->forumPost."</td>";
		$html .="</tr>";
	}
	
	$html .="</table>";
	
	echo $html;

?>