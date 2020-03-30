<?
include_once('../func/php_header.php');
include_once('../func/php.php');

if( $user_cnt == 1 ){
	echo '<div id="stats_table">';
		echo '<table>';
			echo '<thead>';
				echo '<tr>';
					echo '<th class="sorting_table">'.$language_row['his_date'].'<br>'.$language_row['his_meal'].'</th>';
					echo '<th class="sorting_table">'.$language_row['his_ingredients'].'</th>';
				echo '</tr>';
			echo '</thead>';
			echo '<tbody id="filter_table">';
				// lade dynamisch weitere einträge
				include('a_history_next_page.php');
			echo '</tbody>';
		echo '</table>';
	echo '</div>';
	echo '<input type="hidden" name="scroll_index" id="scroll_index" value="0">';
}
?>