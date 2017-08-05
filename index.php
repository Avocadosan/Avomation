
<html>
<head>
	<title>Play a tone, boi</title>
	<meta name="viewport" content="width=device-width, initial-scale=3.0">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
</head>

<body >

<div class="grid">

	

	<div class="header">
		<h1><img class="logo" src="logo.png"  > Avomation <img  class="logo" src="logo.png" ></h1>
		
	</div>
	
	<div class="note">
		<h3>Play a note!</h3>
		<input type="number" value="440" name="tone" id="tone" class="form-control"></input>
		<input type="number" value="440" name="len" id="len" class="form-control"></input>
		<br>
		<input type="submit" value="Send note" class="btn btn-info" id="submit">
	</div> 	
	<div class="led">
		<h3>Turn the led on or off</h3>
		<input type="button" value="ON" name="on" id="on" class="btn btn-success"></input>
		<input type="button" value="OFF" name="off" id="off" class="btn btn-danger"></input>
	</div>
	<div class="serial">
		<h3>Send a direct message to the serial</h3>
		<input type="text" value="" name="serial" id="serial" class="form-control"></input>
		<br>
		<input type="button"  value="Send string" name="serialButton" id="serialButton" class="btn btn-success"></input>
	</div>
	<div class="footer">
		<h4>Made by Avocado</h4>
	</div>

	
</div>



</body>
<script type="text/javascript">

$("#submit").click(function(){
    $.post("toArduino.php",
    {
        tone: $("#tone").val(),
        len: $("#len").val()
    },
    function(data, status){
        //alert("Ya note was sent, thx boi");
    });
});

$("#on").click(function(){
    $.post("toArduino.php",
    {
        led: "n"
    },
    function(data, status){
    });
});

$("#off").click(function(){
    $.post("toArduino.php",
    {
        led: "f"
    },
    function(data, status){
    });
});

$("#serialButton").click(function(){
    $.post("toArduino.php",
    {
        serial: $("#serial").val()
    },
    function(data, status){
    	$("#serial").val("");
    });
});
	
</script>

</html>