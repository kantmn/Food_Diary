<?
include_once('../func/php_header.php');
include_once('../func/php.php');

if( $user_cnt == 1 ){

include_once('q_find_next_meal.php');

?>
<table>
	<tr>
		<th>
			<h3><? echo $language_row['sug_latest_scans']; ?></h3>
		</th>
		<th>
			<h3><? echo $language_row['sug_latest_ingredients']; ?></h3>
		</th>
	</tr>
	<tr class="no_hover cell_top">
		<td>
		<?	
			// letzte scans
			if( $user_cnt == 1 ){
				$q = 'SELECT * FROM food_sets ORDER BY last_used DESC LIMIT 9';
				$food_sets_latest_arr = sql($q);
				
				echo '<div id="food_sets_latest">';
					$latest_foods_sets = array();
					while( $row = $food_sets_latest_arr->fetch_assoc()) {
						
						// go through results and print 3 uniques, add to array if found unique
						//if (!in_array($string, $latest_foods_sets)) {
							//array_push($latest_foods_sets, $string);
							echo '<div id="'.$row['barcode'].'" class="oneliner">'.$row['firma'].' - '.$row['name'].'</div>';
							//echo '<div>'.trim_string_if_too_long($string, 55).'</div>';
						//}
					}
				echo '</div>';
			}
		?>
		</td>
		<td>
		<?
			// letzten gerichte
			if( isset($_POST['meal']) ){
				$meal = secure_sql($_POST['meal']);
			}
			
			if( $user_cnt == 1 ){
				//$q = 'SELECT foods FROM food_diary WHERE foods <> "" AND (meal="'.$meal.'" OR meal="'.$last_meal.'") AND user_id = '.$active_user.' ORDER BY meal DESC, ReportedFor DESC LIMIT 9';
				$q = 'SELECT name FROM food_ingredients ORDER BY last_used DESC LIMIT 9';
				$food_latest_arr = sql($q);
				
				echo '<div id="food_latest">';
					$latest_foods = array();
					while( $row = $food_latest_arr->fetch_assoc()) {
						// go through results and print 3 uniques, add to array if found unique
						//if (!in_array($string, $latest_foods)) {
							//array_push($latest_foods, $string);
							echo '<div class="oneliner">'.$row['name'].'</div>';
							//echo '<div>'.trim_string_if_too_long($string, 55).'</div>';
						//}
					}
				echo '</div>';
			}
		?>
		</td>
	</tr>
</table>
<? } ?>