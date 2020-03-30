<?
include_once('../func/php_header.php');
include_once('../func/php.php');

if( $user_cnt == 1 ){
	// finde den nächsten fehlenden eintrag und setze dropdowns auf diesen wert
	$q = 'SELECT ReportedFor, type, meal FROM food_diary WHERE user_id = '.$active_user.' ORDER BY ReportedFor DESC, meal DESC, type DESC LIMIT 0,1';
	$arr = sql($q);

	while ( $row = $arr->fetch_assoc() ) {
		$termin = $row['ReportedFor'];
		$type = $row['type'];
		$meal = $row['meal'];
	}

	if( $type == 1 ){
		if( $meal == 3 ){
			$last_meal = $meal;
			$meal = 1;
			$termin = date('Y-m-d', strtotime($termin . '+1 day') );
		}else{
			$last_meal = $meal;
			$meal++;
		}
		$type = -1;
	}else{
		$type++;
	}
}
?>