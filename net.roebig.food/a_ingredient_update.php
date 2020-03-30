<?
include_once('../func/php_header.php');
include_once('../func/php.php');
	
if( $user_cnt == 1 ){
	if( isset($_POST['ingredient_id']) AND isset($_POST['ingredient']) ){
		$ingredient = secure_sql($_POST['ingredient']);
		$ingredient_id = secure_sql($_POST['ingredient_id']);
		
		$q = 'SELECT * FROM `food_ingredients` WHERE name = "'.$ingredient.'"';
		$arr = sql($q);
		$count = mysqli_num_rows($arr);
		$row_find_dublicate = $arr->fetch_assoc();
		
		$q = 'SELECT * FROM `food_ingredients` WHERE id = "'.$ingredient_id.'"';
		$arr = sql($q);
		$row_find_name_of_id = $arr->fetch_assoc();
		
		if( $count == 0 ){
			$q = '
			UPDATE food_ingredients SET name="'.$ingredient.'"
			WHERE id="'.$ingredient_id.'"';
			$result_diary = sql($q);
			
			$q = '
			UPDATE food_sets SET ingredients = REPLACE(ingredients, "'.$row_find_name_of_id['name'].'", "'.$ingredient.'")';
			$result_foodsets = sql($q);
			
			if( $result_diary & $result_foodsets ){
				echo '<div class="green_success">Ingredient ID '.$ingredient_id.' has been updated as "'.$ingredient.'"</div>';
			}else{
				echo '<div class="red_error">Error while updating '.$ingredient_id.' with String "'.$ingredient.'" :'.$result_foodsets.':'.$result_diary.' </div>';
			}
		}else{		
			$q = '
			UPDATE food_diary SET foods = REPLACE(foods, "'.$ingredient_id.'", "'.$row_find_dublicate['id'].'")';
			$result_diary = sql($q);
			
			$q = '
			UPDATE food_sets SET ingredients = REPLACE(ingredients, "'.$ingredient.'", "'.$row_find_dublicate['name'].'")';
			$result_foodsets = sql($q);

			
			$q = 'SELECT rating1*rate_count as rate1, rating2*rate_count as rate2, rating3*rate_count as rate3, rate_count as count FROM `food_intolerances` WHERE id_food = "'.$row_find_dublicate['id'].'"';
			$arr = sql($q);
			$row_intolerance_1 = $arr->fetch_assoc();
			
			$q = 'SELECT rating1*rate_count as rate1, rating2*rate_count as rate2, rating3*rate_count as rate3, rate_count as count FROM `food_intolerances` WHERE id_food = "'.$ingredient_id.'"';
			$arr = sql($q);
			$row_intolerance_2 = $arr->fetch_assoc();
			
			$total_count = $row_intolerance_1['count'] + $row_intolerance_2['count'];
			$total_rate1 = str_replace(',', '.', ($row_intolerance_1['rate1'] + $row_intolerance_2['rate1']) / $total_count);
			$total_rate2 = str_replace(',', '.', ($row_intolerance_1['rate2'] + $row_intolerance_2['rate2']) / $total_count);
			$total_rate3 = str_replace(',', '.', ($row_intolerance_1['rate3'] + $row_intolerance_2['rate3']) / $total_count);
			
			$q = '
			UPDATE food_intolerances SET rating1 = "'.$total_rate1.'", rating2= "'.$total_rate2.'", rating3= "'.$total_rate3.'", rate_count= "'.$total_count.'" WHERE id_food = "'.$row_find_dublicate['id'].'"';
			$result_foodintolerances = sql($q);		
			
			if( $result_foodintolerances ){
				$q = '
				DELETE FROM food_intolerances WHERE id_food = '.$ingredient_id.' LIMIT 1'; 
				$result_delete_intolerance = sql($q);
			}
			
			$q = '
			DELETE FROM food_ingredients WHERE id = '.$ingredient_id.' LIMIT 1'; 
			$result_delete_ingredients = sql($q);

			if( $result_diary & $result_foodsets & $result_delete_ingredients & $result_foodintolerances){
				echo '<div class="green_success">Replaced Ingredient '.$ingredient_id.' with '.$row_find_dublicate['id'].', and deleted Ingredient '.$ingredient_id.' successfully</div>';
			}else{
				echo '<div class="red_error">Error while updating '.$ingredient_id.' with '.$row_find_dublicate['id'].' :'.$result_foodsets.':'.$result_diary.':'.$result_delete_intolerance.':'.$result_delete_ingredients.':'.$result_foodintolerances.' </div>';
			}
		}
	}else{
		echo '<div class="red_error">Required values could not been retrieved</div>';
	}
}
?>