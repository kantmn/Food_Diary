<?
include_once('../func/php_header.php');
include_once('../func/php.php');
	
if( $user_cnt == 1 ){
	if( isset($_POST['date']) AND isset($_POST['type']) AND isset($active_user) ){
		$ingredient_ids = transform_strings_2_ids( secure_sql($_POST['foods']) );
		
		$q_1 = 'SET @LastUpdateID := 0';
		$q_2 = 'UPDATE food_diary SET 
		feeling="'.secure_sql($_POST['feeling']).'", 
		foods="'.$ingredient_ids.'", 
		id = (SELECT @LastUpdateID := id) 
		WHERE 
		ReportedFor="'.secure_sql($_POST['date']).'" 
		AND type="'.secure_sql($_POST['type']).'" 
		AND meal="'.secure_sql($_POST['meal']).'"
		AND user_id = '.$active_user.' ';
		$q_3 = 'SELECT @LastUpdateID AS LastUpdateID';

		//$q = 'UPDATE food_diary SET feeling="'.secure_sql($_POST['feeling']).'", foods="'.sort_words_in_string_alphabetically(secure_sql($_POST['foods'])).'" WHERE ReportedFor="'.secure_sql($_POST['date']).'" AND type="'.secure_sql($_POST['type']).'" AND meal="'.secure_sql($_POST['meal']).'" ';
		
		$rate_result = rate_latest_ingredients($active_user, secure_sql($_POST['date']), secure_sql($_POST['type']), secure_sql($_POST['meal']));
		if( $rate_result ){
			$result_update_1 = sql($q_1);
			$result_update_2 = sql($q_2);
			$result_update_3 = sql($q_3);
			$row = $result_update_3->fetch_assoc();
		}else{
			echo '<div class="red_error">Error while rating ingredience(s) </div>'.$rate_result;
		}
		if( $result_update_2 ){
			echo '<div class="green_success">Report ID '.$row['LastUpdateID'].' has been updated</div>';
		}else{
			echo '<div class="red_error">There was an error while updating your Report '.$row['LastUpdateID'].'<br>'.$result_update_2.'</div>';
		}
	}else{
		echo '<div class="red_error">Report ID '.$row['LastUpdateID'].' has already same value and has not been updated</div>';
	}
}
?>