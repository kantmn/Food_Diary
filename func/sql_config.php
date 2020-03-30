<?
//session cross to sub domain
session_name("token.".$_SERVER['SERVER_NAME']);
session_set_cookie_params(0, '/', substr($_SERVER['SERVER_NAME'],strpos($_SERVER['SERVER_NAME'],"."),100), true );
session_start();

$servername = 'DATABASENAME URL';
$database = 'DATABASE NAME';
$username = 'DATABASE USER';
$password = 'DATABASE PASSWORD';

// Create connection
$db = mysqli_connect( $servername, $username, $password, $database );
mysqli_set_charset($db,"utf8");

// Check connection
if( !$db ){ die( 'Connection failed: ' . mysqli_connect_error() ); }

/* change character set to utf8 */
if( !mysqli_set_charset($db, 'utf8') ){
	printf( 'Error loading character set utf8: %s\n', mysqli_error($db) );
	printf( 'Current character set: %s\n', mysqli_character_set_name($db) );
	exit();
}

// run queries, wait for result
function sql($query){
	if ( isset($query) ){
		global $db;
		
		if( !$result = $db->query($query) ){
			die('There was an error running the query <br>'.$query.'<br>[' . $db->error . ']');
		}
		return $result;
	}
}

// debug outputs all infos from an sql return
function print_sql($arr){
	while ($row = mysqli_fetch_assoc($arr)){
		print_r($row);
		echo '<br>';
	}
	mysqli_data_seek($arr, 0);
}

// sequres all user inputs, all inputs are surrounded by this function
function secure_sql($var){
	global $db;
	$var = preg_replace('/[^A-Za-z0-9\-\w\säÄüÜöÖß]/', '', $var);
	$var = htmlspecialchars($var, ENT_QUOTES, "UTF-8");
	$var = filter_var($var, FILTER_SANITIZE_STRING);
	$var = trim($var);
	$var = mysqli_real_escape_string($db, $var);
	
	return $var;
}
// log visitors to database
function log_visitor_2_db(){
		// prepare visitor details
		$ip = getenv ("REMOTE_ADDR");
		$agent = $_SERVER['HTTP_USER_AGENT'];
		$host = gethostbyaddr (getenv ("REMOTE_ADDR"));
		$httpref = getenv ("HTTP_REFERER");
		if ( $httpref == "" ) $httpref = $_SERVER['PHP_SELF'];

		// update db on access denied
		$s_insert_visitor = "INSERT INTO user_visitors
		(ip , agent , host , referrer)
		Values ('".$ip."', '".$agent."', '".$host."', '".$httpref."')
		ON DUPLICATE KEY UPDATE visits = visits + 1"; 
		$result = sql($s_insert_visitor);
}
?>