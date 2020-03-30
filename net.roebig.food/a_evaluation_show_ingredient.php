<?
include_once('../func/php_header.php');
include_once('../func/php.php');

if( $user_cnt == 1 ){
	if( isset( $_GET['food'] ) ){
		$food = secure_sql($_GET['food']);
		$food_id = transform_strings_2_ids($food);
		
		$q = '
		SELECT * FROM food_diary, food_feelings, food_ingredients
		WHERE food_diary.feeling = food_feelings.feeling
		AND food_diary.foods = food_ingredients.id
		AND food_feelings.language = "'.$language.'"
		AND user_id = '.$active_user.'
		AND food_diary.foods LIKE "%'.$food_id.'%"
		ORDER BY ReportedFor DESC, Type DESC, meal DESC ';
		$arr = sql($q);
		
		echo '<br><br><center>';
		echo '<button class="button_blue" name="tabs_reactivate_evaluation" id="tabs_reactivate_evaluation">'.$language_row['nav_goback'].'</button>';
		echo '<button class="button_green" name="tabs_update_ingredient" id="tabs_update_ingredient">'.$language_row['nav_edit'].'</button>';
		echo '</center>';
		
		echo '<input type="hidden" value="'.$food_id.'" id="ingredent_id" name="ingredent_id">';
		echo '<table>';
			echo '<thead>';
				echo '<tr>';
					echo '<th class="sorting_table">'.$language_row['his_date'].'<br>'.$language_row['his_meal'].'</th>';
					echo '<th class="sorting_table">'.$language_row['his_ingredients'].'</th>';
				echo '</tr>';
			echo '</thead>';
			echo '<tbody id="filter_table">';
				include('a_history_show_meals.php');
			echo '</tbody>';
		echo '</table>';
	}else{
		echo '<div class="red_error">Did not receive any valid search.</div>';
	}
}
?>