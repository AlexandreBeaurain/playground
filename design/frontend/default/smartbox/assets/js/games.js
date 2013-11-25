$(function ()
{
    // Facebook
	$('.fb-target a').each(function ()
	{
		$(this).attr('target', '_blank');
	}); 
	
	// Detect IE9
	var matches = navigator.userAgent.match(/(msie) ([\w.]+)/i);
    if( matches && (matches[2] < 9) ){
    	// Change placeholder if not detect by browser
    	//$.support.placeholder = false;
        if(!$.support.placeholder) {
          var active = document.activeElement;
          $('input[name$="code-input"]').focus(function () {
             if ($(this).attr('placeholder') != '' && $(this).val() == $(this).attr('placeholder')) {
                $(this).val('').removeClass('hasPlaceholder');
             }
          }).blur(function () {
             if ($(this).attr('placeholder') != '' && ($(this).val() == '' || $(this).val() == $(this).attr('placeholder'))) {
                $(this).val($(this).attr('placeholder')).addClass('hasPlaceholder');
             }
          });
          $('input[name$="code-input"]').blur();
          $(active).focus();
          $('form:eq(0)').submit(function () {
             $('input[name$="code-input"].hasPlaceholder').val('');
          });
        }
    }
    
	$('.game-instantwin .form-number').submit(function(){
	    if($('input[name$="code-input"]').val() == ''){
	        $('.flash-msg').fadeOut();
	        $('.no-value').show();
	        $('.error-msg').fadeIn();
	        return false;
	    };
	});
	$('.instantwin-address-form').validate({
	    //debug: true,
	    invalidHandler: function(event, validator) {
            // 'this' refers to the form
            var errors = validator.numberOfInvalids();
            if (errors) {
                var message = errors == 1
                ? 'You missed 1 field. It has been highlighted'
                : 'You missed ' + errors + ' fields. They have been highlighted';
                $("div.error span").html(message);
                $("div.error").show();
            } else {
                $("div.error").hide();
            }
        },
	    rules : {
	        lastname : "required",
	        firstname : "required",
            email : {
                required : true,
                email : true
            },
            "confirm-email" : {
                required : true,
                email : true,
                equalTo : "#email"
            },
	    },
	    messages : {
            lastname : "Veuillez renseigner votre nom",
            firstname : "Veuillez renseigner votre prénom",
            email : {
                required : "Veuillez renseigner votre adresse email",
                email : "Votre adresse email doit être dans le format de name@domain.com"
            },
            "confirm-email" : {
                required : "Veuillez confirmer votre adresse email",
                email : "Votre adresse email doit être dans le format de name@domain.com",
                equalTo : "Vos adresses email ne concordent pas"
            }
        },
        submitHandler : function(){
            var linkToGo = $('.instantwin-address-form .btn').attr('href');
            var host = window.location.hostname;
            //return false;
            window.location.href = 'http://' + host + linkToGo;
        },
    });
    
	// Game : Instant win - scratch game
	if($("#wScratchgame").size() > 0){
		var $scratchGame = $("#wScratchgame");
		$scratchGame.wScratchPad({
	    	image 		: $scratchGame.attr('data-scratchthis'),
	    	image2 		: $scratchGame.attr('data-scratchover'),
	    	color 		: '#FFF',
			overlay 	: 'none',
			width : 211,
			height : 166,
			size : 15,
	        scratchMove: function (e, percent)
	        {
	        	$scratchGame.attr('data-percentscratched', percent);
	        	if(percent > 70){ // Has been scratched enough to end the game
	        		$scratchGame.wScratchPad('clear');
	        		$('.next-instant-win-step .btn').show().one('click', function (e)
	        		{
	        			e.preventDefault();
						$('#play-instantwin').hide();
						$('html, body').animate({ scrollTop: 0 }, 0);
						$('#result-instantwin').fadeIn();
	        		});
	        	}
	        }
		});
	}
	
	//  Game : Post & vote
	if($('.alert-link').size() > 0){
		$('.alert-link').click(function ()
		{
			$(this).parent().submit();
			return false;
		});
	}
	
    /**** Sliders Photo contest */
    var countslider = $('.nivoSlider').size();
	$.each($('.nivoSlider'),function ()
	{
		 sliderphoto(this);
	});
	for(var i=0 ; i<=countslider ; i++){
        sliderphoto('#slider'+i);
    }
    
    /**** Style input file */
    $('#photokitchen-form input[type=file]').uniform({
		fileButtonHtml: 'Parcourir...',
		fileDefaultHtml: 'Photo'
	});
	
	$(".photo-file input[type=file]").uniform({
		fileButtonHtml: 'Parcourir...',
		fileDefaultHtml: 'Photo'
	});
	
	var photoFile = $('.game-postvote .photo-file').size();
	if(photoFile <= 1){
		$('.picto .star').hide();
		PostVoteInput('.game-postvote .photo-file input:file', '.game-postvote .photo-file .filename', '.game-postvote .photo-file .picto');
	} else {
		var i=1;
		$.each($('.game-postvote .photo-file'),function(){
			$(this).addClass('input'+i);
			PostVoteInput('.input'+i+' input:file', '.input'+i+' .filename', '.input'+i+' .picto');
			i++;
		});
	}
	
	function PostVoteInput (inputfile, filename, picto)
	{
		var ivalue = $(inputfile).attr('value');
		if (ivalue != undefined){
			var isplitted = ivalue.split('/');
			var ilast = '';
			if (isplitted.length > 0) {
				ilast = isplitted[isplitted.length-1];
			}
			$(filename).html(ilast);
		}
		if ($(filename).html() == 'Photo'){
			$(picto).hide();
		}
	}
	
	
   	/**** Count characters form */
   	$('#photomsg').limiter('400','#counter-photomsg');
   	
   	$.each($('.form-textarea textarea'), function ()
   	{
   		var maxlength = $(this).attr('maxlength');
   		var charleft = $(this).parent().next().find('.character-left');
   		if(typeof maxlength !== 'undefined'){
   			charleft.text(maxlength);
   			charleft.parent().fadeIn();
   		}
   		$(this).limiter(maxlength, charleft);
   	});
   	
   	
   	/**** Vote Ajax */
    postvotecount('.nb-votes a.logged', 'btn-post-vote-check', '.nb-post-vote-number', 'nb-votes-check', 'btn-post-vote', 'nb-votes', 'nb-votes-check a', '.already-voted');
    
    /**** LIVE PHOTO UPLOAD */
    $('#photocontest-create-form input[type="file"]').change(function(){
        var filename = $(this).val();
        $('#uploadform').append('<input name="file" type="file" value="' + filename + '">');
        $('#uploadform-id').val($(this).parent().parent().find('.uploadphotoid').val());
        $('#uploadform').submit();
        $(this).hide();
    });
        
    
    /**************************** Game - Quizz */
    /**** Navigation - Mécanique */
	$('.game-quiz .page').first().addClass('active');
	$('.end').hide();
	if($('.page:first').hasClass('active')){
		$('.previous').hide();
	}
	if($('.page').last().hasClass('active')){
		$('.next').hide();
		$('.end').show();
	}
	$('#next').click(function() {
		var idfirst = $('.game-quiz .page.active').attr('id');
		$('#'+idfirst).removeClass('active');
		$('#'+idfirst).next('.page').addClass('active');
		if($('.page').last().hasClass('active')){
			$('.next').hide();
			$('.end').show();
		}
		$('.previous').show();
	});
	$('#previous').click(function() {
		var idfirst = $('.game-quiz .page.active').attr('id');
		$('#'+idfirst).removeClass('active');
		$('#'+idfirst).prev('.page').addClass('active');
		if($('.page:first').hasClass('active')){
			$('.previous').hide();
		}
		$('.next').show();
		$('.end').hide();
	});
	
	/**** Timer */
	$(document).ready(function ()
	{
		var Timerquiz = new (function() {
			var $countdown,
		        incrementTime = 70,
		        currentTime = parseInt($('.timer').text()),
		        updateTimer = function() {
		            $countdown.html(formatTime(currentTime));
		            if (currentTime == 0) {
		                Timerquiz.Timer.stop();
		                timerComplete();
		                return;
		            }
		            currentTime -= incrementTime / 10;
		            if (currentTime < 0) currentTime = 0;
		        },
		        timerComplete = function() {		            
		            alert('Le temps imparti est écoulé !');
		            // caution : the submit button in the form HAVE TO be different from "name"
		            // see : http://bugs.jquery.com/ticket/4652
		            $('form:first').submit();
		        },
		        init = function() {
		            $countdown = $('.timer');
		            Timerquiz.Timer = $.timer(updateTimer, incrementTime, true);
		        };
		    $(init);
		}); 
	});
	
	function pad (number, length)
	{
	    var str = '' + number;
	    while (str.length < length) {str = '0' + str;}
	    return str;
	}
	
	function formatTime (time)
	{
	    var min = parseInt(time / 6000),
	        sec = parseInt(time / 100) - (min * 60),
	        hundredths = pad(time - (sec * 100) - (min * 6000), 2);
	    return (min > 0 ? pad(min, 2) : "00") + ":" + pad(sec, 2) + ":" + hundredths;
	}
	
	// Commun : Envoi mail, reset mail invitation form on result page
    $('.more-invit').click(function ()
    {
    	$('#mail-send input').attr('value', '');
		$(this).parent().fadeOut(function ()
		{
	  		$('#mail-send').fadeIn();
	  	});
  	});
	
});