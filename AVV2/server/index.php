<html>
  <head>      
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>ESP8266 Buzzer</title>
   
    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <link rel="stylesheet" href="style.css">

  </head>
  <body>
	<?php 
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			// Define data
			$data = $_POST["pot"];
			if ($data < 20) {
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
			// Push data to text file
			file_put_contents("output.txt", $data . "\n", FILE_APPEND);

		} else  {
			// Open the file
			$fp = @fopen('output.txt', 'r'); 

			// Add each line to an array
			if ($fp) {
			   $array = explode("\n", fread($fp, filesize('output.txt')));
			}
			// For each array value, create a bar
			foreach ($array as $value) {
				?> <div class="bar" style="height:<?php echo $value; ?>px;"></div> <?php
			};
		}
	?>
  </body>
</html>
