<?php
include_once('php_header.php');
	// function to download from $source and extract to $folder
	function extractZIP( $source, $tmp_zip ){
		if( downloadDistantFile($source, $tmp_zip) === FALSE){
			echo "<span class'progress'>Download failed ".$source."</span>";
		}else{
			echo "<span class='progress'>Downloaded</span>";
			
			$zip = new ZipArchive;
			if( $zip->open( $tmp_zip ) === TRUE ){
				global $ziproot;
				$ziproot = $zip->getNameIndex(0);
				
				echo "<span class='progress'>Zip accessed</span>";
				if( $zip->extractTo( $_SERVER['DOCUMENT_ROOT']) ){
					echo "<span class='progress'>Extracted</span>";
					
					if( unlink( $tmp_zip ) === TRUE ){
						echo "<span class='progress'>Update completed</span>";
					}else{
						echo "<span class='progress'>Zip failed to delete ".$tmp_zip."</span>";
					}
				}else{
					echo "<span class='progress'>Extraction failed with ".$tmp_zip."</span>";
				}
				$zip->close();
			} else {
				echo "<span class='progress'>Zip access for ".$tmp_zip." denied</span>";
			}
		}
	}
	// finds ip location based on geoplugin.net
	// https://stackoverflow.com/questions/12553160/getting-visitors-country-from-their-ip
	function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
		$output = NULL;
		if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
			$ip = $_SERVER["REMOTE_ADDR"];
			if ($deep_detect) {
				if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
					$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
				if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
					$ip = $_SERVER['HTTP_CLIENT_IP'];
			}
		}
		$purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
		$support    = array("country", "countrycode", "state", "region", "city", "location", "address");
		$continents = array(
			"AF" => "Africa",
			"AN" => "Antarctica",
			"AS" => "Asia",
			"EU" => "Europe",
			"OC" => "Australia (Oceania)",
			"NA" => "North America",
			"SA" => "South America"
		);
		if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
			$ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
			if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
				switch ($purpose) {
					case "location":
						$output = array(
							"city"           => @$ipdat->geoplugin_city,
							"state"          => @$ipdat->geoplugin_regionName,
							"country"        => @$ipdat->geoplugin_countryName,
							"country_code"   => @$ipdat->geoplugin_countryCode,
							"continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
							"continent_code" => @$ipdat->geoplugin_continentCode
						);
						break;
					case "address":
						$address = array($ipdat->geoplugin_countryName);
						if (@strlen($ipdat->geoplugin_regionName) >= 1)
							$address[] = $ipdat->geoplugin_regionName;
						if (@strlen($ipdat->geoplugin_city) >= 1)
							$address[] = $ipdat->geoplugin_city;
						$output = implode(", ", array_reverse($address));
						break;
					case "city":
						$output = @$ipdat->geoplugin_city;
						break;
					case "state":
						$output = @$ipdat->geoplugin_regionName;
						break;
					case "region":
						$output = @$ipdat->geoplugin_regionName;
						break;
					case "country":
						$output = @$ipdat->geoplugin_countryName;
						break;
					case "countrycode":
						$output = @$ipdat->geoplugin_countryCode;
						break;
				}
			}
		}
		return $output;
	}
	// printed alle keys und values von jeder ebene und darüber
	function print_array_recursive($arrResult, $where=""){
		while(list($key,$value)=each($arrResult)){
			if (is_array($value)){
				print_array_recursive($value, $where."[$key]");
			}else {
				for ($i=0; $i<count($value);$i++){
					echo $where."[$key]=".$value."<BR>\n";
				}
			}
		}
	}
  /**
	  * Download a large distant file to a local destination.
   *
   * This method is very memory efficient :-)
   * The file can be huge, PHP doesn't load it in memory.
   *
   * /!\ Warning, the return value is always true, you must use === to test the response type too.
   *
   * @author dalexandre
   * @param string $url
   *    The file to download
   * @param ressource $dest
   *    The local file path or ressource (file handler)
   * @return boolean true or the error message
   */
function downloadDistantFile($url, $dest){
    $options = array(
      CURLOPT_FILE => is_resource($dest) ? $dest : fopen($dest, 'w'),
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_URL => $url,
      CURLOPT_FAILONERROR => true, // HTTP code > 400 will throw curl error
    );

    $ch = curl_init();
    curl_setopt_array($ch, $options);
    $return = curl_exec($ch);

    if ($return === false)
    {
      return curl_error($ch);
    }
    else
    {
      return true;
    }
}
// Function to remove folders and files
function rrmdir($dir) {
	if (is_dir($dir)) {
		$files = scandir($dir);
		foreach ($files as $file)
			if ($file != "." && $file != "..") rrmdir("$dir/$file");
		$result = rmdir($dir);
		
		//shorthand (QUESTIONS ? TRUE: FALSE);
		//echo 'Tmp Directory '.$dir.' '.($result ? "was deleted" : "could not be deleted")."<br>";
	}
	else if (file_exists($dir)){
		$result = unlink($dir);
		//echo $dir.' is not a Dir. File '.($result ? "was deleted" : "could not be deleted")."<br>";
	}
}
// Function to Copy folders and files
function rcopy($src, $dst) {
	if (is_dir ( $src )) {
		mkdir ( $dst );
		$files = scandir ( $src );
		foreach ( $files as $file )
			if ($file != "." && $file != ".."){
				$result = rcopy ( "$src/$file", "$dst/$file" );
				//echo $result.':'.$src.' -> '.$dst."<br>";
			}
	} else if (file_exists ( $src )){
		$result = copy ( $src, $dst );
		//echo $result.':'.$src.' -> '.$dst."<br>";
	}
}
function rate_latest_ingredients($active_user, $date, $type, $meal){
	$result = 0;
	$splitted_ingredient_ids = NULL;
	for ($i=1; $i<4; $i++){
		// generates 3 queries which get the corresponding meals and feelings for the last 24, 48 and 72 hours
		${"q$i"} = 'SELECT * FROM food_diary WHERE ReportedFor > SUBDATE("'.$date.' 00:00:01", INTERVAL ('.$i.'+1) day) AND user_id = '.$active_user.' ORDER by id ASC';
		${"s$i"} = sql(${"q$i"});
		${"r$i"} = ${"s$i"}->fetch_assoc();
		${"c$i"} = ${"s$i"}->num_rows;
		
		// find oldest meal in this query and break out
		while( ${"r$i"} = ${"s$i"}->fetch_assoc() ){
				if( ${"r$i"}['type'] == $type && ${"r$i"}['meal'] == $meal){
					${"splitted_ingredient_ids$i"} = preg_split('/\s+/', ${"r$i"}['foods']);
					
					if( empty(${"r$i"}['foods']) ){
						$splitted_ingredient_ids .= "0 ";
					}else{
						$splitted_ingredient_ids .= ${"r$i"}['foods']." ";
					}
					break;
				}
		}
		// calculate total feeling rating for each period,
		mysqli_data_seek(${"s$i"}, 0);
		while( ${"r$i"} = ${"s$i"}->fetch_assoc() ){
			${"rating$i"} += ${"r$i"}['feeling'];
		}
		// calculate average feeling rating for each period
		if( ${"c$i"} == 0 ){
			${"rating$i"} = 0;
		}else{
			${"rating$i"} = ${"rating$i"} / ${"c$i"};
		}
		${"rating$i"} = round(${"rating$i"}, 2);
		${"rating$i"} = number_format(${"rating$i"}, 2);
	}
	if( !empty( $splitted_ingredient_ids ) ){
		// converts the spaced string to array and removes last space
		$splitted_ingredient_ids = preg_split('/\s+/', substr($splitted_ingredient_ids, 0, -1) );
		
		// removes duplicate foods, as they all get the same rating anyway
		$splitted_ingredient_ids = array_unique($splitted_ingredient_ids);
		
		// runs through each array entry to generate values for SQL
		foreach($splitted_ingredient_ids as $id){
			$values .= '('.$id.', '.$active_user.', '.$rating1.', '.$rating2.', '.$rating3.', 1), ';
		}
		// removes last two chars ", " so we can add ";"
		$values = substr($values, 0, -2);
		
		// checks if already in db, then only update rating, else insert food with rating
		$update_ratings = '
			INSERT INTO food_intolerances (id_food, id_user, rating1, rating2, rating3, rate_count) 
			VALUES '.$values.'
			ON DUPLICATE KEY UPDATE
			rating1=((rating1*rate_count)+VALUES(rating1))/(rate_count+1),
			rating2=((rating2*rate_count)+VALUES(rating2))/(rate_count+1),
			rating3=((rating3*rate_count)+VALUES(rating3))/(rate_count+1),
			rate_count=(rate_count+1)
			';
		$result = sql($update_ratings);
	}
	return $result;
}
function transform_ids_2_strings($id_list){
	if( strlen($id_list) > 1 ){
		$ingredients = array();

		// seperates words into array
		$ingredient_ids = explode(' ', $id_list);
		
		// remove whitespaces in all array elements
		$ingredient_ids = array_map('trim',$ingredient_ids);
		
		// remove empty array rows
		$ingredient_ids = array_filter($ingredient_ids);
		
		// go through each ingredient to find its name
		$q = 'SELECT name FROM food_ingredients WHERE id IN (' . implode(',', $ingredient_ids) . ')';
		$ingredient_arr = sql($q);	
		while( $row = $ingredient_arr->fetch_assoc() ) {
			array_push($ingredients, $row['name']);
		}
		
		// sorts array alphabetically
		asort($ingredients);
		
		// converts array to string and seperates with spaces
		$string = implode(" ",$ingredients);
	}
	return $string;
}
function print_and_edit_details_from_barcode( $barcode ){
	// docu api https://en.wiki.openfoodfacts.org/API/Read/Product
	$barcode = preg_replace('/[^0-9a-zA-Z]+/', '', $barcode);

	// test auf empty/null und ob alles zahlen sind
	if( isset ($barcode) && ctype_digit($barcode) ){
		$q = 'SELECT * FROM `food_sets` WHERE barcode = "'.secure_sql($barcode).'"';
		$arr = sql($q);
		$row = $arr->fetch_assoc();
		
		// if barcode is known, read values from DB
		if( mysqli_num_rows($arr) > 0){
			// update barcode table, so last_used date is up2date and a_diary_suggest_meals is displaying also udpated and not only new meals/barcodes
			$q_update = 'UPDATE food_sets SET last_used = now() WHERE barcode = "'.secure_sql($barcode).'"';
			$update_result = sql($q_update);
			
			$q = 'SELECT * FROM `food_sets` WHERE barcode = "'.secure_sql($barcode).'"';
			$arr = sql($q);
			$row = $arr->fetch_assoc();
			
			$food_set_found_in_db = true;
			$fsid = $row['id'];
			$fsfirma = $row['firma'];
			$fsname = $row['name'];
			$fsingredients = $row['ingredients'];
		}else{
			$url = "https://world.openfoodfacts.org/api/v0/product/".secure_sql($barcode).".json";
			$json = file_get_contents($url);
			$json_data = json_decode($json);

			// test ob produkt gefunden wurde und teste ob deutsche zutatenliste vorhanden ist
			if( $json_data->status == 1  && isset($json_data->product->ingredients_text_de) ){
				$ingredients = $json_data->product->ingredients_text_de; 
				$product_name = $json_data->product->product_name_de; 
				$brands = $json_data->product->brands; 
				
				preg_match_all("/([A-Za-z\p{L}]{2,}\s[a-zA-Z]{1}\s?[0-9]{1,4}[a-zA-Z]?)|([A-Za-z\-\p{L}]{2,}\s?)+/u", $ingredients, $ingredients);
			
				// removes json multi dim array and flattens it to 1D
				$flatten_arr = array();
				array_walk_recursive($ingredients, function($a) use (&$flatten_arr) { $flatten_arr[] = $a; });
				$ingredients = $flatten_arr;
				
				// removs dublicates and empties
				$ingredients = array_unique($ingredients);
				$ingredients = array_filter($ingredients);
				
				// removes blank spaces
				$ingredients = str_replace(" ","",$ingredients);

				// array to string conversion
				$ingredients = implode(" ", $ingredients);
				
				// upper letter each word
				$ingredients = ucwords($ingredients);
				
				//remove spaces and commas from companys
				$brands = str_replace(",","-",$brands);
				$brands = str_replace(" ","-",$brands);
				
				$fsfirma = $brands;
				$fsname = $product_name;
				$fsingredients = $ingredients;
			}else{
				$fsfirma = null;
				$fsname = null;
				$fsingredients = null;
			}
			$food_set_found_in_db = false;
			$fsid = $barcode;
		}
		echo '
		<form id="form_post_'.$fsid.'" name="form_post_'.$fsid.'" method="post" action="">
			<input type="hidden" id="food_set_id_'.$fsid.'" name="food_set_id" value="'.$fsid.'"/>
			<input type="text" id="food_set_firma_'.$fsid.'" name="food_set_firma" autocomplete="off" size="18" value="'.$fsfirma.'"/>
			<input type="text" id="food_set_name_'.$fsid.'" name="food_set_name" autocomplete="off" size="18" value="'.$fsname.'"/><button id="'.$fsid.'" name="clear_'.$fsid.'" class="clear_food_set button_red"><img width="18px" height="18px" src=" data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABIAAAASCAYAAABWzo5XAAAABGdBTUEAALGPC/xhBQAAAAlwSFlzAAAOwgAADsIBFShKgAAAABh0RVh0U29mdHdhcmUAcGFpbnQubmV0IDQuMS42/U4J6AAAAz5JREFUOE+Fk39IlHccxy0Zuz9i4KDRP4Vg/w1GjRaLYjHMasFgBbowmlPcqG1ILRb0cytrYFladO3CRJnesbzcMpX5A1falk7DLu/xfvTc89zz2+d2P8y787of5nvfx3tQ8gRf8Obh+zzP6/3l8/B9spbhzcrKyt0Gg2FdYWHhOrLOTt9enncK9h+qqDhnajtzpVm8cLV+trfvIe5Yf0eTtQtVpo7ksYsW1ycl1Y2r1ny4XXdeZ/17WzaeuHY3bO5yoGOARndfP0RJgaqqiEajGLNTeOoQYKNVDDtk1P5mm30rt2Cnri+weW/p0ZvdHli6xtHSOYT+gUeQFQUM6wXLshBlBQN/D+KJQ0T7Ywnll3msfverw7q+wObdhWWnHqo42TWB820cbv7JoOmBhLpOBqYOEdVWBd/WMij4nsaGUhYFR1h8kF9yQNcXyM7Ozuf9YbQ7wrjc50eFRUaxUcBnVTz2nOPw6RkWBy5w+MEoor5dxhAlY+3a3MzRCOudTjdSM68wQzIdi5FxZNAMi6HhEVDkGSsGQAtBUIwP/1I8iLMprb6Ooae3bzaenEGCJJnSrikEQyGwvAyv6IOgvpgv+muI0ory0uoiWu62+qdfJhGLp+AbGQFvbkQ8kcLkVAzUpZ/hGn42X3S/d1ArWp02F9HQ2GQLRxOIxBKYCk3BeewbeOp+gau2GmOnj4OXQ/NFlj96tCJD2lxEzXVj52T4JaYicUSmEwj6J2EvLYLtyyJIkn9utOd8YK6o3nwvqWuZnP2p8lbgRQxBPUxrK2zlxRgt+xxOczP52CqcjASKlmFqaAnpWiblX393Wv4vAjUYBUu5MFpSBMHtAT1GwVa2Hy5yIGlOhv25gBt1Zl7XMtmxa89BrYjhJ6Cofkxo8QWg+oLw0F54vBKcNA+HR0KNscGua5nk5ORs45RJCLIfqj8EUfGBE2QIklYcIEdgAuNuBrZxD6pqTI90bUnetrb1RN2sAprszkk+uGgObkYgZSq8gjK3tlE0ir8o+1F3liYvL+/98xcvdfxqscb7/xmB3cVhnIzSP/gUzXfuRa4Zb7dv/ejjfeTVFWljed4g0U6u9htoySVZSbIEWVn/A5r+bPZMr+ElAAAAAElFTkSuQmCC"></button>
			<input type="text" id="food_set_ingredients_'.$fsid.'" name="food_set_ingredients" autocomplete="off" size="18" value="'.$fsingredients.'"/>';
			
			echo '<button id="'.$fsid.'" name="'.$fsid.'" ';
			if($food_set_found_in_db){
				echo '
				 class="update_food_set button_green"><img width="18px" height="18px" src=" data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAAZdEVYdFNvZnR3YXJlAHBhaW50Lm5ldCA0LjAuMjHxIGmVAAACH0lEQVRYR+2XzUoDMRSF+zTzLD5UVVxotS7UhUtxKUJ1rYhU3enWrZROmbaLofSP/lIYz5nclhmaTJNSwUI/CEmTc2/uZG6SaW7HVhFFkYeSH4/HhUajce/7/jML2+zjGDUij/XT6fQEY6fJfmdoPBgMzvv9fgvtTHq9Xms0GhXR9MIwvFW9UdTpdD5RuQVBg9lstk+nsRcHYBN2u91Afs7Ji+vVQOxh6R6U3cawCwDCv5ic2AXAZRcDLciFN1RMuEWRvkzg90CmMAOdZ3rnmKSMKpXpc9C3h1UrIwH71OpAUt6I3Ixk8BLySoxZjKc7Ukoz1Wr1VeR6oNE+vTx55hYyBZ6kUql8i1wPNFxeHSuTBxqv3W7/KLmeIAhKItcDDVfgAvvXVyaLhLM6QKhDSSUnExr+ruiX4yLNhsKEEzujHf+RtV4lhUiYS9xe13Iizh04OaIOfj5QxzCxrRKxXq+XlIkeBMattjIIaBisjuwtzcNChEaGw+GZyLVA4unuBqxAiCo7eB6XSm4GXzmHIl8Cw7xJH5UyDQIviswMLwzRL8GLZjKZvKC5J/IF6IsTznQrWj094ZWpTMxgkndUqeRMJpwOJrRMkQ20puRZG6waE9tq92w8AKfJCcSpAPhhKe/PCdrIOWI/OaEBJv2KvQBJSo/3PZw6fZaLS3dojK1UwHY7TjpiGyXPPxvNZvOuVqs9sbDNPo4l9Tu2gFzuFz22Tz8FJafjAAAAAElFTkSuQmCC"></button>
				';
			}else{
				echo '
				class="insert_food_set button_blue"><img width="18px" height="18px" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAAZdEVYdFNvZnR3YXJlAHBhaW50Lm5ldCA0LjAuMjHxIGmVAAABiUlEQVRYR+2VP0vDQByGS0fxKyhuLu5CQXAScRMKIg5uKn4FRxH/LIogjn4IVx0FRz+AOBbqFGyaNDWJPpe+NrVGbWMOHPLAEbjf3fu+d0nuKiV5CIJgLo7j68HmeV5NZft0Op3VtyEcx1lX2T5lgDJAGYAAdfn2abVaGyoXB6vaxswfbq8g3z6mL2tsu93el9z4oFvtdrtXPYvxCcPwlseE5PJhBBC6SRTHgDkPzWZzUjJ/wwgheC/tX4mi6Im7YVrTiwHBKYQf5fETDu9+VtOKxff9GUI0ZPQFai5BFzTcDnyUNYxe5NmHKznkml7TMLuwE4uE8ORtzGP6dlTOh+u6S4gcfzS2ck+lTPgoNwkRmQA8TtWdCefJ1qA2Z0NdpRQKR8lyBAbPKn0Lc3bZ9kuGV9WVCYZ3PdUeLPZCpZQ8AUYlI8C5SillgH8XwPzXtEZBLZBswkgBbJIZgOv8QHXrEOBMtim8p3m2KtQYa5jDi8WuyPYzJgQHyyHPExvNvGbMl2VXApXKOwyGVRmw+1ZqAAAAAElFTkSuQmCC"></button>
				';
			}
			echo '
			<br><br>
		</form>';
	}
}
function transform_barcode_2_strings( $barcode ){
	// docu api https://en.wiki.openfoodfacts.org/API/Read/Product
	$barcode = preg_replace('/[^0-9a-zA-Z]+/', '', $barcode);

	// test auf empty/null und ob alles zahlen sind
	if( isset ($barcode) && ctype_digit($barcode) ){
		$q = 'SELECT barcode, ingredients FROM `food_sets` WHERE barcode = "'.$barcode.'"';
		$arr = sql($q);
		$row = $arr->fetch_assoc();
		// if barcode is known, read values from DB
		if( mysqli_num_rows($arr) > 0){
			echo $row['ingredients'];
		}else{
			// else retrieve from openfoodfacts and insert to own database
			$url = "https://world.openfoodfacts.org/api/v0/product/".secure_sql($barcode).".json";
			$json = file_get_contents($url);
			$json_data = json_decode($json);

			// test ob produkt gefunden wurde
			if( $json_data->status == 1 ){
				// teste ob deutsche zutatenliste vorhanden ist
				if( isset($json_data->product->ingredients_text_de) ){
					$ingredients = $json_data->product->ingredients_text_de; 
					$product_name = $json_data->product->product_name_de; 
					$brands = $json_data->product->brands; 
					
					// ersetzt problematische zeichen
					/*
					$ingredients = preg_replace('/[^a-zA-Z\p{L}\d]+~]|\s|\-|((Z|z)utaten)/', '', $ingredients);
					$ingredients = preg_replace('/(\,|\:|\()[0-9\,\.\%]+(\)|\%|\,)/', '', $ingredients);
					$ingredients = preg_replace('/[\s[%(){}[\]\_\,\;\.\:]+/', ' ', $ingredients);
					*/
					//$ingredients = implode(' ',array_unique(explode(' ', $ingredients)));
					
					preg_match_all("/([A-Za-z\p{L}]{2,}\s[a-zA-Z]{1}\s?[0-9]{1,4}[a-zA-Z]?)|([A-Za-z\-\p{L}]{2,}\s?)+/u", $ingredients, $ingredients);
				
					// removes json multi dim array and flattens it to 1D
				    $flatten_arr = array();
					array_walk_recursive($ingredients, function($a) use (&$flatten_arr) { $flatten_arr[] = $a; });
					$ingredients = $flatten_arr;
					
					// removs dublicates and empties
					$ingredients = array_unique($ingredients);
					$ingredients = array_filter($ingredients);
					
					// removes blank spaces
					$ingredients = str_replace(" ","",$ingredients);

					// array to string conversion
					$ingredients = implode(" ", $ingredients);
					
					// upper letter each word
					$ingredients = ucwords($ingredients);
					
					//remove spaces and commas from companys
					$brands = str_replace(",","-",$brands);
					$brands = str_replace(" ","-",$brands);

					// SQL $barcode $ingredients
					$q = 'INSERT INTO food_sets (firma, name, ingredients, barcode) VALUES ("'.$brands.'", "'.$product_name.'", "'.$ingredients.'", "'.$barcode.'")';
					$insert_result = sql($q);
					
					echo $ingredients;
				}else{
					//echo "Ingredients_unknown";
				}
			}else{
				// wird nicht angezeigt weil direkt das eingabefeld für ein neues set eingebelndet wird.
				//echo "Product_not_found";
			}
		}
	}else{
		echo "Invalid_Barcode";
	}
}
function transform_strings_2_ids($string){
	if( strlen($string) > 1 ){
		$ingredient_ids = array();
		$string = secure_sql($string);
		$string = explode(' ', $string);
		$string = array_map('trim',$string);
		
		// make sure all ingredients are present in db, if not insert them
		$q = 'INSERT INTO food_ingredients (name) VALUES ("' . implode('"),("', $string) . '") ON DUPLICATE KEY UPDATE last_used = now()';
		$insert_arr = sql($q);
		
		// go through each ingredient to find its number
		$q = 'SELECT id FROM food_ingredients WHERE name IN ("' . implode('","', $string) . '")';
		$ingredient_arr = sql($q);
		while( $row = $ingredient_arr->fetch_assoc() ) {
			array_push($ingredient_ids, $row['id']);
		}
		
		// converts array to string and seperates with spaces
		$string = implode(" ",$ingredient_ids);
		
		return $string;
	}
}
function folderSize ($dir){
	$size = 0;
	foreach (glob(rtrim($dir, '/').'/*', GLOB_NOSORT) as $each) {
		$size += is_file($each) ? filesize($each) : folderSize($each);
	}
	return $size;
}
function trim_string_if_too_long($string, $length){
	$char_limited_foods = (strlen($string) > ($length+3) ) ? substr($string,0,$length).'...' : $string;
	return $char_limited_foods;
}
function human_bytes($size){
	$unit = ['Byte', 'KByte', 'MByte', 'GByte', 'TByte'];
	$counter = 0;
	
	while ($size > 1024){
		$counter++;
		$size/=1024;
	}
	$proz = round($size / 100 * 100,2);
	//return round($size,2).' von 100 '.$unit[$counter].' = '.$proz.'% voll';
	
	return $proz;
}
function sort_words_in_string_alphabetically($string){
	$words = preg_split('/\s+/', $string);
	asort($words);
	$string = '';
	
	foreach( $words as $word ){
		$string .= $word.' ';
	}
	return $string;
}
// check if a server is up by connecting to a port
function check_server( $url, $port) {
	$useragent = $_SERVER['HTTP_USER_AGENT'];
	$options = array(
			CURLOPT_RETURNTRANSFER => true,      // return web page
			CURLOPT_HEADER         => false,     // do not return headers
			CURLOPT_FOLLOWLOCATION => true,      // follow redirects
			CURLOPT_USERAGENT      => $useragent, // who am i
			CURLOPT_AUTOREFERER    => true,       // set referer on redirect
			CURLOPT_CONNECTTIMEOUT => 2,          // timeout on connect (in seconds)
			CURLOPT_TIMEOUT        => 1,          // timeout on response (in seconds)
			CURLOPT_MAXREDIRS      => 10,         // stop after 10 redirects
			CURLOPT_FAILONERROR    => 1,          // fail on error
			CURLOPT_SSL_VERIFYPEER => false,     // SSL verification not required
			CURLOPT_SSL_VERIFYHOST => false,     // SSL verification not required
	);
	$ch = curl_init( $url );
	curl_setopt_array( $ch, $options );
	curl_exec( $ch );

	// get http code respons
	$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	$headercode = curl_getinfo($ch, CURLOPT_HEADER);
	
	// evaluate the results
	return $httpcode;
	//return($url." ".$port);
	
	// close remaining open connection
	curl_close($ch);
}
function get_main_color_of_image2($path){
	if ( strlen($path) > 3 ){
		$i = imagecreatefromjpeg($path);

		for ($x=0;$x<imagesx($i);$x++) {
			for ($y=0;$y<imagesy($i);$y++) {
				$rgb = imagecolorat($i,$x,$y);
				$r   = ($rgb >> 16) & 0xFF;
				$g   = ($rgb >> 8) & 0xFF;
				$b   = $rgb & 0xFF;

				$rTotal += $r;
				$gTotal += $g;
				$bTotal += $b;
				$total++;
			}
		}

		$rAverage = round($rTotal/$total);
		$gAverage = round($gTotal/$total);
		$bAverage = round($bTotal/$total);
		
		$rgb_color = "rgb(".$rAverage.", ".$gAverage.", ".$bAverage.")";
	}else{ $rgb_color = 'transparent'; }
	return $rgb_color;
}
function get_main_color_of_image($path){
	// as pictures alays have at least .jpg the name have to be longer than 4 bytes
	if ( strlen($path) > 4 ){
		$image = new Imagick($path);
		$image->scaleImage(1, 1, true);
		$pixel = $image->getImagePixelColor(0,0)->getColor();

		$rgb_color = "rgb(".$pixel['r'].", ".$pixel['g'].", ".$pixel['b'].")";
	}else{
		// failover if no or invalid image is supplied
		$rgb_color = 'transparent';
	}
	return $rgb_color;
}
function cleaner($input){
	//cleans input/output to prevent sql injection etc
	if (is_array($input)){
 		foreach ($input as $key => $val){
			$output[$key] = clean($val);
		}
	}else{
 		$output = (string) $input;
 
		// if magic quotes is on then use strip slashes
 		if (get_magic_quotes_gpc()) {
 			$output = stripslashes($output);
 		}
		// $output = strip_tags($output);
 		$output = htmlentities($output, ENT_QUOTES, 'UTF-8');
 	}
	// return the clean text
 	return $output;
 }
?>