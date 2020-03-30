<?
include_once('../func/php_header.php');
include_once('../func/php.php');

if( $user_cnt == 1 ){
	if( isset($_POST['date']) AND isset($_POST['type']) AND isset($_POST['meal']) AND isset($active_user) ){
		$q = 'SELECT id FROM food_diary WHERE ReportedFor="'.secure_sql($_POST['date']).'" AND type="'.secure_sql($_POST['type']).'" AND meal="'.secure_sql($_POST['meal']).'" AND user_id = '.$active_user.' ';
		$arr = sql($q);
		$cnt = $arr->num_rows;
		
		$rows = [];
		while($row = $arr->fetch_assoc()){
			$rows[] = $row['id'];
		}
		
		if( $cnt > 0 ){
			if( $cnt > 1 ){
				echo '<div class="red_error">Report(s) '.implode(",", $arr).' is already in Database, this is a dublicates<br>Aborting database operation. This Report was not added</div>';
			}else{
				echo $q.'<br><div class="red_error">Report '.$row['id'].' is already in Database, this is a dublicates<br>Aborting database operation. This Report was not added</div>';
			}
		}else{
			//echo '<span class="green">Nothing found while checking dublicates</span><br>';
			
			$ingredient_ids = transform_strings_2_ids( secure_sql($_POST['foods']) );
			
			$rate_result = rate_latest_ingredients($active_user, secure_sql($_POST['date']), secure_sql($_POST['type']), secure_sql($_POST['meal']));
			if( $rate_result ){
				$q = 'INSERT INTO food_diary (ReportedFor, type, meal, feeling, foods, user_id) VALUES("'.secure_sql($_POST['date']).'", "'.secure_sql($_POST['type']).'", "'.secure_sql($_POST['meal']).'", "'.secure_sql($_POST['feeling']).'", "'.$ingredient_ids.'", "'.$active_user.'" )';
				
				$result_insert = sql($q);
				$last_insert = mysqli_insert_id($db);
				
				if( $result_insert ){
					echo '<div class="green_success">Report ID '.$last_insert.' has been saved.</div>';
				}else{
					echo '<div class="red_error">There was an error while saving your Report<br>'.$result_insert.'</div>';
				}
			}else{
				echo '<div class="red_error">Error while rating ingredience(s) </div>'.$rate_result;
			}
		}
	}else{
		echo '<div class="red_error">No Insert Post where found</div>';
	}
}
?>