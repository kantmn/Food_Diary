<?
include_once('../func/php_header.php');
include_once('../func/php.php');

if( $user_cnt == 1 ){
?>

<!DOCTYPE html>
<html>
	<head>
		<script type='text/javascript'>
			var favIcon = "\ iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAAZdEVYdFNvZnR3YXJlAHBhaW50Lm5ldCA0LjAuMjHxIGmVAAAHNUlEQVRYR7VXCVBV5xk9j/fYHstjh0Ao8h4CIsgOCaiAIAQaFCKBGKJRRNyNKHGrCw5VUTuxzcLUKLjgYKzWJEQxo47VaN0wiZPgwlBkEYhYFRtaHSK+0/++BwiBdHkmZ+bMvfdfvnP+5fvvvTAUJnKkOVqiRty660sGwdpYiRPi+qL+EY6Ccv3tsyMgYhgep4/DD+LeWl/UByvBNAdfXAmcik51Ah6J53BHP9zXJKNc1+JnwPDcTNy7dhJUKLCgp0yCn0csmiIXgNFLwdhCPd2jcdg1HHei34bW0g5+op2vYIyuh6EwUWChZOC1CbgpHs2kMjNLxITPhbZXuJchufinqFaFzMSXbhH4q8dY/KCOh1blgXSpn6GwXZePx3VnwImJaHVzwc7hyaiRBKXRB00DR0+zZJHjKo5Mlz8Q7eU+E3HI3hdVNp7Y75UMCiPV+lAGIicLdWwGJdacAEckgKOywRhVFM9En2GefCYZR6ZZp9zwTsWnriEyaT+4uIbiqksQ6OiPLn0kA5GXLW/sNSBxdgYoMwJFFcsUZdyMzaSoyjSexGUmBaxHPQMQEKJ0xFJh4G8iS6brIxkG0xULLLr6G1iapxefhElcgRU8hmOcj/lsD2jn2YCzrEAFVVC9ou/+7Ajdv825T1xiVCjoAHt2oYsf4SNqoWUhCnWz8LXT19xlvoubAjZ1ir4/Tt3/H/a2pus7aocPMPByHKhRuOmE92APi5XFTDZKZic6+Q7e4VVcZZ2qTpqleH0Uw2G7aJbmLts8BxhY/5YRTeXYuw/7LsYj/kl3bDc/T/mcuchlMYp1S3IERyQDofowhkGmUavK26+nkC0qnXDzRTArFRzmJpOCNwhe8od/gzT1J21Osk4ky/t4n1WooglM3tJFMRAyOzvzTacPJ5F3EvtG/vZscIwwMHedFbfsSODv3ltAucyIW7BFm4lMlpqXsj61ngUoeCJiSCehQXBWe9p8fKZqAnnvTbLVXSfe3QD6+YEVX4F/qgEvtGTz7sPzHPtrpTQb5adwipWoJJ1I6T4DGQdEuUwX8X+EUqEwWjL9dd+O9toc8v4csl2cLj2jv1AJJk3Wi0v8rNaNXzQls2ibj2SgqhrVLEMZb+AG12ANS1xLtPnq/E9EnUIX/T/AwURhtDJjouZ29V+yyY4CwcXk39OFsLzPQOFicNOBpwZ6uXqHKX81Gp0j0mQMDFPw6BtgsTgpK7OceMH9AzrDOaJHZxC8bFQmJXNygv917dJs8h8ijx+sEfyNbt2/OW7EJ016cYnjRertuzJQ/IPjYKQ4lEa+Cvpnif0xHdSKd0TNPNFHXDtXyrgkGjN69Pqgft7Vds/a5eO679xcKYQ3POX9eZRSruEcGOgOHq/Qi589JM7+KHDvlwMNvL4WDJ0l2r4Jholr5Bzw8RphQpRLBiTWL8Q9b0s4SMLGSqXJ6uWL4x91NK/tJ/xbsdmmUdvmK4RlPFIG5onpnOJjzNKXzLh7kYIvx4O5q8H93z4V//iaNZPyzRk2w5hhYuQhM8B4kSXSDPSK97I8HUXw1ZgeqT41Vy/6YBV59w3ydgR5y4pHS2TcNtacn4605vVIB45zM+O5F5/j+UAVb4bbcp3GnKs+HDh6idtPOLKqMpOv5YqZEEuxfupgcYnncvEVwtXyh92tgeJQcRDTKutb29PlMn4hhBqjnFgZYMM/hrnwVRcz7vC1Zk2oDZti3NkU58GiZNMBM9DLw6Wu3DIXjJsCdiwfLC6xOg/tcLXFbuld3ivcy51JZmwc48rm5BFsHu/Fhgg7NohR6xhpz9bJ0WydGsfqUHtu2D3YwCclYJv4MDkt9sBQ4hIvzUSbtAeU5qbYsCgXD1sugd9fB78Vu/gzfxWbX/LRCbVkRAgzbk8NCDYnDteZk4xtnGM8yMBBsTRDifbn2RxclAz0wl0uw0a5HFvFMbXjSpg9b6UF87tZqWybliBmQTPAQH9unWw6yEDp3qFF+/NQFrb2aA+EMRB4WRhoeSWUtxdm8LvcZDYneQ8pLnHZeBNuPw3uugB+eAp896h4P/wBbMofWlji9yuhTfdFSI/kIKgO+Km6b00YxbYZSWydEsumePWQ4hJHWchblJbo9hbfeT7BoK2T7suodXMiLt9dNlj8nig7mIkKvdRPYKOnxfmmBI1Y/3CxFEFsHP3ckOLVQSqaK/CC6GInOFowUdBb0MjLDtbvpuDE6hhxWE0C/yxOxZ1p0Irn/aJeKfjTiLYyzql9wZFNCWpduv04CxqjnXX3v1cr60RzI32vISHLDkRs6UQUbk9FUZKm71ftv8Jk8zBlbUOE/UBxwaY4d5EhXqwNs2WstWJeT/ufH55mijHH/K0f9xeX2Jo5iq1ZQdyqtpD+ikz1rX8hJKgUSy4H2/SJN0Y58vb8aB5M8X0UbC5P7Wn2yyJepchf72H+zXtqi67iETY3xzxvVSCKnfW1zwLg34Rv7aV2bDKqAAAAAElFTkSuQmCC";
		</script>
		<? include_once('../func/html_header.php'); ?>
		<script type='text/javascript'>
			<? include_once('../func/jquery.php'); ?>
			<? include_once('../func/js_quagga_min.php'); ?>
			<? include_once('j_quagga.php'); ?>
			<? include_once('j_scripts.php'); ?>
			<? //https://github.com/serratus/quaggaJS ?>
			<? //include_once('../func/webrt_adapter_2019.05.30.php'); ?>
		</script>
		<style type="text/css">
			<? include_once('../func/css_normalize.php')?>
			<? include_once('../func/css.php')?>
			<? include_once('../func/css_quagga.php')?>
		</style>
	</head>
	<body>
		<div id="tabs_header">
			<div class="navigation" id="menu">Menu </div>
			<div class="navigation" id="tabs_activate_insert"> <? echo $language_row['menu_diary']; ?></div>
			<div class="navigation" id="tabs_activate_evaluation"> <? echo $language_row['menu_statistics']; ?></div>
			<div class="navigation" id="tabs_activate_statistic"> <? echo $language_row['menu_history']; ?></div>
			<div class="navigation" id="account">
			<? echo $user_row['name']; ?></div>
		</div>
		<div id="overlay_navigation" class="overlay">
			<ul>
				<li><a class="navigation" id="tabs_activate_daily_chart"><? echo $language_row['menu_charts']; ?> <? echo $language_row['menu_daily']; ?></a></li>
				<li><a href="p_chart_avg.php?x=1&d=60">24h <? echo $language_row['menu_charts']; ?></a></li>
				<li><a href="p_chart_avg.php?x=2&d=180">48h <? echo $language_row['menu_charts']; ?></a></li>
				<li><a href="p_chart_avg.php?x=3&d=365">72h <? echo $language_row['menu_charts']; ?></a></li>
			</ul>
		</div>
		<div id="overlay_account" class="overlay">
			<ul>
				<li><? echo $language_row['acc_details']; ?></li>
				<li><? echo $language_row['acc_settings']; ?>
					<?
					$q = 'SELECT user_languages.* FROM user_languages WHERE user_languages.language = "'.$language.'"';
					$arr = sql($q);
					$row = $arr->fetch_assoc();
					?>
					<ul>
						<li><img src="<? echo $row['language_flag']; ?>" style="vertical-align:middle" > 
							<select id="user_language" name="user_language">
							<?
							$q = 'SELECT * FROM user_languages ORDER BY language_name';
							$arr = sql($q);
							while ( $row = $arr->fetch_assoc() ) {
								echo '<option value="'.$row['language'].'"';
								if( $row['language'] == $language ) echo " selected";
								echo '> '.$row['language_name'].'</option>';
							}
							?>
							</select>
						</li>
					</ul>
				</li>
				<?
				// find out the domain:
				$domain = $_SERVER['HTTP_HOST'];

				// find out the QueryString:
				$queryString = $_SERVER['REQUEST_URI'];

				// put it all together:
				$url = "//" . $domain . $queryString;

				// filter invalid chars from domain
				$url = filter_var($url, FILTER_SANITIZE_URL);
				?>
				<li><? echo "<a href='//login.".$_SERVER['SERVER_NAME'].".net/acc_logout.php?redirect=".$url."'>".$language_row['acc_logout']."</a><br>"; ?></li>
			</ul>
		</div>
		<div class="center">
			<div id="sql_feedback"></div>
			<div id="tab_insert"></div>
			<div id="tab_evaluation"></div>
			<div id="tab_statistic"></div>
			<div id="tab_daily_chart"></div>
			<div id="loading">
				<div class="cssload-loader">
					<div class="cssload-inner cssload-one"></div>
					<div class="cssload-inner cssload-two"></div>
					<div class="cssload-inner cssload-three"></div>
				</div>
			</div>
		</div>
		<div id="quagga_window" style="display: none">
			<div id="interactive" class="viewport"></div>
		   <div class="controls">
				<fieldset class="reader-config-group">
					<label>
						<span>Barcode-Type</span>
						<select name="decoder_readers">
							<option value="code_128">Code 128</option>
							<option value="code_39">Code 39</option>
							<option value="code_39_vin">Code 39 VIN</option>
							<option value="ean" selected="selected">EAN</option>
							<option value="ean_extended">EAN-extended</option>
							<option value="ean_8">EAN-8</option>
							<option value="upc">UPC</option>
							<option value="upc_e">UPC-E</option>
							<option value="codabar">Codabar</option>
							<option value="i2of5">Interleaved 2 of 5</option>
							<option value="2of5">Standard 2 of 5</option>
							<option value="code_93">Code 93</option>
						</select>
					</label>
					<label>
						<span>Resolution (width)</span>
						<select name="input-stream_constraints">
							<option value="320x240">320px</option>
							<option selected="selected" value="640x480">640px</option>
							<option value="800x600">800px</option>
							<option value="1280x720">1280px</option>
							<option value="1600x960">1600px</option>
							<option value="1920x1080">1920px</option>
						</select>
					</label>
					<label>
						<span>Patch-Size</span>
						<select name="locator_patch-size">
							<option value="x-small">x-small</option>
							<option value="small">small</option>
							<option selected="selected" value="medium">medium</option>
							<option value="large">large</option>
							<option value="x-large">x-large</option>
						</select>
					</label>
					<label>
						<span>Half-Sample</span>
						<input type="checkbox" checked="checked" name="locator_half-sample" />
					</label>
					<label>
						<span>Workers</span>
						<select name="numOfWorkers">
							<option value="0">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option selected="selected" value="4">4</option>
							<option value="8">8</option>
						</select>
					</label>

					<label style="display: none">
						<span>Zoom</span>
						<select name="settings_zoom"></select>
					</label>
					<label style="display: none">
						<span>Torch</span>
						<input type="checkbox" name="settings_torch" />
					</label>
				</fieldset>
			</div>
		</div>
	</body>
		<script>
			<? include_once('../func/js_pulltorefresh_min.php'); ?>
		</script>
		<script>
			/* global PullToRefresh https://github.com/BoxFactura/pulltorefresh.js */
			/*
			API

				init(options) Will return a unique ptr-instance with a destroy() method.
				destroyAll() Stop and remove all registered ptr-instances.
				setPassiveMode(isPassive) Enable or disable passive mode for event handlers (new instances only).

			Options

				distThreshold (integer) Minimum distance required to trigger the refresh.
				— Defaults to 60
				distMax (integer) Maximum distance possible for the element.
				— Defaults to 80
				distReload (integer) After the distThreshold is reached and released, the element will have this height.
				— Defaults to 50
				distIgnore (integer) After which distance should we start pulling?
				— Defaults to 0
				mainElement (string) Before which element the pull to refresh elements will be?
				— Defaults to body
				triggerElement (string) Which element should trigger the pull to refresh?
				— Defaults to body
				ptrElement (string) Which class will the main element have?
				— Defaults to .ptr
				classPrefix (string) Which class prefix for the elements?
				— Defaults to ptr--
				cssProp (string) Which property will be usedto calculate the element's proportions?
				— Defaults to min-height
				iconArrow (string) The icon for both instructionsPullToRefresh and instructionsReleaseToRefresh
				— Defaults to &#8675;
				iconRefreshing (string) The icon when the refresh is in progress.
				— Defaults to &hellip;
				instructionsPullToRefresh (string) The initial instructions string.
				— Defaults to Pull down to refresh
				instructionsReleaseToRefresh (string) The instructions string when the distThreshold has been reached.
				— Defaults to Release to refresh
				instructionsRefreshing (string) The refreshing text.
				— Defaults to Refreshing
				refreshTimeout (integer) The delay, in milliseconds before the onRefresh is triggered.
				— Defaults to 500
				getMarkup (function) It returns the default HTML for the widget, __PREFIX__ is replaced.
				— See src/lib/markup.js
				getStyles (function) It returns the default CSS for the widget, __PREFIX__ is replaced.
				— See src/lib/styles.js
				onInit (function) The initialize function.
				onRefresh (function) What will the pull to refresh trigger? You can return a promise.
				— Defaults to window.location.reload()
				resistanceFunction (function) The resistance function, accepts one parameter, must return a number, capping at 1.
				— Defaults to t => Math.min(1, t / 2.5)
				shouldPullToRefresh (function) Which condition should be met for pullToRefresh to trigger?
				— Defaults to !window.scrollY
			*/
			PullToRefresh.init({
				mainElement: '#sql_feedback',
				distIgnore: 150,
				distThreshold: 60,
				onRefresh: function() {
					$('#loading').show();
					$('[id^=tab_]').hide();
					$('#'+ $('.tab_active').prop('id') ).trigger('click');
				}
			});
		</script>
	<footer>
	<? include_once('../func/php_footer.php'); ?>
	</footer>
</html>
<? mysqli_close($db); ?>
<?
}else{
	include_once($login_redirect);
}
?>