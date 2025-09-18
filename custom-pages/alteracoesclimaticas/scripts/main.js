/* Javascript for LP DECO AC */
/* Exadorma */
if(typeof templateLocation === 'undefined') {var templateLocation = "";}
if(typeof siteLocation === 'undefined') {var siteLocation = "/";}
if(typeof lang === 'undefined') {var lang = "pt";}

var $municipalities_selectize;
var captchaDone = false;

var municipality_contacts_json = [];

jQuery(document).ready(function($){
    if (typeof lp_ac_data !== "undefined") {
        $.getJSON(lp_ac_data.json_url, function(data){
            municipality_contacts_json = data;
            console.log("json loaded1:", municipality_contacts_json.length);

            $('path[data-municipality-id]').each(function(){
                var $path = $(this);
                var municipality_id = $path.data('municipality-id');
                console.log(municipality_id);
                
                var match = municipality_contacts_json.find(function(item){
                    return String(item["Unnamed: 4"]).trim() === String(municipality_id).trim();
                });
                console.log(match);

                if (!match || !match["Unnamed: 3"]) {
                    $path.addClass('nodata');
                } else {
                    console.log('Contacts for', municipality_id, ':', match["Unnamed: 3"]);
                }
            });

        });
    }
});

jQuery(document).ready(function($) {
	"use strict";
	
	
	// Change img to inline SVG

    $('img.inline-svg').each(function(){
        var $img = $(this);
        var imgURL = $img.attr('src');

        $.get(imgURL, function(data) {
            var $svg = $(data).find('svg');

            /* Replace image with new SVG */
            $img.replaceWith($svg);

        }, 'xml');

    });
	
	var hasEvaluated = false;
	
	//cookie storage array
	var cookieRAEVArray_init = {ra: {}, "ev": []};
	var cookieRAEVArray;
	
	//scramble/obfuscate:
	//var scrambled = scramble(getCookie("ac_u_ra_ev"),24212);
	//console.log(scrambled)
	//console.log(scramble(scrambled,-24212))
	
	//if the cookie was set, replace it with this (only if a true object)
	//catch if it is not a proper object:
	try {
	  cookieRAEVArray = JSON.parse(getCookie("ac_u_ra_ev"));
	} catch(ex){
	  cookieRAEVArray = null;
	}
	if(typeof cookieRAEVArray !== 'object' || cookieRAEVArray === null){
		cookieRAEVArray = cookieRAEVArray_init;
	}
	//console.log(cookieRAEVArray)
	
	//update the municipalities container with their data attr:
	$(".map-municipalities").each(function() {
		$(this).parent().attr("data-id", $(this).attr("data-id"));
	});
	
	//click the districts:
	$(".map-districts [data-id]").click(function() {
		var districtID = $(this).attr("data-id");
		var districtTitle = $(this).attr("data-title");
		
		//if the item is already selected, abort:
		if($(this).hasClass("selected")){
			return false;
		}
		
		//remove all the selected classes in the district:
		$(".map-districts [data-id]").removeClass("selected");
		//remove all the selected classes in the municipalities:
		$(".map-municipalities [data-municipality-id]").removeClass("selected");
		
		//place the selected in this district:
		$(this).addClass("selected");
		
		//zoom smaller for the main map:
		$(".map-districts").addClass("zoom-smaller");
		
		//show the corresponding municipality:
		hideDetailsBox();
		
		if($(".map-municipalities-block .map-svg.zoom-show").length > 0){
			$(".map-municipalities-block .map-svg").removeClass("zoom-show");
			$(".map-municipalities-block .map-svg").parent().parent().css("height", "");
			$(".map-municipalities-item").removeClass("stack-up");
			showMunicipality(districtID);
		} else {
			showMunicipality(districtID);
		}
	});
	
	function showMunicipality(districtID){
		var thisMapContainer = $(".map-municipalities-item[data-id='" + districtID + "']");
		var thisMap = $(".map-municipalities-block .map-svg[data-id='" + districtID + "']");
		
		thisMapContainer.addClass("stack-up");
		thisMap.addClass("zoom-show");
		
		//update the map container's height:
		resizeMunicipalityWrapper();
		
		//scroll to the section:
		if(document.body.clientWidth < 837){
			scrollTo($("#municipalities_section"), 800, 260);
		}
	}
	
	function resizeMunicipalityWrapper(){
		var thisMapWrapper = $(".map-municipalities-item.stack-up");
		var thisMapHeight = "";
		
		//cases for mobile:
		var bodyWidth = document.body.clientWidth;
		if(bodyWidth < 837){
			thisMapHeight = $(".map-svg", thisMapWrapper).height() + "px";
		} else {
			thisMapHeight = "";
		}
		
		thisMapWrapper.parent().css("height", thisMapHeight);
	}
	
	//click the municipalities:
	$(".map-municipalities > g > path[data-municipality-id], .map-municipalities > g > g[data-municipality-id]").click(function() {
		if($(this).attr("data-municipality-id") != undefined){
			var theElement = $(this);
			
			//if the item is already selected, abort:
			if($(this).hasClass("selected")){
				return false;
			}
			//hide the details box:
			//hideDetailsBox();
			//$("#plan-details").delay(500).queueRemoveClass('zoom-show').getDetailsForMunicipality($(this));
			//getDetailsForMunicipality(theElement);
			
			if($("#plan-details.zoom-show").length > 0){
				$("#plan-details").removeClass("zoom-show")
				   .delay(400)
				   .queue(function() {
					   getDetailsForMunicipality(theElement);
						$(this).dequeue();
				});
			} else {
				getDetailsForMunicipality(theElement);
			}
		}
	});
	
	//$.fn.getDetailsForMunicipality = function(theElement) {
	function getDetailsForMunicipality(theElement){
		var theElement = theElement;
		var thisMap = theElement.closest(".map-municipalities")
		var districtID = thisMap.attr("data-id");
		var districtAlias = thisMap.attr("data-district");
		//now the municipality:
		var municipality_id = theElement.attr("data-municipality-id");
		console.log(municipality_id);
		var municipalityTitle = theElement.attr("data-title");
		
		hideRatingThanks();

		//remove all the selected classes in the municipalities:
		$(".map-municipalities [data-municipality-id]").removeClass("selected");

		//place the selected in this municipality:
		theElement.addClass("selected");

		//get the data from the json and build the details:
		$("#plan-details").attr({"data-district-id": districtID, "data-municipality-id": municipality_id, "data-municipality-title": municipalityTitle});

		//update the title:
		$("#plan-details .plan-details-title").text("Município: " + municipalityTitle);

		//definition of the lines array and their indexes in the json
		var plan_details_lines_array = {"impact": "1", "measures": "2", "ecofootprint": "3", "adaptation_plan": "4", "available_site": "5"};

		//get the details from the json:
		//console.log(plan_details_json[municipality_id][1]);
		for(var i in plan_details_lines_array){
			//console.log(i); // alerts key
			//console.log(plan_details_lines_array[i]); //alerts key's value

			//check if the item is valid (0/1)
			var thisValue = plan_details_json[municipality_id][plan_details_lines_array[i]];
			var thisValue_text = "";
			switch (thisValue) {
				case '1':
					thisValue_text = "Sim";
					break;
				case '0':
					thisValue_text = "Não";
					break;
			  default:
					thisValue_text = "Site não disponível";
					thisValue = "na"
			}
			//now update the details:
			$(".plan-details-lines [data-item='" + i + "'] .plan-status").removeClass("status-0 status-1 status-na");
			$(".plan-details-lines [data-item='" + i + "'] .plan-status").addClass("status-" + thisValue).text(thisValue_text).attr("title", thisValue_text);
		}

		


		    var contactos = "";
		    if (municipality_contacts_json.length > 0) {
		        

		        var match = municipality_contacts_json.find(function(item){
				    return String(item["Unnamed: 4"]).trim() === String(municipality_id).trim();
				});
		        console.log(match);
		        if (match) {
		            contactos = match["Unnamed: 3"]; // contacts
		        }
		    }

			if (contactos && contactos.trim() !== "") {
			    var listItems = contactos
			        .split("\n")
			        .map(function(line) {
			            return "<li>" + line.trim() + "</li>";
		        });
 				$(".plan-details-lines-block").find("ul.json-list").html(listItems);			    
			    $(".plan-details-lines-block").removeClass("nodata");
			    $(".plan-details-lines.no-list").hide();
			    $(".map-wrapper .map-svg path.selected, .map-wrapper .map-svg g path.selected").removeClass("nodata");
			    $(".map-wrapper .map-svg g.selected path").removeClass("nodata");

			} else {
			    $(".plan-details-lines-block").find("ul.json-list").html('');
			    $(".plan-details-lines-block").addClass("nodata");
			    $(".plan-details-lines.no-list").show();
			    $(".map-wrapper .map-svg path.selected, .map-wrapper .map-svg g path.selected").addClass("nodata");
			    $(".map-wrapper .map-svg g.selected path").addClass("nodata");
			}



		//the global evaluation:
		$(".global-evaluation-status span").removeClass();
		//get it from the json:
		var thisGlobalEvaluation = plan_details_json[municipality_id][6];
		var thisGlobalEvaluation_text = "";
		switch (thisGlobalEvaluation) {
			case '1':
				thisGlobalEvaluation_text = "Pode Melhorar";
				break;
			case '2':
				thisGlobalEvaluation_text = "Satisfatória";
				break;
			case '3':
				thisGlobalEvaluation_text = "Boa";
				break;
		  default:
				thisGlobalEvaluation_text = "N/A";
		}
		//now update the details:
		$(".global-evaluation-status span").addClass("evaluation-" + thisGlobalEvaluation).text(thisGlobalEvaluation_text);

		//get the ratings for this municipality:
		doGetRating(municipality_id);
		
		//check if this user already evaluated (at the form)
		//don't show the messages if they did:
		if(cookieRAEVArray.ev.includes(municipality_id) || hasEvaluated){
			$(".rating-result-box-evaluate, .interactive-participate").hide();
		} else {
			$(".rating-result-box-evaluate, .interactive-participate").show();
		}
		
		//change the select to the respetive municipality:
		selectTheMunicipalitiesDropdown();
		
		// ALL DONE:
		//show the details box:
		//$("#plan-details").show();
		$("#plan-details").addClass("zoom-show");
		//$("#plan-details").addClassDelay('zoom-show',500);
		
		$(".plan-details-wrapper").addClass("show-details-mobile");
		//scroll to the section:
		if(document.body.clientWidth < 1137){
			scrollTo($("#municipalities_details_section"), 800, 260);
		}
		
		//if the user can rate, let's update the rating:
		//look in the user's rating array:
		if(!(municipality_id in cookieRAEVArray.ra)){
			$("ul#interactive-rating").addClass("can-rate");
		} else {
			$("ul#interactive-rating").removeClass("can-rate");
			//show thanks and point the rating to the user's rated star:
			var thisRating = cookieRAEVArray.ra[municipality_id];
			//NOTE: delay it the same time as the animation of the details, otherwise the tip won't catch the correct position!
			$("#interactive-rating").attr("data-rating-user", thisRating)
			   .delay(400)
			   .queue(function() {
				   showRatingThanks();
					$(this).dequeue();
			});
		}
		
		return this;
	};
	
	function hideDetailsBox(){
		//$("#plan-details").hide();
		$("#plan-details").removeClass("zoom-show");
		$(".plan-details-wrapper").removeClass("show-details-mobile");
		
		//$("#plan-details").delay(500).queueRemoveClass('zoom-show');
	}
	
	//------------- rating -------
	$(document).on("mouseenter", "ul#interactive-rating.can-rate li", function(event){
		var thisRating = $(this).attr("data-rating");
		for (var i = thisRating; i > 0; i--){
			$("ul#interactive-rating.can-rate li[data-rating='" + i + "']").addClass("hover");
		}
	});
	$(document).on("mouseleave", "ul#interactive-rating.can-rate li", function(event){
		$("ul#interactive-rating.can-rate li").removeClass("hover");
	});
	
	$(document).on("click", "#interactive-rating.can-rate li", function(event){
		event.preventDefault();
		
		//prevent from rating in this:
		$("ul#interactive-rating.can-rate li").removeClass("hover");
		$("ul#interactive-rating").removeClass("can-rate");
		
		var municipality_id = $("#plan-details").attr("data-municipality-id");
		var municipality_title = $("#plan-details").attr("data-municipality-title");
		var thisRating = $(this).attr("data-rating");
		var ratingResult = performRating("set", municipality_id, municipality_title, thisRating);
		
		//store the rating at the cookie:
		cookieRAEVArray.ra[municipality_id] = thisRating;
		storeRA_EV_cookie();
		
		//store the rating for the thank you box tip:
		$("#interactive-rating").attr("data-rating-user", thisRating);
		
		//console.log("ratingResult: " + ratingResult);
		doGetRating(municipality_id);
		
		showRatingThanks();
	});
	
	function performRating(rating_type, municipality_id, municipality_title, rating){
		var request;
		var theResponse = "";

		// Abort any pending request
		if (request) {
			request.abort();
		}

		// Fire off the request to /form.php
		request = $.ajax({
			url: siteLocation + "includes/ra.php",
			type: "post",
			async: false,
			data: {"rating_type": rating_type, "municipality_id": municipality_id, "municipality_title": municipality_title, "rating": rating}
		});
		
		// Callback handler that will be called on success
		request.done(function (response, textStatus, jqXHR){
			//console.log(response);
			theResponse = response;
		});

		// Callback handler that will be called on failure
		request.fail(function (jqXHR, textStatus, errorThrown){
			// Log the error to the console
			console.error(
				"The following error occurred: "+
				textStatus, errorThrown
			);
		});
		
		return theResponse;
	}
	
	function doGetRating(municipality_id){
		$("ul#interactive-rating li").removeClass("active");
		var thisRating = performRating("get", municipality_id, "", "");
		//console.log(thisRating);
		for (var i = thisRating; i > 0; i--){
			$("ul#interactive-rating li[data-rating='" + i + "']").addClass("active");
		}
	}
	
	function showRatingThanks(){
		//place the box tip at the voted star:
		var userRating = $("#interactive-rating").attr("data-rating-user");
		var ratedPosition = $("#interactive-rating li[data-rating='" + userRating + "']").position().left;
		$(".rating-result-box-tip").css("left", ratedPosition + "px");
		
		//show the box and animate it:
		$(".rating-result-block").show();
		$("#plan-details").show()
		   .delay(100)
		   .queue(function() {
			   $(".rating-result-block").addClass("zoom-show");
			   $(this).dequeue();
		});
	}
	
	function hideRatingThanks(){
		$(".rating-result-block").hide().removeClass("zoom-show");
	}
	
	//--------- form contacts --------
	//populate the municipalities select:
	for(var i in municipalities_json){
		var municipalities_key = i;
		var municipalities_val = municipalities_json[i];
		
		//set the options
		//NOTE: for selectize I have to add data-data for the custom data attr!
		//https://github.com/selectize/selectize.js/issues/239#issuecomment-352698545
		var thisOptions = {
			value: municipalities_val[1],
			text: municipalities_val[1],
			"data-id": municipalities_val[0],
			"data-data": '{"id": "' + municipalities_val[0] + '"}'
		};
		
		//check if this municipality can still be evaluated:
		if(cookieRAEVArray.ev.includes(municipalities_val[0])){
			thisOptions["disabled"] = "disabled";
		}
		
		$("#select_municipalities").append($('<option>', thisOptions));
	}
	
	//apply selectize:
	//var $municipalities_selectize = $('#select_municipalities').selectize({dropdownParent: 'body'});
	var $municipalities_selectize = $('#select_municipalities').selectize({
		dropdownParent: 'body',
		render: {
			option: function (data, escape) {
				return '<div data-id="' + data.id + '" class="option">' + data.text + '</div>';
			}
		}
	})
	
	/*
	$('#select_municipalities').on('change', function(event) {
		var selectedValue = $(this).val();
		var $selectedOption = $(this)[0].selectize.getOption(selectedValue);

		console.log($selectedOption.data('id'))
		//update the id
		$("#contacts-form [name='id_municipality']").val($selectedOption.data('id'));
	});
	*/
	
	contactsFormFieldsHandler();
	
	$(".bt-interactive-participate").on("click", function(event){
		event.preventDefault();
		
		//change the select to the respetive municipality:
		//already done when we selected at the map (see above)
		
		//send to the form:
		scrollTo($("#contacts-form-wrapper"), 1000, 260);
	});
	
	function selectTheMunicipalitiesDropdown(){
		var theMunicipality = $("#plan-details").attr("data-municipality-title");
		$municipalities_selectize[0].selectize.setValue(theMunicipality);
	}
	
	//click the send button:
	$(".bt-send-contacts-form").on("click", function(event){
		event.preventDefault();
		
		$("#contacts-form .wpcf7-not-valid-tip").remove();
		$("#contacts-form").removeClass("invalid failed");
		$(".wpcf7-response-output").hide();
		
		//validations:
		var formValid = true;
		
		$("#contacts-form [aria-required='true']").each(function(){
			var thisParent = $(this).parent();
			if($(this).val() === ""){
				var errorTipContent = '<span class="wpcf7-not-valid-tip" aria-hidden="true">O campo é obrigatório.</span>';
				thisParent.append(errorTipContent);
				formValid = false;
			}
			if($(this).attr("name") === "email" && !validateEmail($(this).val()) && $(this).val() !== ""){
				$(this).after('<span class="wpcf7-not-valid-tip" aria-hidden="true">O endereço de email é inválido.</span>');
				formValid = false;
			}
		});
		
		if(!formValid){
			$("#contacts-form").addClass("invalid");
			$(".wpcf7-response-output").html("Um ou mais campos com erros. Por favor, verifique e tente de novo.").show();
		}
		
		if (formValid) {
			//console.log("initial valid")
			disableFormFields();
			//check recaptcha:
			//grecaptcha.execute();
			grecaptcha.ready(function() {
				grecaptcha.execute('6LevCcseAAAAAH-AsYicDrc9iNJFkA591RUCEl2U', {action:'validate_captcha'})
						  .then(function(token) {
					//store the token:
					//console.log("Token:" + token)
					$('#g-recaptcha-response').val(token);
					
					$.when(validateRecaptchaServer()).done(function(theResponse){
						//console.log(theResponse)
						if(theResponse === "success"){
							//console.log("done")
							processFormAfterValid();
						} else {
							//console.log("fail")
							$("#contacts-form").addClass("failed");
							$(".wpcf7-response-output").html("Ocorreu um erro, por favor tente mais tarde.").show();
							enableFormFields();
						}
					}).fail(function(theResponse){
						//console.log("error: " + sendResult);
					});
				});
			});
        }//end formValid
	});
	
	
	function validateEmail(email) {
		var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		return re.test(String(email).toLowerCase());
	}
	
	function contactsFormFieldsHandler(){
		$(document).on("change", ".consent", function(){
			if($(this).is(':checked')){
				$(".bt-send-contacts-form").prop("disabled", false);
			} else {
				$(".bt-send-contacts-form").prop("disabled", true);
			}
		});
		//hide the field warnings:
		$(document).on("change", "#contacts-form [aria-required='true']", function(){
			//hide
			$("#contacts-form").removeClass("invalid");
			$(".wpcf7-response-output").hide();
			$(this).siblings(".wpcf7-not-valid-tip").remove();
		});
	}
	
	function disableFormFields(){
		$("#contacts-form").removeClass("invalid");
		$(".wpcf7-response-output").hide();

		// Disable all inputs
		$("#contacts-form .wpcf7-form-control").prop("disabled", true);
		$municipalities_selectize[0].selectize.disable();

		//show the loader:
		$("#contacts-form .wpcf7-spinner").css("visibility", "visible");
	}
	
	function enableFormFields(){
		// Disable all inputs
		$("#contacts-form .wpcf7-form-control").prop("disabled", false);
		$municipalities_selectize[0].selectize.enable();

		//show the loader:
		$("#contacts-form .wpcf7-spinner").css("visibility", "hidden");
	}
	
	function processFormAfterValid(){
		enableFormFields();
		//update the id_municipality:
		//NOTE: this was refactored to work with selectize, see below
		//$("#contacts-form [name='id_municipality']").val($("#contacts-form #select_municipalities").find(":selected").attr("data-id"));
		var selectedValue = $municipalities_selectize.val();
		var $selectedOption = $municipalities_selectize[0].selectize.getOption(selectedValue);
		//update the id
		$("#contacts-form [name='id_municipality']").val($selectedOption.data('id'));

		//update the cookie array and store it:
		cookieRAEVArray.ev.push($("#contacts-form [name='id_municipality']").val());
		storeRA_EV_cookie();

		doSendContactsForm();
		
		disableFormFields();
	}
	
	function doSendContactsForm(){
		$.when(sendContactsForm()).done(function(theResponse){
			var sendResult = theResponse;
			//console.log("sendResult: " + sendResult);
			$("#contacts-form").addClass("sent");
			$(".wpcf7-response-output").html("Obrigado pela sua mensagem.").show();
			$("#contacts-form .wpcf7-spinner").css("visibility", "hidden");
			
			$(".bt-send-contacts-form").remove();
			
			//can't fill the form again, until a new refresh!
			hasEvaluated = true;
			//$("#contacts-form p").fadeOut('400', function() {
			//	$(this).remove();
			//});
		}).fail(function(theResponse){
			//var sendResult = theResponse;
			//console.log("error: " + sendResult);
			$("#contacts-form").addClass("failed");
			$(".wpcf7-response-output").html("Ocorreu um erro. Por favor tente mais tarde.").show();
			
			$("#contacts-form .wpcf7-form-control").prop("disabled", false);
			$("#contacts-form .wpcf7-spinner").css("visibility", "hidden");
		});
	}
	
	function sendContactsForm(){
		var request;
		var theResponse = "";

		// Abort any pending request
		if (request) {
			request.abort();
		}
		
		var form_data = $('#contacts-form').serializeObject();
		request = $.ajax({
			url: siteLocation + "includes/co.php",
			type: "post",
			data: form_data
		});
		
		// Callback handler that will be called on success
		request.done(function (response, textStatus, jqXHR){
			//console.log(response);
			
		});

		// Callback handler that will be called on failure
		request.fail(function (jqXHR, textStatus, errorThrown){
			// Log the error to the console
			console.error(
				"The following error occurred: "+
				textStatus, errorThrown
			);
		});
		
		return request;
	}
	
	//recaptcha:
	function validateRecaptchaServer(){
		var recaptchaResponse = $('#g-recaptcha-response').val();
		if(recaptchaResponse === ""){
			//alert("Por favor valide o recaptcha");
			return false;
		}
		var itemPost = $.ajax({
			url: siteLocation + "includes/validate-recaptcha.php",
			type: "post",
			dataType: "html",
			data: {"recaptcha": recaptchaResponse}
		});
		itemPost.fail(function(data, textStatus, error) {
			console.log("Error: " + textStatus + ", " + error);
			//grecaptcha.reset();
		});
		itemPost.done(function(data) {
			//console.log(data + "ajax");
			if(data === "success"){

			}
			if(data === "fail"){
				//error!
				//grecaptcha.reset();
			}
		});
		
		return itemPost;
	}
	
	function storeRA_EV_cookie(){
		var cookieRAEVArray_string = JSON.stringify(cookieRAEVArray);
		//createCookie("ac_u_ra_ev", cookieRAEVArray_string, "365");
		//to create a session cookie, don't sepecify the days:
		createCookie("ac_u_ra_ev", cookieRAEVArray_string);
	}
		
	$.fn.serializeObject = function(){
		var o = {};
		var a = this.serializeArray();
		$.each(a, function() {
			if (o[this.name] !== undefined) {
				if (!o[this.name].push) {
					o[this.name] = [o[this.name]];
				}
				o[this.name].push(this.value || '');
			} else {
				o[this.name] = this.value || '';
			}
		});
		return o;
	};
	
	//wait for class adding or removing:
	//https://stackoverflow.com/a/38986823/1164726
	$.fn.queueAddClass = function(className) {
		this.queue('fx', function(next) {
			$(this).addClass(className);
			next();
		});
		return this;
	};
	$.fn.queueRemoveClass = function(className) {
		this.queue('fx', function(next) {
			$(this).removeClass(className);
			next();
		});
		return this;
	};
	
	function scrollTo(theObject, theDuration, theOffset){
		if(theOffset === undefined){
			theOffset = 0;
		}
		//hardcode the offset for now:
		//theOffset = $("#logo-container-mobile").height();
		if(document.body.clientWidth < 1137){
			theOffset = 110;
		}
		if(document.body.clientWidth < 837){
			theOffset = 70;
		}
		$([document.documentElement, document.body]).animate({
			scrollTop: theObject.offset().top - theOffset
		}, theDuration);
	}
	
	// resize
	$(window).on('resize', function() {
		resizeMunicipalityWrapper();
	});
	
});

//get/set cookies:
//https://stackoverflow.com/questions/4825683/how-do-i-create-and-read-a-value-from-cookie
//https://github.com/madmurphy/cookies.js/blob/master/cookies.js
//https://developer.mozilla.org/en-US/docs/Web/API/document/cookie
function createCookie(name, value, days) {
    var expires;
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    }
    else {
        expires = "";
    }
	document.cookie = name + "=" + value + expires + "; path=/";
}

function getCookie(c_name) {
    if (document.cookie.length > 0) {
        c_start = document.cookie.indexOf(c_name + "=");
        if (c_start != -1) {
            c_start = c_start + c_name.length + 1;
            c_end = document.cookie.indexOf(";", c_start);
            if (c_end == -1) {
                c_end = document.cookie.length;
            }
            return unescape(document.cookie.substring(c_start, c_end));
        }
    }
    return "";
}
function scramble (s,shift){
 var r = "";
 for(var i = 0; i < s.length; i++){
   r += String.fromCharCode(s.charCodeAt(i) + shift)
 }
 return r
}