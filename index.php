<html>

<?php

include 'Awsm/Service/Untappd.php';

$apiKey   = '68fc36c4d9e498293f8edfe6ab9453a2';
$username = 'petroleumjelliffe';
$password = 'feb781';
        
$untappd = new Awsm_Service_Untappd($apiKey, $username, $password);
        
try {
    $result = $untappd->userDistinctBeers();
} catch (Awsm_Service_Untappd_Exception $e) {
    die($e->getMessage());
}

//var_dump($result->results);

$autocomplete="[";

foreach ($result->results as $value) {
	$autocomplete.= "\"".$value->beer_name . " (" . $value->brewery_name . ")\",\n";
} 
$autocomplete.= "\"\"]";


//$result=json_encode($result);
//$result="{\"hi\":\"hello\"}";
?>
<head>
		<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.21.custom.css" rel="stylesheet" />
		<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.8.21.custom.min.js"></script>
  <script>
//  alert(data[0]);
  <?php echo "var beerlist=$autocomplete;"; ?>
//alert(beerlist[0]);
//beerlist.sort();
//alert(beerlist[0]);  
//
</script>
  
  	<script>
	$(function() {

  var beerlist= <?php echo $autocomplete; ?>;

beerlist.sort();


		$( "#beers" ).autocomplete({
			source: beerlist
		});
	});
	</script>


</head>
<body>
  <form action="" method="post">
    <label for="username">Username:</label><input type="text" name="password" id="password" placeholder="Untappd username"> <br />
    <label for="password">Password:</label><input type="password" name="password" id="password" placeholder="Untappd password"> <br/>
    
    <input type="submit" value="Sign in">
  </form>
  
<div class="ui-widget">
	<label for="beers">Beers: </label>
	<input type="text" id="beers" />
</div>


  </body>
</html>
