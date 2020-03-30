<?
include_once('../func/php_header.php');
include_once('../func/php.php');

if( $user_cnt == 1 ){
?>
<html>
<head>
	<title>Chart History</title>
	<meta name="title" content="Whois">
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no" />
	<style type="text/css">
	</style>
</head>
<body>
	<script type="text/javascript">
	window.onload = function () {
		var chart = new CanvasJS.Chart("chartContainer", {
			animationEnabled: true,
			theme: "light1",
			title:{
				text: "Feeling History"
			},
			axisY:{
				includeZero: true
			},
			data: [{
				type: "area",
				dataPoints: [<?
				
				$days = $_GET['x'];
				if( $days <= 0){ $days = 1; }
				
				function calc_avg_on_days($array, $now, $days){
					$tmp = 0;
					for( $i=0; $i<=$days; $i++ ){
						$tmp += $array[$now+$i][1];
					}
					return round($tmp/$days,1);
				}
				$queryDays = secure_sql($_GET['d']);
				if( $queryDays <= 0 ){
					$queryDays = 365;
				}
				$q = 'SELECT ReportedFor, round(AVG(feeling),1) AS feeling FROM `food_diary` WHERE feeling >= 0 AND feeling <= 3 AND user_id = '.$active_user.' AND DATEDIFF(CURDATE(), STR_TO_DATE(ReportedFor,"%Y-%m-%d")) < '.$queryDays.' GROUP by ReportedFor ORDER BY ReportedFor ASC, meal asc, type asc';
				$arr = sql($q);
				$feels = [[]];
				
				while ( $row = $arr->fetch_assoc() ) {
					$x++;
					$feels[][0] = $row['ReportedFor'];
					$feels[][1] = $row['feeling'];
				}
				
				$tmp = calc_avg_on_days($feels, 1, $days);
				$date = date('Y, n-1, j', strtotime($feels[1][0].' 00:00:00'));
				echo '{x: new Date('.$date.'), y: '.number_format($tmp,1).'}';
				
				for( $i=3; $i<(sizeof($feels)); $i+=2 ){
					$tmp = calc_avg_on_days($feels, $i, $days);
					$date = date('Y, m-1, j', strtotime($feels[$i][0].' 00:00:00'));
					echo ', {x: new Date('.$date.'), y: '.number_format($tmp,1).'}';
				}
				?>]
			}]
		});
		chart.render();
	}
	</script>
	<div id="chartContainer" style="max-height: 75%; height: auto; width: 100%;"></div>
	<script type="text/javascript"><? include_once('j_chart.php');?></script>
	<?
	//print_r($feels);
	//echo date("Y-m-d H:i:s");
	?>
</body>
</html>
<?
}else{
	include_once($login_redirect);
}
?>