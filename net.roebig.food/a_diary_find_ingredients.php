<?
include_once('../func/php_header.php');
include_once('../func/php.php');

if( $user_cnt == 1 ){
	// finde falls vorhanden, die foods von diesem eintrag
	$q = 'SELECT foods FROM food_diary WHERE ReportedFor="'.secure_sql($_POST['date']).'" AND meal="'.secure_sql($_POST['meal']).'" AND type="'.secure_sql($_POST['type']).'" AND user_id = '.$active_user.' LIMIT 0,1';
	$arr = sql($q);
	$row = $arr->fetch_assoc();

	$string = transform_ids_2_strings($row['foods']);
	echo $string;
}
?>