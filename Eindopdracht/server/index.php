<?php // Check if light is supposed to be on or off
$light = $_GET['light'];
if($light == "on") { 
  // Write to light.json file and tell him the light should be off
  $file = fopen("light.json", "w") or die("can't open file");
  fwrite($file, '{"light": "on"}');
  fclose($file);
} 
else if ($light == "off") { 
  // Write to light.json file and tell him the light should be off 
  $file = fopen("light.json", "w") or die("can't open file");
  fwrite($file, '{"light": "off"}');
  fclose($file);
}
?>

<?php
// Refresh page every 5 seconds
$page = $_SERVER['PHP_SELF'];
$sec = "5";
?>

<html>
  <head>      
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
    
    <title>Remote detector</title>
   
    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <link rel="stylesheet" href="style.css">

  </head>
  <body>
	<?php 
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		  $data = $_POST["pot"];
		  if ($data > 900) {
		  	// Turn beeper on
			$file = fopen("light.json", "w") or die("can't open file");
			fwrite($file, '{"light": "off"}');
			fclose($file);
		  } else {
		  	// Turn beeper off
			$file = fopen("light.json", "w") or die("can't open file");
			fwrite($file, '{"light": "on"}');
			fclose($file);
		  };
		 
		   // WRITE TO JSON
			$str = file_get_contents('data.json');
			$newStr = str_replace('var data = ', '', $str);
			$arr = json_decode($newStr);

			$object = new stdClass();
			$object->value = (int)$data;
			$object->date = date("h:i:sa");
			$arrne = $object;

			array_push( $arr, $arrne );
			$arrStr = json_encode($arr);
			file_put_contents("data.json", 'var data = '.$arrStr . "\n");
		};
	?>
	
	<h1>Remote detector</h1>

	<div id="graph" class="aGraph"></div>

	<div class="buzzer">
		<h3>Turn buzzer on or off</h3>
		<a href="?light=on"><button class="on">ON</button></a>
		<a href="?light=off"><button class="off">OFF</button></a>
	</div>

	<script src="https://d3js.org/d3.v3.min.js" charset="utf-8"></script>
	<script type="text/javascript" src="data.json"></script>
	<script type="text/javascript" src="script.js"></script>
  </body>
</html>



<!-- Source: http://blog.nyl.io/esp8266-led-arduino/ -->