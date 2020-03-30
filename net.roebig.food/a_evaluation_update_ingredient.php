<?
include_once('../func/php_header.php');
include_once('../func/php.php');

if( $user_cnt == 1 ){
	if( isset($_GET['ingredient']) ){
		$ingredient_id = secure_sql($_GET['ingredient']);
		
		$q = '
		SELECT * FROM food_ingredients
		WHERE food_ingredients.id = "'.$ingredient_id.'"';
		$arr = sql($q);
		$row = $arr->fetch_assoc();
	?>
	<form id="form_post_ingredient" name="form_post_ingredient" method="post" action="">
		<span class="text-input-wrapper">
			<input type="text" id="ingredient" name="ingredient" autocomplete="off" value="<? echo $row['name']; ?>"/>
			<input type="hidden" value="<? echo $row['id']?>" name="ingredient_id" id="ingredient_id">
		<span title="Clear">&times;</span></span>
		<br>
		<div id="last_used"><?echo $language_row['last_used']." ".$row['last_used']; ?></div>
		<br><br>
		
		<button class="button_blue" name="tabs_reactivate_evaluation" id="tabs_reactivate_evaluation"><? echo $language_row['nav_goback']; ?></button>
		<button id="db_ingredient_delete" name="db_ingredient_delete" class="button_red"><img width="18px" height="18px" src=" data:image/png;base64,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"></button>
		
		<button id="db_ingredient_update" name="db_ingredient_update" class="button_green"><img width="18px" height="18px" src=" data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAAZdEVYdFNvZnR3YXJlAHBhaW50Lm5ldCA0LjAuMjHxIGmVAAACH0lEQVRYR+2XzUoDMRSF+zTzLD5UVVxotS7UhUtxKUJ1rYhU3enWrZROmbaLofSP/lIYz5nclhmaTJNSwUI/CEmTc2/uZG6SaW7HVhFFkYeSH4/HhUajce/7/jML2+zjGDUij/XT6fQEY6fJfmdoPBgMzvv9fgvtTHq9Xms0GhXR9MIwvFW9UdTpdD5RuQVBg9lstk+nsRcHYBN2u91Afs7Ji+vVQOxh6R6U3cawCwDCv5ic2AXAZRcDLciFN1RMuEWRvkzg90CmMAOdZ3rnmKSMKpXpc9C3h1UrIwH71OpAUt6I3Ixk8BLySoxZjKc7Ukoz1Wr1VeR6oNE+vTx55hYyBZ6kUql8i1wPNFxeHSuTBxqv3W7/KLmeIAhKItcDDVfgAvvXVyaLhLM6QKhDSSUnExr+ruiX4yLNhsKEEzujHf+RtV4lhUiYS9xe13Iizh04OaIOfj5QxzCxrRKxXq+XlIkeBMattjIIaBisjuwtzcNChEaGw+GZyLVA4unuBqxAiCo7eB6XSm4GXzmHIl8Cw7xJH5UyDQIviswMLwzRL8GLZjKZvKC5J/IF6IsTznQrWj094ZWpTMxgkndUqeRMJpwOJrRMkQ20puRZG6waE9tq92w8AKfJCcSpAPhhKe/PCdrIOWI/OaEBJv2KvQBJSo/3PZw6fZaLS3dojK1UwHY7TjpiGyXPPxvNZvOuVqs9sbDNPo4l9Tu2gFzuFz22Tz8FJafjAAAAAElFTkSuQmCC"></button>
	</form>
	<? } ?>
<? } ?>