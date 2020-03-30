<?
include_once('../func/php_header.php');
include_once('../func/php.php');

if( $user_cnt == 1 ){
	transform_barcode_2_strings( secure_sql($_POST['foods']) );
}
?>