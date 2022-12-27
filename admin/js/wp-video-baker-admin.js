(function( $ ) {
	'use strict';

	var loading = $('#loading').hide();
	
	$('#videobaker_post .csf-field-notice').hide();
	
	function add_notice($type,$text){
		
		$('#videobaker_post .csf-field-notice').find('.csf-notice').remove();
		$('#videobaker_post .csf-field-notice').append('<div class="csf-notice csf-notice-' + $type + '">' + $text + '</div>');
		$('#videobaker_post .csf-field-notice').show();
		
	}
	
	function hide_notice(){
		setTimeout(function(){
			$('.csf-field-notice').hide();
		}, 15000);
	}

	$( document ).ajaxStart(function () {
		loading.show();
	});
	
	$( document ).ajaxStop(function () {
		loading.hide();
	});


	$('body').on('click','#gen_video',function(){
		
			add_notice('warning','Please save all changes before sending video to render. Thank you.');
			$('#gen_video').addClass('warning');
		
	});			
			
	$('body').on('click','#gen_video.warning',function(){
		
		var id = $('#gen_video').attr('data-id');
		var api = $('#gen_video').attr('data-api');
		
		var data = {
			'action': 'send_data',
			'id': id,
			'api': api,
		};

		$.post(ajaxurl, data, function(response) {
			var split = response.split("|");
			add_notice(split[1],split[0]);
			if(split[1] == 'success'){
				$('#gen_video').hide();
			}
		}).done(function() { hide_notice(); });
		
	});

	function get_audio_example(){
		if($('select[data-depend-id=text-to-speech-language]').length){
			var result = $('select[data-depend-id=text-to-speech-language]').val().split('|');
			return result[0]; 
		}
	}

	function show_preview(){
		
		var data = preview_data;
		
		var iframe = document.getElementById('preview_iframe');  
		iframe.contentWindow.postMessage(
			{
              type: "remotion-data",
              data
            },
            "*"
		); 

	}
	
	$('body').on('change','select[data-depend-id=text-to-speech-language]',function(){
		$('#audio_preview').empty().append('<div id="audio_preview"><audio controls><source src="https://cloud.google.com/static/text-to-speech/docs/audio/' + get_audio_example() + '.wav" type="audio/mpeg"></audio></div>');
	});
	
	$(window).on('load',function(){
		$('select[data-depend-id=text-to-speech-language]').parent().append('<div id="audio_preview" style="margin-top:20px; "><audio controls><source src="https://cloud.google.com/static/text-to-speech/docs/audio/' + get_audio_example() + '.wav" type="audio/mpeg"></audio></div>');
		if($('#preview_iframe').length){
			show_preview();
		}
	});

})( jQuery );

