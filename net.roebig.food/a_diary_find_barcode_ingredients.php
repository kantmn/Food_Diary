<?
include_once('../func/php_header.php');
include_once('../func/php.php');

if( $user_cnt == 1 ){
	print_and_edit_details_from_barcode( secure_sql($_POST['barcode']) );
}
?>