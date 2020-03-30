<?
include_once('../func/php_header.php');
include_once('../func/php.php');

if( $user_cnt == 1 ){
	$q = 'SELECT count(id) as count FROM food_diary';
	$arr = sql($q);
	$row = $arr->fetch_assoc();

	$seeker = $_POST['index'];
	$index_start = $seeker * $load_so_many_items;
	
	$q = 'SELECT * FROM food_diary, food_feelings WHERE food_feelings.feeling = food_diary.feeling AND food_feelings.language = "'.$language.'" AND user_id = "'.$active_user.'" ORDER BY ReportedFor DESC, meal DESC, type DESC LIMIT '.$load_so_many_items.' OFFSET '.secure_sql($index_start).';';
	$arr = sql($q);

	include_once('a_history_show_meals.php');
}
?>