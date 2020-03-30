<?
include_once('../func/php_header.php');
include_once('../func/php.php');

if( $user_cnt == 1 ){
	$precission = 2;
	////////////////////////////////////////////////////////
	// TABELLE für essenbestandteile und Verträglichkeiten
	////////////////////////////////////////////////////////
	//$q = 'SELECT * FROM food_intolerances, food_ingredients WHERE food_intolerances.id_food = food_ingredients.id AND id_user = '.$active_user.' ORDER BY rate_count DESC';
	$s = 'SELECT
		food_ingredients.id, food_ingredients.name,
		food_intolerances.rating1, food_intolerances.rating2, food_intolerances.rating3,
		(SELECT count(*) FROM `food_diary` WHERE foods like "%value(food_ingredients.id)%") as count
	FROM food_intolerances, food_ingredients
	WHERE food_intolerances.id_food = food_ingredients.id AND id_user = '.$active_user.'
	ORDER BY count DESC';
	$q = sql($s);
	
	// sammle essenbestandteile und suche nach häufigkeiten der ingredients
	$s_foods ='
		SELECT foods
		FROM food_diary
		WHERE food_diary.user_id = "'.$active_user.'"
		AND foods IS NOT NULL
		AND foods != ""';
	$q_foods = sql($s_foods);
	
	
	// loop through query und sammle foods ein
	$foods = '';
	while( $a_foods = $q_foods->fetch_assoc() ){
		$foods .= $a_foods['foods']." ";
	}

	// sammle min max and avgs data
	$s_ranges = '
	SELECT 
		min(rating1) AS min_r1, avg(rating1) AS avg_r1, max(rating1) AS max_r1,
		min(rating2) AS min_r2, avg(rating2) AS avg_r2, max(rating2) AS max_r2,
		min(rating3) AS min_r3, avg(rating3) AS avg_r3, max(rating3) AS max_r3
	FROM food_intolerances
	WHERE id_user = '.$active_user;
	$q_ranges = sql($s_ranges);
	$a_ranges = $q_ranges->fetch_assoc();
	
	// sammle anzahl der wertungen nach feeling und totale
	$s_counts = '
	SELECT
		count(feeling) as total,
		SUM(if(feeling <= 0, 1, 0)) AS c0,
		SUM(if(feeling <= 1, 1, 0)) AS c1,
		SUM(if(feeling <= 2, 1, 0)) AS c2,
		SUM(if(feeling <= 3, 1, 0)) AS c3
	FROM food_diary
	WHERE feeling > 0 AND
		  user_id = '.$active_user;
	$q_counts = sql($s_counts);
	$a_counts = $q_counts->fetch_assoc();
	
	// arrays mit allen 4 farben 0-3
	$colors = array("green", "orange", "red", "black");
	
	// berechne den prozentualen anteil der feelings 0-3 basierend auf der anzahl aller feelings
	$ranges = array();
	for($p = 1; $p < 4; $p++){
		$ranges[$p] = ($a_ranges['max_r'.$p] - $a_ranges['min_r'.$p]);
	}
	
	// berechne den prozentualen anteil der feelings 0-3 basierend auf der anzahl aller feelings
	$prz_array = array();
	for($p = 0; $p < 4; $p++){
		$prz_array[$p] = number_format(($a_counts['c'.$p] / $a_counts['total']),2);
	}
	
	echo'
		<form id="form_search" name="form_search" method="">
		<span class="text-input-wrapper"><input type="text" id="filter_input" name="filter_input" autocomplete="off" size="18" placeholder="'.$language_row['tip_filterby'].'"/><span title="Clear">&times;</span></span>
		</form>
	';
	echo '<div id="eval_table">';
	echo '<table>';
	echo '<thead>';
	echo '<tr><th class="sorting_table">'.$language_row['stat_times'].'</th><th class="sorting_table">'.$language_row['stat_ingredients'].'</th><th class="sorting_table">1d</th><th class="sorting_table">2d</th><th class="sorting_table">3d</th></tr>';
	echo '</thead>';
	echo '<tbody id="filter_table">';
	/*
	$foods_arr = explode(" ",$foods);
	$foods_arr = array_unique($foods_arr);
	$foods_arr = array_filter($foods_arr);
	
	$foods_count = array();
	foreach ($foods_arr as &$element) {
		//$new = array( 'id' => $element, 'count' => substr_count($foods, $element) );
		//$foods_arr = array_merge ($foods_arr, $new);
		//$foods_count['id'] = $element + ;
		//$foods_count['count'] = substr_count($foods, $element);
	}
	
	arsort($foods_count);

	var_dump($foods_count);

	foreach( $foods_count as $var ) {
		//echo $var['id']." ".$var['count']."<br>";
	}
	*/
	while ( $row = $q->fetch_assoc() ) {
		echo '<tr>';
			// substr_count: wie oft row[id] = ingredient occurs in $foods array
			echo '<td>'.substr_count($foods, $row['id']).'</td>';
			echo '<td class="row_food"><span id="ingredient_'.$row['id'].'">'.$row['name'].'</td>';
			
			// d = days => avg 1d 2d und 3d
			for($d = 1; $d < 4; $d++){
				$color = 'green';

				// v = value für die vergleich mit schwelle basierend auf D
				$v = number_format(round($row['rating'.$d], $precission), $precission);
				
				// f = feeling loop 0-3
				for($f = 0; $f < 4; $f++){
					// $s wert die z. schwelle für feeling
					$s = number_format(( ($prz_array[$f] * $ranges[$d]) + $a_ranges['min_r'.$d]),$precission);
					
					// einsortierung in die intervalle, wenn v = wert größer als die schwelle ist, ändere farbe
					if( $v >= $s ){
						$color = $colors[$f];
					}else{
						//break;
					}
				}
				echo '<td class="'.$color.'">'.$v.'</td>';
			}
		echo '</tr>';
	}
	echo '</tbody>';
	echo '</table>';
	echo '</div>';
}
?>