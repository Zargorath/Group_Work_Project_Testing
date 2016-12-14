<?php

	require("../../config.php");
	require("Functions.php");
	
	$veichle_type = "";
	$car_brand = "";
	$car_model = "";
	$reg_nr = "";
	$telephone_nr = "";
	$car_model_error = "";
	$car_brand_error = "";
	$reg_nr_error = "";
	$telephone_nr_error = "";
	$veichle_type_error = "";
	
	
	if(isset($_POST["veichle_type"])) {
		
		if(empty($_POST["veichle_type"])) {
			
			$veichle_type_error = "Palun valige auto tüüp";
			
		} else {
			
			$veichle_type = CleanInput($_POST["veichle_type"]);
			
		}
		
	}
	
	
	if(isset($_POST["reg_nr"])) {
		
		if(empty($_POST["reg_nr"])) {
			
			$reg_nr_error = "Palun sisestage auto registreerimisnumber";
			
		} else {
			
			$reg_nr = CleanInput($_POST["reg_nr"]);
			
		}
		
	}
	
	if(isset($_POST["car_brand"])) {
		
		if(empty($_POST["car_brand"])) {
			
			$car_brand_error = "Palun sisestage automark";
			
		} else {
			
			$car_brand = CleanInput($_POST["car_brand"]);
			
		}
		
	}
	
	
	if(isset($_POST["car_model"])) {
		
		if(empty($_POST["car_model"])) {
			
			$car_model_error = "Palun sisestage auto mudel";
			
		} else {
			
			$car_model = CleanInput($_POST["car_model"]);
			
		}
		
	}
	
	if(isset($_POST["telephone_nr"])) {
		
		if(empty($_POST["telephone_nr"])) {
			
			$telephone_nr_error = "Palun sisestage oma telefoni nr";
			
		} else {
			
			$telephone_nr = $_POST["telephone_nr"];
			
		}
		
	}
	
	if(isset($_POST["reg_nr"]) &&
	   isset($_POST["veichle_type"]) &&
	   isset($_POST["car_brand"]) &&
	   isset($_POST["car_model"]) &&
	   isset($_POST["telephone_nr"]) &&
	   empty($reg_nr_error) &&
	   empty($veichle_type_error) &&
	   empty($car_brand_error) &&
	   empty($car_model_error) &&
	   empty($telephone_nr_error)
	) {
		
		echo "Salvestan....<br>";
		echo "Sõiduki tüüp ".$veichle_type."<br>";
		SaveReservation($reg_nr, $veichle_type, $car_brand, $car_model, $telephone_nr);
		
	}

?>

<?php require("Header.php"); ?>


<div class="container">
	<div class="row">
		
		<div class="col-md-4 col-md-offset-3 col-sm-6">
		
		<h1>Andmed</h1><br>
		
		<form method="POST">
			
			<label>Registreerimisnumber</label><br>
			<div class="form-group">
				<input class="form-control" name="reg_nr" type="text"> <?php echo $reg_nr_error; ?>
			</div>
			
			<?php if ($veichle_type == "Sõiduauto") { ?>
                <input type="radio" name="veichle_type" value="Sõiduauto" checked > Sõiduauto<br>
            <?php } else { ?>
                <input type="radio" name="veichle_type" value="Sõiduauto"> Sõiduauto<br>
            <?php } ?>

            <?php if ($veichle_type == "Maastur") { ?>
                <input type="radio" name="veichle_type" value="Maastur" checked > Maastur<br>
            <?php } else { ?>
                <input type="radio" name="veichle_type" value="Maastur"> Maastur<br>
            <?php } ?>

            <?php if ($veichle_type == "Kaubik") { ?>
                <input type="radio" name="veichle_type" value="Kaubik" checked > Kaubik<br>
            <?php } else { ?>
                <input type="radio" name="veichle_type" value="Kaubik"> Kaubik<br>
            <?php } ?><br>
			
			<label>Mark</label><br>
			<div class="form-group">
				<input class="form-control" name="car_brand" type="text"> <?php echo $car_brand_error; ?>
			</div>

			
			<label>Mudel</label><br>
			<div class="form-group">
				<input class="form-control" name="car_model" type="text"> <?php echo $car_model_error; ?>
			</div>
			
			
			<label>Telefon</label><br>
			<div class="form-group">
				<input class="form-control" name="telephone_nr" type="tel"> <?php echo $telephone_nr_error; ?>
			</div>

			
			<table class="table-bordered">
			<?php 
							 
			 $limit = 7;
			 $starttime = 9;
			 $endtime = 16;
			 
			$html = "";
			 
			$html .= "<tr>";
			$html .= "<th>kell</th>";
			for($i = 0; $i < $limit; $i++){
				
				$day = date("d.m.Y",mktime(0, 0, 0, date("m")  , date("d")+$i, date("Y")));
				
				//echo $day."<br>";
				$html .= "<th>".$day."</th>";

			}
			
			$html .= "</tr>";
			
			for($j = $starttime; $j <= $endtime; $j++){
				
				if($j < 10){
					$time = "0".$j.":00";
				}else{
					$time = $j.":00";
				}
							
				//echo $day."<br>";
				//echo "<th>".$day."</th>";
				$html .= "<tr>";
				$html .= "<td>".$time."</td>";
				
				// :00
				
				for($k = 0; $k < $limit; $k++){
					
					$day = date("d.m.Y",mktime(0, 0, 0, date("m")  , date("d")+$k, date("Y")));
				
					$day_t = date("d.m.Y",mktime(0, 0, 0, date("m")  , date("d"), date("Y")));

					if(isset($_GET["time"]) && $_GET["time"] == $time && $_GET["date"] == $day ){
						$html .= "<td><a style='height: 19px; display:block; background-color:green;' href='?date=".$day."&time=".$time."'></a></td>";
					}else{
						$html .= "<td><a style='height: 19px; display:block; background-color:gray;' href='?date=".$day."&time=".$time."'></a></td>";
					}
				}
				
				$html .= "</tr>";
				
				if($j < 10){
					$time = "0".$j.":30";
				}else{
					$time = $j.":30";
				}
				
				$html .= "<tr>";
				
				// :30
				
				$html .= "<td>".$time."</td>";
				for($k = 0; $k < $limit; $k++){
					
					$day = date("d.m.Y",mktime(0, 0, 0, date("m")  , date("d")+$k, date("Y")));

					if(isset($_GET["time"]) && $_GET["time"] == $time && $_GET["date"] == $day ){
						$html .= "<td><a style='height: 19px; display:block; background-color:green;' href='?date=".$day."&time=".$time."'></a></td>";
					}else{
						$html .= "<td><a style='height: 19px; display:block; background-color:gray;' href='?date=".$day."&time=".$time."'></a></td>";
					}
				}
				$html .= "</tr>";
				
				
				
				
				

			}
			//var_dump($html);
			echo $html;

			?>
			</table>
			
			<br><br>
			
			<input type="submit" value="Broneeri" class="btn btn-success">
		
		</form>

	</body>
</html>