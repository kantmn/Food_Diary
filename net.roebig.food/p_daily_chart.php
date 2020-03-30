<?
include_once('../func/php_header.php');
include_once('../func/php.php');

if( $user_cnt == 1 ){
	/*
    $q = 'SELECT type, food_meals.name, avg(food_diary.feeling) as avg
    FROM food_meals, food_diary
    WHERE food_meals.meal = food_diary.meal
     AND food_meals.language = "'.$language.'" AND user_id = "'.$active_user.'"
     AND food_diary.feeling is not null
     GROUP BY food_diary.meal, food_diary.type';
    */
	
    $q = 'SELECT food_diary.type, food_meals.name, avg(food_diary.feeling) as avg,
        count(food_diary.feeling) as count, 
        SUM(food_diary.feeling=0) as good,
        SUM(food_diary.feeling=1) as ok,
        SUM(food_diary.feeling=2) as bad,
        SUM(food_diary.feeling=3 OR food_diary.feeling=5) as terrible
    FROM food_meals, food_diary
    WHERE food_meals.meal = food_diary.meal
     AND food_meals.language = "'.$language.'" AND user_id = "'.$active_user.'"
     AND food_diary.feeling is not null
     GROUP BY food_diary.meal, food_diary.type';
    $arr = sql($q);
    
	include_once('q_select_types.php');
	$types_arr = sql($q);
	$type_filter = [];
	while ( $types_row = $types_arr->fetch_assoc() ) {
		array_push($type_filter, $types_row['name']);
	}
	
	include_once('q_select_feelings.php');
	$feelings_arr = sql($q);
	$feelings_filter = [];
	while ( $feelings_row = $feelings_arr->fetch_assoc() ) {
		array_push($feelings_filter, $feelings_row['name']);
	}
	?>
	<div class="proz_bar">
		<div class="center feelbar_good" style="width:25%;"><? echo $feelings_filter[0]; ?></div>
		<div class="feelbar_ok" style="width:25%;"><? echo $feelings_filter[1]; ?></div>
		<div class="feelbar_bad" style="width:25%;"><? echo $feelings_filter[2]; ?></div>
		<div class="feelbar_terrible" style="width:25%;"><? echo $feelings_filter[3]; ?></div>
	</div>
	<br><br>
	<?
    while ( $row = $arr->fetch_assoc() ) {
        //$type_filter = array('Vor dem ','Während dem ', 'Nach dem ');
        
		echo $type_filter[$row['type']+1]." ".$row['name'];
        echo "<br>".$language_row['chart_average'].": ".round($row['avg'],2)."<br>".$language_row['chart_total'].": ".$row['count']."<br>";

        $good = round(($row['good']/$row['count']*100),0);
        $ok = round(($row['ok']/$row['count']*100),0);
        $bad = round(($row['bad']/$row['count']*100),0);
        $terrible = round(($row['terrible']/$row['count']*100),0);
        
        $proz_array = ["good"=>$good, "ok"=>$ok, "bad"=>$bad, "terrible"=>$terrible];
        $array_sum = array_sum($proz_array);

        if($array_sum !== 100){
            $value = max($proz_array);
            $key = array_search($value, $proz_array);
            $proz_array[$key] = $value-($array_sum-100);
        }
        ?>
        <div class="proz_bar">
            <div class="feelbar_good" style="width:<? echo $proz_array["good"]; ?>%;">&nbsp;</div>
            <div class="feelbar_ok" style="width:<? echo $proz_array["ok"]; ?>%;">&nbsp;</div>
            <div class="feelbar_bad" style="width:<? echo $proz_array["bad"]; ?>%;">&nbsp;</div>
            <div class="feelbar_terrible" style="width:<? echo $proz_array["terrible"]; ?>%;">&nbsp;</div>
        </div>
        <br>
		<script>
			$(".proz_bar").animate({ width: "100%" }, 1500);
		</script>
        <?
    }
}
?>