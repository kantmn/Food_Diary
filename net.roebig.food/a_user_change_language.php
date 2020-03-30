<?
include_once('../func/php_header.php');
include_once('../func/php.php');
		
if( $user_cnt == 1 ){
	if( 
		isset($_POST['language']) AND 
		isset($active_user) 
	){
		$language = secure_sql($_POST['language']);

		$q = 'UPDATE user_accounts
		SET language = "'.$language.'"
		WHERE id="'.$active_user.'"';
		$arr = sql($q);
		
		if( $arr ){
			echo '<div class="green_success">User language has been updated to '.$language.'</div>';
		}else{
			echo '<div class="red_error">Error while updating language '.$language.' for id '.$active_user.'</div>';
		}
	}else{
		echo '<div class="red_error">Not all required fields received. Update aborted</div>';
	}
}
?>