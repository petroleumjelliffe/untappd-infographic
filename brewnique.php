<html>

<?php

include 'Awsm/Service/Untappd.php';

$debug=false; //set to true to use a static JS array and not call teh API to avoid the rate limit.

?>


<?php
$apiKey   = '68fc36c4d9e498293f8edfe6ab9453a2';
//use the username and passowrd passed via POST submission
$username= (isset($_POST['username']) ? $_POST['username'] : '');
$password= (isset($_POST['password']) ? $_POST['password'] : '');
        
        
        
$untappd = new Awsm_Service_Untappd($apiKey, $username, $password);
        
//if someone logged in...        
if ($username != '') {       
	//pull the list of distinct beers
	
	$offset=0;
	$loop=25;
	$autocomplete="[";
	$passes=1;

	if ($debug) {
		$autocomplete.="\"Thunderbolt (Wandering Star Brewing Company)\",
										\"Slyfox Maibock (Sly Fox Brewing Company)\",
										\"Lake Erie Monster (Great Lakes Brewing Company )\",
										\"Edmund Fitzgerald (Great Lakes Brewing Company )\",
										\"Holy Moses White Ale (Great Lakes Brewing Company )\",
										\"Dortmunder Gold (Great Lakes Brewing Company )\",
										\"Maibock (Greenport Harbor Brewing Company)\",
										\"He'Brew Hop Manna IPA (Shmaltz Brewing Company)\",
										\"Excelsior! Fourteen (Ithaca Beer Company)\",
										\"Linchpin White IPA (Green Flash Brewing Co.)\",
										\"Warlord Imperial IPA (McNeill's Brewery)\",
										\"Moo Thunder Stout (Butternuts Beer & Ale)\",
										\"Scotch Ale (Rooster Fish Brewing)\",
										\"Big TIPA (Greenport Harbor Brewing Company)\",
										\"Waldo's Special Ale (AKA Waldo's 420) (Lagunitas Brewing Company)\",
										\"Existent (Stillwater Artisanal Ales)\",
										\"Tongue Buckler (Ballast Point Brewing Company)\",
										\"30th Street Pale Ale (Green Flash Brewing Co.)\",
										\"Drifter Pale Ale (Widmer Brothers Brewing Company)\",
										\"Dragon's Milk (New Holland Brewing Company)\",
										\"Export Ale (Shipyard Brewing Company)\",
										\"Sneaky Pete (Laughing Dog Brewing)\",
										\"Organic Porter (Eel River Brewing Co.)\",
										\"Apollo (Sixpoint Brewery)\",
										\"Heavy Seas Loose Cannon Hop³ Ale (Heavy Seas Beer)\",
										\"Avalanche Amber (Breckenridge Brewery)\",
										\"Big Daddy IPA (Speakeasy Ales and Lagers)\",
										\"Happy Hops (Russian River Brewing Company)\",
										\"Reality Czeck (Moonlight Brewing Company)\",
										\"Big Sur Golden (English Ales Brewery)\",
										\"Hofbräu Maibock (Staatliches Hofbräuhaus München)\",
										\"XHP (Jupiter)\",
										\"Jupiter Porter (Jupiter)\",
										\"\"]";
	} else {
	
		//loop through API cals until you go through the whole list
		while ($loop==25) {
			try {
			    $result = $untappd->userDistinctBeers($username, $offset);
			} catch (Awsm_Service_Untappd_Exception $e) {
			    die($e->getMessage());
			}
	/*
			$result= new stdClass;
			$result->returned_results=25;
			$result->returned_results= new stdClass;
			$result->returned_results->beer_name="test name";
			$result->returned_results->brewery_name="test name";
	*/
			
			//increment the offset
			$offset+=$result->returned_results;
			
			//stop looping if less than 25 results returned 
			$loop=$result->returned_results;
			
		  //append to the list of beers
			foreach ($result->results as $value) {
				$autocomplete.= "\"".$value->beer_name . " (" . $value->brewery_name . ")\",\n";
			} 
	
	/*
			echo "offset= $offset\n";
			echo"pass number $passes\n";
			$passes++;
	*/
		}
	
		//close the array
		$autocomplete.= "\"\"]";
	}
}
//$result=json_encode($result);
//$result="{\"hi\":\"hello\"}";
?>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.21.custom.css" rel="stylesheet" />
		<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.8.21.custom.min.js"></script>
  <script>
//  alert(data[0]);
  <?php //echo "var beerlist=$autocomplete;"; ?>
//alert(beerlist[0]);
//beerlist.sort();
//alert(beerlist[0]);  

</script>
  
  	<script>
	$(function() {

  var beerlist= <?php echo $autocomplete; ?>;

beerlist.sort();


		$( "#beers" ).autocomplete({
			source: beerlist,
			minLength: 2
		});
	});
	</script>


</head>
<body>

<?php if (!((isset($_POST['username'])) && (isset($_POST['password'])))): ?>

<h3>Brewnique helps you find beers you've already had, so you can make sure you're trying a new one!</h3>
<p>Sign in with your Untappd username and password.  Don't worry, we don't store it.</p>
  <form action="" method="post">
    <label for="username">Username:</label><input type="text" name="username" id="username" placeholder="Untappd username" value=""> <br />
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
