$(document).ready(function(){
	var activeAjaxConnections = 0;
	var xhr;
	//var i = 0;
	var inactivityTimerInMs = 30000;
	////////////////////////////////// function declaration //////////////////////////
	function food_set_insert(barcode){
		// barcode to ajax to get ingredients and barcode name to add form with update field
		xhr = $.ajax({
			type: 'POST',
			url: 'a_diary_find_barcode_ingredients.php',
			data: {barcode:barcode},
			beforeSend: function(xhr) {
				activeAjaxConnections++;
			},
			error: function(xhr, status, error) {
				alert("Search_BarcodeIngredients: " + status + " " + xhr.responseText);
			},
			success: function(results) { 
				activeAjaxConnections--;
				results = $.trim(results);
				//insert html at end of barcode_edits
				$('#barcode_edits').html( $('#barcode_edits').html()+results);
				//$("[id^=food_set_firma_]").focus();
			}
		});
	}
	// check if it is night mode time
	function toggle_night_mode_design(){
		var nightModeStarts = 170000;	// 15 uhr 21 min 00 second
		var nightModeEnds = 80000;		//8 uhr 00 min 00 second
		
		var currentTime = new Date();
		var TimeNow = "" + currentTime.getHours() + currentTime.getMinutes() + (currentTime.getSeconds() < 10 ? '0' : '') + currentTime.getSeconds();

		if( TimeNow > nightModeStarts ){
			$("body").addClass("night");
			//console.log("Toggled Nach NightmodeStart 1700");
		}else if( TimeNow < nightModeEnds) {
			$("body").addClass("night");
			//console.log("Toggled nach nightModeEnds 800");
		}else{
			$("body").removeClass("night");
			//console.log("in between");
		}
		//console.log("TICK");
	}
	// prints and fade in outs the feedback messages in queue and removes them after timeout
	function print_feedback( html ){
		$('#sql_feedback').append( html );
		$('#sql_feedback').children().last().hide().fadeIn(1500).delay(3000).fadeOut(2000, function(){
			$(this).remove();
		});
	}
	
	// remove last word of set of strings seperated by space
	function remove_last_string(str_text){
		if( str_text != '' ){
			if( str_text.slice(-1) != ' ' ){
				var lastIndex = str_text.lastIndexOf(" ");
				str_text = str_text.substring(0, lastIndex);
				$('#foods').val(str_text);
			}
		}
	}
	// find prediction for autofill
	function fullfill_prediction(val){
		remove_last_string( $('#foods').val() );
		add_val_to_foods(val);
	}
	// just add this str to foods input and add a space
	function add_val_to_foods(val){
		val = val.replace( /\s{2,}/g, ' ' );
		val = val.replace(/\s$/, "");
		
		console.log("'"+val+"'");
		
		var new_str = $('#foods').val();
		if( new_str != '' ){
			if( new_str.slice(-1) == ' ' ){
				new_str = new_str + val + " ";
			}else{
				new_str = new_str + " " + val + " ";
			}
		}else{
			new_str = val + " ";
		}
		$('#foods').val( new_str );
		clear_inputs_n_predictions(true);
	}
	// clears all food inputs and predictions
	function clear_inputs_n_predictions(boolean){
		if(boolean != true){
			$('#foods').val('');
			$('#barcode_edits').empty();
		}
		$('#prediction').empty();
		$('#food_set_prediction').empty();
		$('#foods').focus();
	}
	// reapplies zebra table styleSheets
	function reapply_zebra_table(){
		$('#filter_table tr:visible:even').css('background', '#cecece');
		$('#filter_table tr:visible:odd').css('background', 'white');
	}
	// compares values returns higher value
	function comparer(index) {
		return function(a, b) {
			var valA = getCellValue(a, index), valB = getCellValue(b, index)
			return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.toString().localeCompare(valB)
		}
	}
	function getCellValue(row, index){ return $(row).children('td').eq(index).text() }
	// end of Table sorting function
	// regex to check for values of var, is it number or chars, if number return true
	function isNumber(n) { return /^-?[\d.]+(?:e-?\d+)?$/.test(n); } 
	// infinity scroll find my view position
	function element_in_scroll(elem){
		var docViewTop = $(window).scrollTop();
		var docViewBottom = docViewTop + $(window).height();

		var elemTop = $(elem).offset().top;
		var elemBottom = elemTop + $(elem).height() - ($(window).height() / 2);

		return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
	}
	function resolve_barcode_2_strings(val){
		$('#loading').show();
		if(xhr && xhr.readyState != 4){
			xhr.abort();
		}
		xhr = $.ajax({
			type: 'POST',
			async: true,
			url: 'a_diary_find_barcode.php',
			data: {foods:val},
			error: function(xhr, status, error) {
				if( status != "abort"){
					alert("Barcode_Transformation: " + status + " " + xhr.responseText);
				}
			},
			success: function(results) { 
				add_val_to_foods(results);
				//fullfill_prediction(results+" ");
				//$('#foods').val($('#foods').val()+results+" ");
				//results = $.trim(results);
				$('#loading').hide();
			}
		});
	}
	
	function disable_qr_scanner(automatically = true){
		Quagga.stop();
		$('#form_dropdowns').show();
		$('#food_suggestions').show();
		$('#interactive').empty();
		$('#quagga_off').hide();
		$('#quagga_on').show();
		
		// falls manually = true also übergabe mit true, dann war camera angelassen worden
		if(automatically && $('#quagga_window').is(':visible')){
			$('body').offset().top;
			alert("Camera scan aborted while inactive after "+(inactivityTimerInMs/1000)+"s");
		}else{
			//$("html").animate({ scrollTop: $('body').offset().top }, 1000);
		}
		$('#quagga_window').hide();
		$('#foods').focus();
	}
	//////////////////////////////// on click handlers ///////////////////////////
	// barcode scanner on
	$(document).on("click","#quagga_on",function() {
		event.preventDefault();
		App.init();
		$('#form_dropdowns').hide();
		$('#food_suggestions').hide();
		//$('video').remove();
		$('#quagga_off').show();
		$('#quagga_on').hide();
		$('#quagga_window').show();
		$("html").animate({ scrollTop: $('video').offset().top }, 1000);
		setTimeout(disable_qr_scanner, inactivityTimerInMs); // after 30 sec
	});
	// barcode scanner off
	$(document).on("click","#quagga_off",function() {
		event.preventDefault();
		disable_qr_scanner(false);
	});
	//wait for keyinput in insert, to search for autopredictions
	$(document).on("keyup","#foods",function(e) {
		var keyCode = e.keyCode || e.which; 
		//if last key was space = 32 then check if last word was a number/barcode and resolve it
		if (keyCode == 32){
			// remove last space and split by spaces left
			var res = $('#foods').val().split(" ").slice(0, -1);
			
			if(/^\d+$/.test(res[res.length - 1])){

				// get string before barcode
				var str = $('#foods').val().slice(0, -1);
				str = str.substr(0, str.lastIndexOf(" "));
				
				// set barcode cleaned string into input
				if(str.length > 1){
					str = str + " ";
				}
				
				$('#foods').val(str);
				
				// resolve barcode to strings
				resolve_barcode_2_strings(res[res.length - 1]);
				food_set_insert(res[res.length - 1]);
			}
		}
		
		if (keyCode != 9 && keyCode != 27 && keyCode != 13 && keyCode != 32 && keyCode != 38 && keyCode != 40) {
			$('#loading').show();
			
			// if new xhr is about to start, abort the old one if it is not yet DONE (UNSENT-0, OPENED-1, HEADERS_RECEIVED-2, LOADING-3 and DONE-4)
			// https://stackoverflow.com/questions/4551175/how-to-cancel-abort-jquery-ajax-request
			if(xhr && xhr.readyState != 4){
				xhr.abort();
			}
			xhr = $.ajax({
				type: 'POST',
				async: true,
				url: 'a_diary_input_prediction.php',
				data: $('#form_post').serialize(),
				error: function(xhr, status, error) {
					if( status != "abort"){
						alert("Search_Prediction: " + status + " " + xhr.responseText);
					}
				},
				success: function(results) { 
					results = $.trim(results);
					$('#loading').hide();
					$('#prediction').html(results);
					//$('#prediction_1').css({"backgroundColor":"black","color":"white"});
					$('#prediction_1').css({"color":"blue"});
				}
			});
			xhr = $.ajax({
				type: 'POST',
				async: true,
				url: 'a_diary_input_prediction_food_set.php',
				data: $('#form_post').serialize(),
				error: function(xhr, status, error) {
					if( status != "abort"){
						alert("Search_Food_set_Prediction: " + status + " " + xhr.responseText);
					}
				},
				success: function(results) { 
					results = $.trim(results);
					$('#loading').hide();
					$('#food_set_prediction').html(results);
				}
			});
		}
		// up and down key select for predictions
		if( keyCode == 38 || keyCode == 40 ) {
			var array = $('[id^=prediction_]').map(function() {
				return $(this).text();
			}).get();
			// filtert leere "" array elemente raus
			array.filter(Boolean);
			
			// entfernt das letzte element von hinten splice(index,howmany)
			array.splice(-1,1);
			
			//console.log("Before: "+JSON.stringify(array));
			// down arrow
			if( keyCode == 40 ) {
				//shift = remove first
				//push add last
				array.push( array.shift() );
			}
			// up arrow
			if( keyCode == 38 ){
				//pop = remove last
				array.unshift( array.pop() );
			}
			
			//console.log("After: "+JSON.stringify(array));
			for( var i = 1; i <= array.length ; i++ ){
				$('#prediction_'+i).text(array[i-1]);
			}
		}
	});
	// wenn in foods input field, dann kann tab und enter vervollständigen
	$(document).on("keydown","#foods",function(e) {
		var keyCode = e.keyCode || e.which; 
		if( keyCode == 9 ){ // 9 = tab
			e.preventDefault();
			fullfill_prediction( $('#prediction div:first-child').text() );
		}
		if (keyCode == 27) { // ESC
			event.preventDefault();
			$(this).val('');	
			clear_inputs_n_predictions();
		}
	});
	// fill autocomplete to insert field and clear autoprediction
	$(document).on("click","#prediction div",function() {
		fullfill_prediction( $(this).text() );
	});
	// fill autocomplete to insert field and clear autoprediction for food sets
	$(document).on("click","#food_set_prediction div",function() {
		remove_last_string($('#foods').val());
		resolve_barcode_2_strings( $(this).attr("title") );
		food_set_insert( $(this).attr("title") );
		$('#foods').focus();
	});
	// Function to sort tables automatically alphabetical or numeric, asc or desc, using TH and child tr/td
	$(document).on("click",".sorting_table",function() {
		var table = $(this).parents('table').eq(0)
		var rows = table.find('tr:gt(0)').toArray().sort(comparer($(this).index()))
		this.asc = !this.asc
		if (!this.asc){rows = rows.reverse()}
		for (var i = 0; i < rows.length; i++){table.append(rows[i])}
		
		reapply_zebra_table();
	})
	// as soon as input is inside foods make clear button visible and vi ser vi
	$(document).on("keydown","input",function(e) {
		var keyCode = e.keyCode || e.which;
		if (keyCode == 27) { // ESC
			event.preventDefault();
			$(this).val('');
			$('#filter_table').find('tr').show();
		}
		reapply_zebra_table();
		// Show the clear button if text input value is not empty
		$(this).val().length > 0 ? $(this).parent().find('span').css("visibility", "visible") : $(this).parent().find('span').css("visibility", "hidden");
	});
	// Hide the clear button on click, and reset the input value
	$(document).on("click",".text-input-wrapper > span:nth-child(2)",function(e) {
		$('input').each(function() {
			$(this).val('');
			$('#filter_table').find('tr').show();
			$('#prediction').html('');
		});
		reapply_zebra_table();
		// Show the clear button if text input value is not empty
		$(this).val().length > 0 ? $(this).parent().find('span').css("visibility", "visible") : $(this).parent().find('span').css("visibility", "hidden");
		$('input').focus();
	});
	// filter table for evaluation values, check for numbers or string to search
	$(document).on("keyup click","input#filter_input",function(event) {
		if(event.keyCode != 13) {
			if ( isNumber( $('#filter_input').val() ) ){
				$('table').show();
				
				// show all rows first then filter the rows that should be hidden
				$('#filter_table').find('tr').show().filter(function(index, item) {
					if ( parseInt($(item).find('td:first-child').text(), 10) < $('#filter_input').val()){
						return $(item).hide();
					}
				}).hide();
			}else{
				//split the current value of searchInput
				var data = this.value.split(" ");
				//create a jquery object of the rows
				var jo = $("#filter_table").find("tr");
				if (this.value == "") {
					jo.show();
					return;
				}
				//hide all the rows
				jo.hide();

				//Recusively filter the jquery object to get results.
				jo.filter(function (i, v) {
					var $t = $(this);
					for (var d = 0; d < data.length; ++d) {
						var search = data[d].substr(0,1).toUpperCase()+data[d].substr(1);
						if ($t.is(":contains('" + search + "')")) {
							return true;
						}
					}
					return false;
				})
				//show the rows that match.
				.show();
			}
		}
		reapply_zebra_table();
	});
	// tab loading, oneclick hide all tabs
	$('[id^=tabs_activate_]').click( function(){
		$('[id^=tab_]').hide();
		$('#sql_feedback'). html('');
		$('.navigation').removeClass("tab_active");
		$('.overlay').removeClass("tab_active").hide();
	});
	// refreshes website
	$('#tabs_activate_refresh').click( function(){
		$(this).addClass("tab_active");
		$('#loading').show();
		$('#tab_insert').hide().load('p_diary.php', function() {
			$('#loading').hide();
			$(this).show();
			$('#foods').focus();
		});
	});
	// activates daily chart
	$('#tabs_activate_daily_chart').click( function(){
		$(this).addClass("tab_active");
		$('#loading').show();
		$('#tab_daily_chart').hide().load('p_daily_chart.php', function() {
			$('#loading').hide();
			$(this).show();
		});
	});
	// activates insert tab
	$('#tabs_activate_insert').click( function(){
		$(this).addClass("tab_active");
		$('#loading').show();
		$('#tab_insert').hide().load('p_diary.php', function() {
			$('#loading').hide();
			$(this).show();
			$('#foods').focus();
		});
	});
	// activates evaluation tab
	$('#tabs_activate_evaluation').click( function(){
		$(this).addClass("tab_active");
		$('#loading').show();
		$('#tab_evaluation').hide().load('p_evaluation.php', function() {
			$('#loading').hide();
			$(this).show();
			$('input').focus();
		});
	});
	// activates evaluation tab
	$(document).on("click","#tabs_reactivate_evaluation",function(event) {
		event.preventDefault();
		$('#loading').show();
		$('#tab_evaluation').hide().load('p_evaluation.php', function() {
			$('#loading').hide();
			$(this).show();
			$('input').focus();
		});
	});
	// activates ingredient update tab
	$(document).on("click","#tabs_update_ingredient",function(event) {
		$('#loading').show();
		$('#sql_feedback'). html('');
		$('#tab_evaluation').hide().load('a_evaluation_update_ingredient.php?ingredient='+$('#ingredent_id').val(), function() {
			$('#loading').hide();
			$(this).show();
			$('input').focus();
		});
	});
	// activates history tab
	$('#tabs_activate_statistic').click( function(){
		$(this).addClass("tab_active");
		$('#loading').show();
		$('#tab_statistic').hide().load('p_history.php', function() {
			$('#loading').hide();
			$(this).show();
		});
	});
	// activates menu tab
	$('#menu').click(function() {
		$('.navigation').removeClass("tab_active");
		$('#overlay_account').hide();
		$(this).addClass("tab_active");
		$('#overlay_navigation').slideToggle("fast");
	});
	// activates menu tab
	$('#account').click(function() {
		$('.navigation').removeClass("tab_active");
		$('#overlay_navigation').hide();
		$(this).addClass("tab_active");
		$('#overlay_account').slideToggle("fast");
	});
	// exchange values in input field with selected suggestions
	$(document).on("click","#food_latest div",function(event) {
		add_val_to_foods( $(this).text() );
		$('#foods').focus();
	});
	// exchange values in input field with selected suggestions
	$(document).on("click","#food_sets_latest div",function(event) {
		//$('#foods').val( $('#foods').val()+" "+this.id ).focus();
		resolve_barcode_2_strings(this.id);
		food_set_insert( this.id );
		$('#foods').focus();
	});
	// returns from food list meals to evaluate
	$(document).on("click","#load_evaluate",function(event) {
		event.preventDefault();
		$('#loading').show();
		$('#tab_evaluation').hide().load('p_evaluation.php', function() {
			$('#loading').hide();
			$(this).show();
			$('input').focus();
		});
	});
	// add ingredients to input list
	$(document).on("click","#food_ingredients div",function() {
		$('#foods').val( $('#foods').val()+' '+$(this).text() );
	});
	// load ingredient occurances in history
	$(document).on("click","span[id^=ingredient_]",function() {
		$('#loading').show();
		$('#eval_table').hide().load('a_evaluation_show_ingredient.php?food='+$(this).html(), function() {
			$('#loading').hide();
			$(this).show();
		});
	});
	//infity scroll for history / stats tab
	$(document).scroll(function(e){
		var infinityscroll = function(){
			if( $('#stats_table').length ){  
				if( element_in_scroll("#stats_table tr:last") ) {
					$('#scroll_index').val( parseInt( $('#scroll_index').val() ) +1 );
					$(document).unbind('scroll');
					
					xhr = $.ajax({
						type: "POST",
						//async: false,
						cache: false,
						timeout: 10000,
						url: 'a_history_next_page.php',
						data: 'index='+ $('#scroll_index').val(),
					}).done(function( result ) {
						$('#stats_table tr:last').after(result).fadeIn('slow');
						$(document).scroll(infinityscroll);
					});
				};
			}
		};
		infinityscroll();
	});
	// on click clear do clear the textarea
	$(document).on("click", "#clear_foods", function(){
		event.preventDefault();
		clear_inputs_n_predictions();
	});
	
	// on click clear do clear the ingredient input
	$(document).on("click", "#clear_ingredient", function(){
		event.preventDefault();
		$('#ingredient').val('');
	});
	// updates user language on fly with reload
	$(document).on("change","#user_language",function() {
		xhr = $.ajax({
			type: 'POST',
			url: 'a_user_change_language.php',
			data: {language: $('select[name="user_language"]').val()},
			beforeSend: function(xhr) {
				activeAjaxConnections++;
			},
			error: function(xhr, status, error) {
				alert("Change_User_Language: " + status + " " + xhr.responseText);
			},
			success: function(results) { 
				activeAjaxConnections--;
				$("#overlay_account").css("display", "none");
				print_feedback( results );
				setTimeout(function(){
					location.reload(true)
				}, 3000);
			}
		});
	});
	// update fields if selection changes
	$(document).on("change","select",function() {
		$('#loading').show();
		$('input').prop("disabled", (_, val) => !val);
		if(this.id !== "feeling" && this.id !== "user_language"){
			xhr = $.ajax({
				type: 'POST',
				url: 'a_diary_find_ingredients.php',
				data: $('#form_post').serialize(),
				beforeSend: function(xhr) {
					activeAjaxConnections++;
				},
				error: function(xhr, status, error) {
					alert("Search_Foods: " + status + " " + xhr.responseText);
				},
				success: function(results) { 
					activeAjaxConnections--;
					results = $.trim(results);
					$('#foods').val(results);
					$('.text-input-wrapper span').css("visibility", "visible");
					$('#foods').focus();
				}
			});
			xhr = $.ajax({
				type: 'POST',
				url: 'a_diary_suggest_meals.php',
				data: $('#form_post').serialize(),
				beforeSend: function(xhr) {
					activeAjaxConnections++;
				},
				error: function(xhr, status, error) {
					alert("Search_Suggestions: " + status + " " + xhr.responseText);
				},
				success: function(results) { 
					activeAjaxConnections--;
					results = $.trim(results);
					$('#food_suggestions').html(results);
				}
			});
			xhr = $.ajax({
				type: 'POST',
				url: 'a_diary_find_feeling.php',
				data: $('#form_post').serialize(),
				beforeSend: function(xhr) {
					activeAjaxConnections++;
				},
				error: function(xhr, status, error) {
					alert("Search_Feel: " + status + " " + xhr.responseText);
				},
				success: function(results) { 
					activeAjaxConnections--;
					results = $.trim(results);
					if(results.length > 0){
						$('#feeling').val(results);
						$('#db_update').show();
						$('#db_insert').hide();
					}else{
						$('#db_update').hide();
						$('#db_insert').show();
					}
				}
			});
		}
		$('#loading').hide();
		$('input').prop("disabled", (_, val) => !val);
	});
	// ajax insert database script
	$(document).on("click","#db_insert",function(event) {
		event.preventDefault();
		
		$('button').prop("disabled", (_, val) => !val);
		$('[id^=tab_]').hide();
		$('#loading').show();
		xhr = $.ajax({
			type: 'POST',
			url: 'a_diary_insert.php',
			data: $('#form_post').serialize(),
			error: function(xhr, status, error) {
				alert("Food_Insert " + status + " " + xhr.responseText);
			},
			success: function(results) {
				print_feedback( results );
				$('#tab_insert').load('p_diary.php', function(responseTxt, statusTxt, xhr){
					if(statusTxt == "error"){
						alert("Search_Feel_Error: " + xhr.status + ": " + xhr.statusText);
					}
					$('#loading').hide();
					$('#prediction').text('');
				});
				$('button').prop("disabled", (_, val) => !val);
				$('#db_update').hide();
				$('#db_insert').show();
				$('#barcode_edits').html('');
			}
		});
		$('#tab_insert').show();
	});
	
	// ajax update ingredient database script
	$(document).on("click","#db_ingredient_update",function(event) {
		event.preventDefault();
		
		$('button').prop("disabled", (_, val) => !val);
		$('#loading').show();
		xhr = $.ajax({
			type: 'POST',
			url: 'a_ingredient_update.php',
			data: $('#form_post_ingredient').serialize(),
			error: function(xhr, status, error) {
				alert("Ingredient_Update " + status + " " + xhr.responseText);
			},
			success: function(results) {
				print_feedback( results );
				$('#loading').hide();
				$('input').focus();
				$('button').prop("disabled", (_, val) => !val);
			}
		});
	});
	
	// ajax update ingredient database script
	$(document).on("click","#db_ingredient_delete",function(event) {
		event.preventDefault();

		$('button').prop("disabled", (_, val) => !val);
		$('#loading').show();
		xhr = $.ajax({
			type: 'POST',
			url: 'a_ingredient_delete.php',
			data: $('#form_post_ingredient').serialize(),
			error: function(xhr, status, error) {
				alert("Ingredient_Delete " + status + " " + xhr.responseText);
			},
			success: function(results) {
				print_feedback( results );
				$('#tab_evaluation').hide().load('p_evaluation.php', function() {
					$('#loading').hide();
					$(this).show();
					$('input').focus();
				});
				$('button').prop("disabled", (_, val) => !val);
			}
		});
	});
	
	// remove html of current food_set from view
	$(document).on("click",".clear_food_set",function(event) {
		event.preventDefault();
		$('#form_post_'+this.id).remove();
	});
	// generic ajax update for food setSeconds
	$(document).on("click",".update_food_set",function(event) {
		event.preventDefault();
		
		//disables all elements ending on ID
		//$("button[id$="+this.id+"]").prop("disabled", (_, val) => !val);

		$('#loading').show();
		xhr = $.ajax({
			type: 'POST',
			url: 'a_diary_update_food_set.php',
			data: $('#form_post_'+this.id).serialize(),
			error: function(xhr, status, error) {
				alert("Food_Set_Update " + status + " " + xhr.responseText);
			},
			success: function(results) {
				print_feedback( results );
				$("button[id$="+this.id+"]").prop("disabled", (_, val) => !val);
				$('#loading').hide();
			}
		});
	});
	// generic ajax insert for food setSeconds
	$(document).on("click",".insert_food_set",function(event) {
		event.preventDefault();
		var barcode = this.id;
		//disables all elements ending on ID
		//$("button[id$="+this.id+"]").prop("disabled", (_, val) => !val);

		$('#loading').show();
		xhr = $.ajax({
			type: 'POST',
			url: 'a_diary_insert_food_set.php',
			data: $('#form_post_'+barcode).serialize(),
			error: function(xhr, status, error) {
				alert("Food_Set_Insert " + status + " " + xhr.responseText);
			},
			success: function(results) {
				print_feedback( results );
				$('#form_post_'+barcode).remove();
				//$('#foods').val($('#foods').val()+barcode).focus();
				$("button[id$="+barcode+"]").prop("disabled", (_, val) => !val);
				food_set_insert(barcode);
				resolve_barcode_2_strings(barcode);
				$('#foods').focus();
				$('#loading').hide();
			}
		});
	});
	// ajax update database script
	$(document).on("click","#db_update",function(event) {
		event.preventDefault();
		$('button').prop("disabled", (_, val) => !val);
		$('[id^=tab_]').hide();
		$('#loading').show();
		xhr = $.ajax({
			type: 'POST',
			url: 'a_diary_update.php',
			data: $('#form_post').serialize(),
			error: function(xhr, status, error) {
				alert("Food_Update " + status + " " + xhr.responseText);
			},
			success: function(results) {
				print_feedback( results );
				$('#tab_insert').load('p_diary.php', function(responseTxt, statusTxt, xhr){
					if(statusTxt == "error"){
						alert("Food_Update_Error: " + xhr.status + ": " + xhr.statusText);
					}
					$('#loading').hide();
					$('#prediction').text('');
				});
				$('button').prop("disabled", (_, val) => !val);
				$('#db_update').hide();
				$('#db_insert').show();
			}
		});
		$('#tab_insert').show();
	});
	//////////////////////////////// Initials ////////////////////////////	
	var frame_width = $("#date").width()+$("#type").width()+$("#meal").width()+$("#feeling").width();
	var dayNight_timer = null;
	
	// checkt alle 10min ob uhrzeit/nightmode toggelt
	toggle_night_mode_design();
	
	$("body").focusin(function() {
		toggle_night_mode_design();
		dayNight_timer = setInterval(function(){ toggle_night_mode_design(); }, 60000);
	}).focusout(function() {
		clearInterval(dayNight_timer);
	})
	
	if( $(window).width() > frame_width + 100){
		$("#center").width( frame_width + 100);
	}
	
	//activates insert tab
	$('#tabs_activate_insert').addClass("tab_active");
	$('#loading').show();
	$('#overlay_navigation').hide();
	$('#overlay_account').hide();
	$('#tab_insert').hide().load('p_diary.php', function() {
		$('#quagga_off').hide();
		$('#quagga_window').hide();
		$('#loading').hide();
		$(this).show();
		//$("html").animate({ scrollTop: $('body').offset().top }, 1000);
		$('#foods').focus();
	});
});