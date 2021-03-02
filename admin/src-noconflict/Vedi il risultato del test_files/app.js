$(function() {
	jQuery('.copy').on('click',function(){
		const copyText = document.getElementById(jQuery(this).data('target'));

		/* Select the text field */
		copyText.select();
		copyText.setSelectionRange(0, 99999); /*For mobile devices*/

		/* Copy the text inside the text field */
		document.execCommand("copy");
	});

	jQuery("#lang_select").on('click',function() {
		if (jQuery("#dropdown_content_lang").css("display") == "none") {
			jQuery("#dropdown_content_lang").fadeIn("slow");
			jQuery("#lang_select").addClass("active");
		} else {
			jQuery("#dropdown_content_lang").fadeOut("slow");
			jQuery("#lang_select").removeClass("active");
		}
	});

	jQuery(document).on('click',function(e) {
		const subject = jQuery("#lang_select");
		if(e.target.id != subject.attr("id") && !subject.has(e.target).length) {
			$("#dropdown_content_lang").fadeOut("slow");
			$("#lang_select").removeClass("active");
		}
	});

	let emailField = jQuery('#home #email');

	if(emailField.length){
		const r = /bot|googlebot|crawler|spider|robot|crawling/i;
		if(!r.test(navigator.userAgent)){
			emailField.val(emailField.data('prefix')+'-'+(Math.random().toString(36).substring(2,11))+String.fromCharCode(64)+emailField.data('domain'));
			jQuery("#submitbutton").on('click',function(){
				if(jQuery("#email").val().indexOf(String.fromCharCode(64)+emailField.data('domain')) == -1){
					alert("Please send your message to a xxx"+String.fromCharCode(64)+emailField.data('domain')+' address');
					return false;
				}else{
					return true;
				}
			});

		}
	}

	jQuery("#searchHost").on("keyup", function(){
		let textToSearch = jQuery(this).val().toUpperCase();
		jQuery("#hosts div").each(function(){
			if(textToSearch.length == 0 || jQuery(this).text().toUpperCase().indexOf(textToSearch) != -1){
				jQuery(this).css("display","");
			}else{
				jQuery(this).css("display","none");
			}
		});
	});

	var progress = jQuery('#waiting-page .progress-bar');
	if(progress.length){
		var elapsedTime = 0,
			refreshRate = 1,
			reloadTime = 14,
			countdown = jQuery('.countdown');

		// Show the remaining time before reloading the page
		function showRemainingTime() {
			countdown.html( Math.max(reloadTime-elapsedTime,0));
			progress.css('width',Math.min((elapsedTime/reloadTime*100),100)+'%');

			if(elapsedTime > (reloadTime+(refreshRate*5))){
				//MMMmmm safe guard to force to refresh the page... but only once!
				window.location.reload();
				return;
			}
			elapsedTime += refreshRate;
			setTimeout( showRemainingTime, refreshRate*1000 );
		}

		showRemainingTime();
	}

	jQuery(".menu-responsive .btn").on('click', function() {
		jQuery('.menu-responsive .btn',jQuery(this).closest('.result')).removeClass('active');
		jQuery(this).addClass('active');
		jQuery('iframe',jQuery(this).closest('.result')).css("width",jQuery(this).data('size'));
	});

	// Toggles a result details when clicking on div.header
	jQuery( '.test-result .header' ).on('click',function() {
		jQuery(this).closest('.test-result').toggleClass('open');
	});


	jQuery('.geniframe').each(function(){

		let content = jQuery(this).data('raw');
		if(!content) content = jQuery(jQuery(this).data('source')).data('raw');

		if(jQuery(this).data('stripimages')){
			const regex = /<img([^>]*)\ssrc=("(?!data:)[^"]+"|'(?!data:)[^']+')/gi;
			content = content.replace( regex, '<img$1 src=""' );
		}


		const blob = new Blob([content], {'type':'text/html'});

		const iframe = document.createElement('iframe');
		iframe.src = URL.createObjectURL(blob);
		iframe.style.width = '99%';
		iframe.style.height = '600px';
		iframe.style.border = '1px solid #ccc';

		//Replace the current element by the iframe
		jQuery(this).before(iframe);
	});

});