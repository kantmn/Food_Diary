<?
include_once('../func/php_header.php');
include_once('../func/php.php');
	
if( $user_cnt == 1 ){
	if( isset($_POST['ingredient_id']) AND isset($_POST['ingredient']) ){
		$ingredient = secure_sql($_POST['ingredient']);
		$ingredient_id = secure_sql($_POST['ingredient_id']);
		
		$q = '
		UPDATE food_sets SET ingredients = REPLACE(ingredients, "'.$row_find_name_of_id['name'].'", "")';
		$result_foodsets = sql($q);
		
		$q = '
		DELETE FROM food_ingredients WHERE id = '.$ingredient_id.' LIMIT 1'; 
		$result_ingredients = sql($q);

		if( $result_foodsets & $result_ingredients){
			echo '<div class="green_success">Deleted Ingredient '.$ingredient_id.' successfully</div>';
		}else{
			echo '<div class="red_error">Error while updating '.$ingredient_id.' :'.$result_foodsets.':'.$result_diary.' </div>';
		}
	}else{
		echo '<div class="red_error">Required values could not been retrieved</div>';
	}
}
?>