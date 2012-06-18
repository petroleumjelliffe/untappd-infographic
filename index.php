<html>

<?php

include 'Awsm/Service/Untappd.php';

?>


<?php
$apiKey   = '68fc36c4d9e498293f8edfe6ab9453a2';
<<<<<<< HEAD
$username = '';
$password = '';
=======
//use the username and passowrd passed via POST submission
$username= (isset($_POST['username']) ? $_POST['username'] : '');
$password= (isset($_POST['password']) ? $_POST['password'] : '');
>>>>>>> added a name, and added login to the page
        
$untappd = new Awsm_Service_Untappd($apiKey, $username, $password);
        
//if someone logged in...        
if ($username != '') {       
	//pull the list of distinct beers
	
	try {
	    $result = $untappd->userDistinctBeers();
	} catch (Awsm_Service_Untappd_Exception $e) {
	    die($e->getMessage());
	}

  //create the list of beers
	$autocomplete="[";
	
	foreach ($result->results as $value) {
		$autocomplete.= "\"".$value->beer_name . " (" . $value->brewery_name . ")\",\n";
	} 
	$autocomplete.= "\"\"]";
	
}
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

<?php if (!((isset($_POST['username'])) && (isset($_POST['password'])))): ?>

<h3>Brewnique helps you find beers you've already had, so you can make sure you're trying a new one!</h3>
<p>Sign in with your Untappd username and password.  Don't worry, we don't store it.</p>
  <form action="" method="post">
    <label for="username">Username:</label><input type="text" name="username" id="username" placeholder="Untappd username"> <br />
    <label for="password">Password:</label><input type="password" name="password" id="password" placeholder="Untappd password"> <br/>
    
    <input type="submit" value="Sign in">
  </form>
<?php else: ?>
  <h3><?php echo "Hi, $username!" ?></h3>
  
<div class="ui-widget">
	<label for="beers">Which beer are you looking for? </label><br />
	<input type="text" id="beers" />
</div>
<?php endif; ?>


  </body>
</html>
