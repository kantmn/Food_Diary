<? header( 'Content-Type: text/html; charset=utf-8' );

$time = explode(' ', microtime());
$load_so_many_items = 50;
$start_time = $time[1] + $time[0];
$start_memory = memory_get_usage();

include_once('sql_config.php');
setlocale(LC_ALL,'en_EN.UTF-8');

// hat die session eine nutzer id
//echo $_SESSION['user_id']."...";

if( isset( $_SESSION['user_id'] ) ) {
	$active_user = $_SESSION['user_id'];
}else{
	$active_user = 1;
	//$login_redirect = '../../acc_redirect.php';
}

if( isset($active_user) ){
	// nutzer id bekannt prüfe datenbank
	$q = 'SELECT * FROM `user_accounts` WHERE id = '.secure_sql($active_user);
	$user_arr = sql($q);
	$user_cnt = $user_arr->num_rows;

	// nutzer gefunden und validiert, lade einstellungen
	if($user_cnt == 1){
		$user_row = $user_arr->fetch_assoc();
		$language = $user_row['language'];
		
		$q = 'SELECT * FROM `user_languages` WHERE language = "'.$user_row['language'].'"';
		$language_arr = sql($q);
		$language_row = $language_arr->fetch_assoc();
		
		setlocale(LC_ALL,strtolower($language_row['language']).'_'.$language_row['language'].'.UTF-8');
	}
}else{
	setlocale(LC_ALL,'en_EN.UTF-8');
}

?>