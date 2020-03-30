<?
include_once('../func/php_header.php');
include_once('../func/php.php');

if( $user_cnt == 1 ){
	include_once('q_find_next_meal.php');

	include_once('q_select_last_feeling.php');
	$arr = sql($q);
	$feeling = $arr->fetch_assoc();
	$feeling = $feeling['feeling'];

	include_once('q_select_feelings.php');
	$feeling_arr = sql($q);
	$feeling_count = $feeling_arr->num_rows;

	include_once('q_select_meals.php');
	$meal_arr = sql($q);
	$meal_count = $meal_arr->num_rows;
	
	include_once('q_select_types.php');
	$types_arr = sql($q);
	$types_count = $types_arr->num_rows;

?>
<form id="form_post" name="form_post" method="post" action="">
	<div id="form_dropdowns">
		<select name="date" id="date">
			<? for ( $i=-25; $i<=1; $i++ ){
				$datum = strtotime('+'.$i.' day', strtotime(date('Y-m-d 00:00:00')));
				if ( $datum == strtotime($termin) ){
					$selected = 'selected';
				}else{
					$selected = '';
				}
				echo '<option value="'.date('Y-m-d', $datum).'" '.$selected.'>'.strftime("%a %e. %b", $datum).'</option>';
			} ?>
		</select>
		<select name="feeling" id="feeling">
		<?
			for( $f = 0; $f < ($feeling_count -1); $f++ ){
				$feeling_row = $feeling_arr->fetch_assoc();
				echo '<option value="'.$f.'"';
				if( $feeling == $f ) echo " selected";
				echo '>'.$feeling_row['name'].'</option>';
			}
		?>
		</select>
		<select name="type" id="type">
		<?
			for( $t = -1; $t <= 1; $t++ ){
				$types_row = $types_arr->fetch_assoc();
				echo '<option value="'.$t.'"';
				if( $type == $t ) echo " selected";
				echo '>'.$types_row['name'].'</option>';
			}
		?>
		</select>
		<select name="meal" id="meal">
		<?
			for( $m = 1; $m <= $meal_count; $m++ ){
				$meal_row = $meal_arr->fetch_assoc();
				echo '<option value="'.$m.'"';
				if( $meal == $m ) echo " selected";
				echo '>'.$meal_row['name'].'</option>';
			}
		?>
		</select>

		<!--<span class="text-input-wrapper">-->
			<!--<input type="text" id="foods" name="foods" autocomplete="off" size="18" placeholder="Insert your ingredients"/>-->
			<textarea id="foods" name="foods" autocomplete="off" rows="5"></textarea>
		<!--<span title="Clear">&times;</span></span>-->
	</div>
	<button id="clear_foods" class="button_red"><img width="18px" height="18px" src=" data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAAYdEVYdFNvZnR3YXJlAHBhaW50Lm5ldCA0LjEuNv1OCegAAAkkSURBVFhH1Zh5UFXnGcYdGjPaOh2tY9IktdM2k7TG2ui0jop7qkYQl9pRidGqxeBYE0XrWBqjxmViFZM07krNiBsoiFhEAUFQB7nsXLj7cu4959xz7n5ZZBPRp+937nHJHwZImun0mXnmHA53zvPj/d5v4fb5ttq2bVuEevs/1/fIL+3fv98SFRU1ne4nDho0aHxiYuICuv85+Qfk70zfJ08fMPCFbcPGRV8eFxNvnRG7oXPx2r24kJWPzMxMrP5gI/YfOo7zGVlYvO4Qpr+7AyOmJQSG/Hpxaf8XRyX36ROxkt7xU+Vt31CsAgvfnBiVE7t2Z8euE/lIu8njqkbEDY0FFy9dxu2SMlwvuAGjyYTKqipYrVZcyclBvcUFMx+EnvOj3OBFWpEbm4/VYkLsZw8H/mJmEb13gpLQC738xpiplVuO5SAlz4K0PD0uFZlxrcSO9MsFKCy6Bcnjg8VihSAIkGQ3Ghsb0dzcDBPBZWZlw+QMKEB1Ni9qLG5UGGVo9C6k5IsYHXu0K6LvDxepWd1r2OhJ6YeumHDsYjVSsutwPs+ALALKJaCUM2mwcQ7IHi9ktwdudximtbUV7e3tyr22rh65hSWPgarNT4BK6gScLRQxePjSm2pc95q8MN55NNuI45k1OHWFgPINuFxswdnMQuTm5UNvMKKNwhmA3++Hw8nD4SBIWUZjUxM8/iDuaMqRkXUVlXpBBZKg0blwo1rA8iQRQ4av0Klx3evNWYvFPSV+JBc6ceqqHhdUoJRzmcgjoKLiYpSVlYMjCM4poLyiEgajETa7HSazBXYHD18giPSLl6DR2hWg3HIJ20+LmLKex8gVdrw4YnWNGte9Rs1eUpdY7MbfCj3YfsOPfdfdBCfhRLYWpzOuwRNohEuSYOc4CneiVKNBnU5PECE4pQCqjB4UVPqx5Ug5VuyqxawPBYxc6cDI5fbHHjZpQ7Ea170mvx2Ts6fUh435MhJyZLyfJWF1hoT4VPIZGe+ddGPlCTfi/+XGe8dkrDgk451PJcTsdGHaZgGTN/GYkODA2DUcRsdzGPXnJyC/i7Pj4xM83poenaHGda9+/fodamrtQK61GdsKvFiTKWHVBQlxZ11YftKFJckiYg+LWPCFgD/sEzB7N4+oHTxmbHHirUQnJv3VgfFrOYxZzeG3K+0YRUMUs8mB7V+KKKyUUGGQ8NrrbxxR43qkTXY7hwcPH+LBg4cQGzpRbG3BaU0D9lzzYf0ZAXHHBcTuFzA/icecT3jE7HBiznYOC3basWy3FQkHOCSlupF63YMynY9mnA91Vg/1k6wADR48ZIea1SMtKr55C11dD75qgmOWJJlmlRMiu/IirARfS1P9dkkpTXkdtPV6GK0CnHIDbGKIFkm2Jj0B0tQLiIiISFCzeqTIM2fPofP+g8e+z0xQzO0dHQiGQjTDeJpZDpphJpTcKYWmvBJmKweDhSMYavBnAN0oM4AyloWjeqahe/YmoaOzC/ee9v0ugmMOA7a2tsHr8ylbR3llNYwEYrI6YLaLEL1NzwTKLihjQHPCUT3Tc+sS1ne1d9xH+72wOxQ/gXsarONeJwINd8mtkH2N5OavBUrNKmBAk8NRPdSSpX+SWts7wdxGYMyPwOTqGnBXrjwGY+BNLR0INbVBFr2o2LcPpoq6ZwIln7nEgEaFk3qomTOjyu623UNLWydaHoGpcNVrV8EUMx76o4cVqBb6HAPy+xuhWbcGpqhxKPvn/mcCfX4khQG9Gk7qoUaMGJHZTCHNrfdwl8xCGRwDc+uMqFk4S4GqP3xQ+X1jUyvKNyfCHD0Od1bFwen0PBNoV9JBBvRCOKmHGjBgwIGG5nY03SWor4CFoWSdQYEyzhoP7cEDqN6zG6boSJQtfwe83fXsHjLJSNy6mwH1Cyf1XIkWuwAG1UhQbEiaW55AMQu1OlQtiFagmCti54I3cXD7734t0NqNH3WqGb3S0qJbpUqjKlBPV4vAws86UHPkKCyzImEmoDsHDkCQ/HB5Gx8DWXg/jI6nVmoCWvX+xgY1o1eaejYtA4HGNgQJKtTUrkCEyEF6xn42X81DXcwkaOdMRW3MZNREUU/R0dbp8sBk42GioTPQiq01i6jWO6BVgZbF/UVUM3ql15I+/QK+UKuyvvjJ7N7PfiYga9Ft1M6egproCai8kI7y1FTU0r2WAA1XcyF5Q1SpEByiB0abAMEdJCinArTw3RUGNaNX6p+wYdNDiRY5mXrCHbgLb7CF+qMJlrIq1MydhnoCMFFFPL4gHWl9qEk7jzp6VhU9Ebr8Qjob+QjIS9USYBc8qDPT6ZGAZs9fVK5m9E5Ll630ubwE5HsCxHqEVUAzkyqTnEwwbE8TaQ+z01mbhz4jA5VvR0Lzj08geoKw8TLMnAtavQ1VhjDQ72fMKlAjeqc58/5Y/gjIzntgMHMQqD9CjQToctPwNdEpkbYKt482WzpLU6UkTwC1t0vpKEufdQfAUWUsBMT6qdYYHrIxkRMz1YjeaWzkxPRHQJKvCTanS6lCgMIZmOwN0oG+QbnnRbdSLSddrZwInoZLZ7JTZSx05cC5/Kg383ToFzFs+G9OqhG900uvvLKXAbE+ctBfKso+eP0heNnZmXfRtYF6x69YlKgSNqcCxkAlMoOp0hpQVauneytqdFaU1trw45d/8rka0WutMjvccEgNSundtFcFaVfnabhYVQSCMJptyn8ZDI5B+ugqMUjWW4IMkYaNnY8qavTQWWj6G0U89/zzW9X391pTs/NuwugMl9vmkJQ+4iUvhQapryR6JhKUnZ7blCurFBs6D1VSoM9ZOQF6kw1anQWcGMCptCy2bcwLv7736jt12gyt1kSLnMNDfzEFEBSzk2abnXdTw4qoN1qVPnHR6mx1uB73EasM+x37vOhpQMblXAwd+rN0eu+3+gpnyOu/GvbvpM8OIjx8ofCsobWl3khNSzbaZdqzqGIumuZUBSPnht5KZ23eB5sQwPnMHCyMXcpFRPSNp/f9175PGjNw4I+OzZ03n//7Rx/jy5RzuF5Ugqo6M/QWgjM7oak2IOf6bSSfTMWHW3d2LVm2Uvvqa79kDTyF/J1+sTWYPJY8n8y+9/lAdRx5LnkkuT/5/119+vwHC9uFtg5CmuAAAAAASUVORK5CYII="></button>
	
	<button id="quagga_on" class="barcode button_white"><img width="18px" height="18px" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAAYdEVYdFNvZnR3YXJlAHBhaW50Lm5ldCA0LjEuNv1OCegAAAVGSURBVFhHjdd5yKZTGMfxB6Hs69iyNjOF0PCf8IeaKPxhp5jGkKUkW5lkyy6EEGESQsgSM42QpKxFtlDWSdbsS/Zmfp8z9zXdzz3vO71Xfd/3Xs65zu8+13Wuc55RbOkqeCqwjYP71cInYd9Qdlbw7oV2NxqtEar/boGPup+I9kfDLQdwPBTwTdgjrBluDycH7R4LG4btwpKg/4+hBGgz9O/dCgEe3B/e6Dg1zAslwFftGf4JO3oQezBwPC2cGPR7OuzVXf8bSgBffJZ/YxlzTIAXrnFpKAHbh/sCOyiss/yyCXg3PBGuC+cF4RGmQzo2CCWAz/JvrCkL2CQcF8ouC9MDAdo+G+YHIs4IN4e+TVmAKdII+4cSYIov7GBnBteXhFfC9eGY8Hm4IfwZ+lYC+Cz/xhoTIJYa9bk76CyOf4UFYU5YL8h4gxq8BHwdHg4l4Nggefnga+jfmE2ABpPhSwn4NRwYZPsWgYCrwqMdpp7Ao8PCoK0++vIxke+i2c5BY0lTRv0OYUZ4L1C7e1grGOyn7tl3wZKcGySh9++E/wKffPgvlPJJUq9kpo8zmSvLDW5pPRAsQU68h2UoDPcE0y0E+v0SCCj7PhjYV+pnJvi0avg0Bpr1Bfga176ScVKDgwAhODxUDjDVcaoC1JTy18zaxSPhhO5awon5RAK8Z9Xv0PB8MP1lJcB7H0MAOzi8GjYPTQDVNRUSbP3ll22ajwxfBPHeKfwdqhKWEXxX2LrdjUZrBz7lgL6uJeQP3fW9YZsgDM0XFS8F0zrkziC5lNUXw/9hKICzU8It7W40Wj0Ih5zozxyRipUQSGyz26wanBte792bUstLTghHPe8LUCEhHwg0gyok9FEf3gp87BoIJWCj4J12rSDUpiIJ6/78oGoZwLTWc7se8/yCsF9Qmu0FvrKE3hq2CocF5Xt2IOCjwM9mQbsxGwqQtRrWMybmpp36xwMBTI70BeDacHYg4OIgyUvAuqGtINMH03JOqCm8Muwd7PGqHYcyWiKJsTaePRnKx2lB8nknYReHr4IQ2Ds8N4axqk9zIgmPCiqV6VStlFMdrdmq//uEL8Pp4blAjNh/EKwUy6v2AsKOCJ59GOSEDWiXIAmNaezmxDK0RZ4UHBZuCpKNqGe6a3DkUKIjrgibBglF4Lbh/aCt1WBf4N+XGkOe8CeEK3LAesSbgXNfYNmZSg7MgN1QY3vFp921ttrdGI4PBDAJ670ByrfQKUT6WMq2cUnfZkvjQhIyjVUvYbCx+Mp+O9R2XPcE+PJ+m0ItYZJaaHyU8t+sNgXrlQDF4o/gq1UwM/FxIEJiOfO9HH4LaofnQkeAaa+p7aOt0vx7WElAmeQzxeKjhhfiR4SZ0FG9t+S8uzp47iTMuZCZbu9+DvqWn9rkSoDwvR3GDgdDhMLeIBQwgKVVfBY49fXeV01gtRldHg4Iipq23wZbuROT+/ZHYRgemepIxpwR5ISZcAD1/rXwUIf1bWk5JQmDtkJIgMFnhhIg1Er8baHlhoerOpQyOaIdnHrVCYNaUgqMclvnAVlfbU17+VQv7DWObWM5UAImO5azEnBH4LR/LB8eSEqAGbQFLwoKlWf6Eq9+TFmAxJRMksdPMqZE+yJt7Qe+iABOrSQ7niooR+SGkJQA712rnG3ZuyFgsp9mldEGkeHM4L5WQsG+MSv4pVSlWBKqisReFPg1W+Je46AJMAgRfSQmAU7MBtHOxuSd+m5WxP+aYO3Xj1M/UBgBVoVlay/Rxo8as8OqZjTHkzFREhYEMELdVykuI8DzfghQAjL4aOky2nUHVap4MI4AAAAASUVORK5CYII="></button>
	<button id="quagga_off" style="display: none" class="barcode button_green">OFF</button>
	
	<button id="db_insert" name="db_insert" class="button_blue"><img width="18px" height="18px" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAAZdEVYdFNvZnR3YXJlAHBhaW50Lm5ldCA0LjAuMjHxIGmVAAABiUlEQVRYR+2VP0vDQByGS0fxKyhuLu5CQXAScRMKIg5uKn4FRxH/LIogjn4IVx0FRz+AOBbqFGyaNDWJPpe+NrVGbWMOHPLAEbjf3fu+d0nuKiV5CIJgLo7j68HmeV5NZft0Op3VtyEcx1lX2T5lgDJAGYAAdfn2abVaGyoXB6vaxswfbq8g3z6mL2tsu93el9z4oFvtdrtXPYvxCcPwlseE5PJhBBC6SRTHgDkPzWZzUjJ/wwgheC/tX4mi6Im7YVrTiwHBKYQf5fETDu9+VtOKxff9GUI0ZPQFai5BFzTcDnyUNYxe5NmHKznkml7TMLuwE4uE8ORtzGP6dlTOh+u6S4gcfzS2ck+lTPgoNwkRmQA8TtWdCefJ1qA2Z0NdpRQKR8lyBAbPKn0Lc3bZ9kuGV9WVCYZ3PdUeLPZCpZQ8AUYlI8C5SillgH8XwPzXtEZBLZBswkgBbJIZgOv8QHXrEOBMtim8p3m2KtQYa5jDi8WuyPYzJgQHyyHPExvNvGbMl2VXApXKOwyGVRmw+1ZqAAAAAElFTkSuQmCC"></button>
	
	<button id="db_update" name="db_update" class="button_green"><img width="18px" height="18px" src=" data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAAZdEVYdFNvZnR3YXJlAHBhaW50Lm5ldCA0LjAuMjHxIGmVAAACH0lEQVRYR+2XzUoDMRSF+zTzLD5UVVxotS7UhUtxKUJ1rYhU3enWrZROmbaLofSP/lIYz5nclhmaTJNSwUI/CEmTc2/uZG6SaW7HVhFFkYeSH4/HhUajce/7/jML2+zjGDUij/XT6fQEY6fJfmdoPBgMzvv9fgvtTHq9Xms0GhXR9MIwvFW9UdTpdD5RuQVBg9lstk+nsRcHYBN2u91Afs7Ji+vVQOxh6R6U3cawCwDCv5ic2AXAZRcDLciFN1RMuEWRvkzg90CmMAOdZ3rnmKSMKpXpc9C3h1UrIwH71OpAUt6I3Ixk8BLySoxZjKc7Ukoz1Wr1VeR6oNE+vTx55hYyBZ6kUql8i1wPNFxeHSuTBxqv3W7/KLmeIAhKItcDDVfgAvvXVyaLhLM6QKhDSSUnExr+ruiX4yLNhsKEEzujHf+RtV4lhUiYS9xe13Iizh04OaIOfj5QxzCxrRKxXq+XlIkeBMattjIIaBisjuwtzcNChEaGw+GZyLVA4unuBqxAiCo7eB6XSm4GXzmHIl8Cw7xJH5UyDQIviswMLwzRL8GLZjKZvKC5J/IF6IsTznQrWj094ZWpTMxgkndUqeRMJpwOJrRMkQ20puRZG6waE9tq92w8AKfJCcSpAPhhKe/PCdrIOWI/OaEBJv2KvQBJSo/3PZw6fZaLS3dojK1UwHY7TjpiGyXPPxvNZvOuVqs9sbDNPo4l9Tu2gFzuFz22Tz8FJafjAAAAAElFTkSuQmCC"></button>
</form>
	<div class="grid-container">
		<div class="grid-item" id="food_set_prediction"></div>
		<div class="grid-item" id="prediction"></div>
	</div>
	<div id="food_suggestions">
		<? include_once('a_diary_suggest_meals.php'); ?>
	</div>
	<div id="barcode_edits"></div>
<? } ?>