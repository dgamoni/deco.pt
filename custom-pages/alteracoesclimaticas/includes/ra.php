<?php
//rating script:

//prevent opening directly, only allow POST:
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    exit();
}

include("db_connect.php");

//limit the querystrings types:
$fieldsArray = array("rating_type", "municipality_id", "municipality_title", "rating");
//build the dynamic variables:
for($i=0;$i<count($fieldsArray);$i++){
	//generate the variables (dynamic):
	//some items need to be obtained in their raw form, because of the HTML tags:
	$theValue = strip_tags(trim($_REQUEST[$fieldsArray[$i]]));
	${$fieldsArray[$i]} = $theValue;
}

$rating_return = "";

//depending on the type, execute:
switch($rating_type){
	case "get":
		//GET
		$link = OpenCon();
		$sql = "SELECT * FROM `ac_rating` WHERE `municipality_id` LIKE '" . $municipality_id . "' ORDER BY `id` ASC";
		$thisRatingArray = [];
		if($result = mysqli_query($link, $sql)){
			while($row = mysqli_fetch_array($result)){
				array_push($thisRatingArray, $row['user_rating']);
			}
		}
		//var_dump($thisRatingArray);
		//get the average rating:
		$thisRating = 0;
		//prevent a division by zero!
		if(count($thisRatingArray) > 0){
			$thisRating = array_sum($thisRatingArray) / count($thisRatingArray);
		}
		if(is_nan($thisRating)){
			$thisRating = 0;
		}
		//var_dump($thisRating);
		//$rating_return = number_format($thisRating, 2);
		//round up:
		$rating_return = ceil($thisRating);
		
		CloseCon($link);
		//$query->set('modified = NOW()');
		break;
		
	case "set":
		//SET
		$link = OpenCon();
		$sql = "INSERT INTO ac_rating (municipality_id, municipality, user_rating, rating_date) VALUES ('" . $municipality_id . "', '" . $municipality_title . "', '" . $rating . "', NOW())";
		//force UTF8 chars:
		mysqli_query($link, "set names 'utf8'");
		if(mysqli_query($link, $sql)){
			$rating_return = "success";
		} else{
			echo "ERROR: Could not execute $sql. " . mysqli_error($link);
		}
		
		CloseCon($link);
		//$query->set('modified = NOW()');
		break;
}

//return it:
echo $rating_return;
?>