<?
$q = 'SELECT food_feelings.name, food_feelings.feeling FROM food_feelings, food_diary WHERE food_feelings.feeling = food_diary.feeling AND user_id = '.$active_user.' ORDER BY ReportedFor DESC, MEAL DESC, Type DESC LIMit 1';
?>