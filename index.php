<!DOCTYPE html>
<html lang="en">
<!-- -->
<head>
	<title>SAIDG6</title>
	<meta charset="utf-8">
</head>
<body>	
	<!-- form to upload file -->
	<?php
	function displayForm() {?> 
	<form action="index.php" method="post" enctype="multipart/form-data">
		<P><h1><b>IT3234B Project - Group 6</b></h1></p>
		<p>Select file to upload:</p>
		<input type="file" name="fileUpload" id="fileUpload">
		<input type="submit" value="Submit" name="Submit">
	</form>
	<?php
	}
		$countRowGood = $countRowBad = $countRemote = $countLocal = $totalBytes = $ec200 = $ec201 = $ec302 = $ec304 = $ec401 = $ec403 = $ec404 = $ec500 = $ec502 = $ec503 = $ec504 = 0;
				
			//"All-In-One" form block
	//	if (isset($_POST['Submit'])) {
			$target_dir = "MK419/MK419.github.io";
			$target_file = $target_dir . basename($_FILES["fileUpload"]["name"]);
			
			//Confirm log file
			if ((pathinfo($_FILES["fileUpload"]["name"], PATHINFO_EXTENSION))=="log") {
				$logArray = file($_FILES["fileUpload"]["tmp_name"]);
				$arraySize = count($logArray);
				$logregex = '/\s*([a-zA-Z]+)[^[]*\[([^]]*)\]\s+\"([^"]+)\"\s+([0-9]+)\s+([0-9-]+)/';
				
				displayForm('');
				echo "<h2><b>Upload Successful!</b></h2>";
				
				//Analysis Loop
			for($i = 0; $i < $arraySize; $i++){
				preg_match_all($logregex, $logArray[$i], $matches, PREG_SET_ORDER, 0);
				
				if (($matches[0][1]=="remote" || $matches[0][1]=="local") && ($matches[0][4]=="200" || $matches[0][4]=="201" || $matches[0][4]=="302" || $matches[0][4]=="304" || $matches[0][4]=="401" || $matches[0][4]=="403" || $matches[0][4]=="404" || $matches[0][4]=="500" || $matches[0][4]=="502" || $matches[0][4]=="503" || $matches[0][4]=="504"))	{
				    $countRowGood++;
					
					//Counting remote/local connections
					if ($matches[0][1]=="remote"){
						$countRemote++;
					}
					if ($matches[0][1]=="local"){
						$countLocal++;
					}
		
					$totalBytes += $matches[0][5];
					
					//Counting error codes
					switch (($matches[0][4])) {
						case "200":
							$ec200++;
							break;
						case "201":
							$ec201++;
							break;
						case "302":
							$ec302++;
							break;
						case "304":
							$ec304++;
							break;
						case "401":
							$ec401++;
							break;
						case "403":
							$ec403++;
							break;
						case "404":
							$ec404++;
							break;
						case "500":
							$ec500++;
							break;
						case "502":
							$ec502++;
							break;
						case "503":
							$ec503++;
							break;
						case "504":
							$ec504++;
							break;
						default:
							echo "Invalid Error Code";
					}
				} else {
					$countRowBad++;
				}
				//echo $logArray[$i]."<br>";
				//echo $matches[0][1]."<br>"; //remote or local
				//echo $matches[0][4]."<br>"; //error codes
				//echo $matches[0][5]."<br>"; //file sizes
    
			}
				//Writing .out file
				file_put_contents((pathinfo($_FILES["fileUpload"]["name"], PATHINFO_FILENAME).".out"), ("Good Rows: ".$countRowGood.PHP_EOL), FILE_APPEND);
				file_put_contents((pathinfo($_FILES["fileUpload"]["name"], PATHINFO_FILENAME).".out"), ("Bad Rows: ".$countRowBad.PHP_EOL), FILE_APPEND);
				file_put_contents((pathinfo($_FILES["fileUpload"]["name"], PATHINFO_FILENAME).".out"), ("Bytes: ".$totalBytes.PHP_EOL), FILE_APPEND);
				file_put_contents((pathinfo($_FILES["fileUpload"]["name"], PATHINFO_FILENAME).".out"), ("Remote: ".$countRemote.PHP_EOL), FILE_APPEND);
				file_put_contents((pathinfo($_FILES["fileUpload"]["name"], PATHINFO_FILENAME).".out"), ("Local: ".$countLocal.PHP_EOL), FILE_APPEND);
				
				if ($ec200 > 0){
					file_put_contents((pathinfo($_FILES["fileUpload"]["name"], PATHINFO_FILENAME).".out"), ("200: ".$ec200.PHP_EOL), FILE_APPEND);
				}
				if ($ec201 > 0){
					file_put_contents((pathinfo($_FILES["fileUpload"]["name"], PATHINFO_FILENAME).".out"), ("201: ".$ec201.PHP_EOL), FILE_APPEND);
				}
				if ($ec302 > 0){
					file_put_contents((pathinfo($_FILES["fileUpload"]["name"], PATHINFO_FILENAME).".out"), ("302: ".$ec302.PHP_EOL), FILE_APPEND);
				}
				if ($ec304 > 0){
					file_put_contents((pathinfo($_FILES["fileUpload"]["name"], PATHINFO_FILENAME).".out"), ("304: ".$ec304.PHP_EOL), FILE_APPEND);
				}
				if ($ec401 > 0){
					file_put_contents((pathinfo($_FILES["fileUpload"]["name"], PATHINFO_FILENAME).".out"), ("401: ".$ec401.PHP_EOL), FILE_APPEND);
				}
				if ($ec403 > 0){
					file_put_contents((pathinfo($_FILES["fileUpload"]["name"], PATHINFO_FILENAME).".out"), ("403: ".$ec403.PHP_EOL), FILE_APPEND);
				}
				if ($ec404 > 0){
					file_put_contents((pathinfo($_FILES["fileUpload"]["name"], PATHINFO_FILENAME).".out"), ("404: ".$ec404.PHP_EOL), FILE_APPEND);
				}
				if ($ec500 > 0){
					file_put_contents((pathinfo($_FILES["fileUpload"]["name"], PATHINFO_FILENAME).".out"), ("500: ".$ec500.PHP_EOL), FILE_APPEND);
				}
				if ($ec502 > 0){
					file_put_contents((pathinfo($_FILES["fileUpload"]["name"], PATHINFO_FILENAME).".out"), ("502: ".$ec502.PHP_EOL), FILE_APPEND);
				}
				if ($ec503 > 0){
					file_put_contents((pathinfo($_FILES["fileUpload"]["name"], PATHINFO_FILENAME).".out"), ("503: ".$ec503.PHP_EOL), FILE_APPEND);
				}
				if ($ec504 > 0){
					file_put_contents((pathinfo($_FILES["fileUpload"]["name"], PATHINFO_FILENAME).".out"), ("504: ".$ec504.PHP_EOL), FILE_APPEND);
				}
				
				echo "Replace \"index.php\" with: ".pathinfo($_FILES["fileUpload"]["name"], PATHINFO_FILENAME).".out to view output file.";
				
			}	
			else{
				 displayForm('');
				 echo "<h2>Please submit a .log file.</h2>";
			}
		//}
		else{
			// if the form has yet to be submitted... display with Null values
				 displayForm('');
		}
	?>
</body>
</html>
