<?php 


if(isset($_POST["tone"]) and isset($_POST["len"])){

	$tone = $_POST["tone"];
	$len = $_POST["len"];
	if($len > 10000){
		$len = 10000;
	}
	$comPort = "COM9";
	$fp =fopen($comPort, "w");
	fwrite($fp, $tone."l".$len); //TONEllength  440l1000
	fclose($fp);
}

if(isset($_POST["led"])){
	$led = $_POST["led"];
	$comPort = "COM9";
	$fp =fopen($comPort, "w");
	fwrite($fp, $led); 
	fclose($fp);
}

if(isset($_POST["serial"])){
	$serial = $_POST["serial"];
	$comPort = "COM9";
	$fp =fopen($comPort, "w");
	fwrite($fp, $serial); 
	fclose($fp);
}
	

?>
