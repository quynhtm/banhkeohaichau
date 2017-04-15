jQuery(document).ready(function($){
	SITE.backTop();
	SITE.contact();
	SITE.tab_detail_product();
});

SITE={
	backTop:function(){
		jQuery(window).scroll(function() {
		    if(jQuery(window).scrollTop() > 0) {
				jQuery("#back-top").fadeIn();
			} else {
				jQuery("#back-top").fadeOut();
			}
		});
		jQuery("#back-top").click(function(){
			jQuery("html, body").animate({scrollTop: 0}, 1000);
			return false;
		});
	},
	contact:function(){
		jQuery('#submitContact').click(function(){
			var valid = true;
			if(jQuery('#txtName').val() == ''){
				jQuery('#txtName').addClass('error');
				valid = false;
			}else{
				jQuery('#txtName').removeClass('error');
			}
			
			if(jQuery('#txtMobile').val() == ''){
				jQuery('#txtMobile').addClass('error');
				valid = false;
			}else{
				
				var regex = /^[0-9-+]+$/;
				var phone = jQuery('#txtMobile').val();
				if (regex.test(phone)) {
			        jQuery('#txtMobile').removeClass('error');
			    }else{
					jQuery('#txtMobile').addClass('error');	
				}
			}
			if(jQuery('#txtMessage').val() == ''){
				jQuery('#txtMessage').addClass('error');
				valid = false;
			}else{
				jQuery('#txtMessage').removeClass('error');
			}
			
			if(jQuery('#securityCode').val() == ''){
				jQuery('#securityCode').addClass('error');
				valid = false;
			}
			
			var error = jQuery('#formSendContact .error').length;
			if(error > 0){
				return false;
			}
			return valid;
		});
	},
	captchaCheckAjax:function(){
		var captcha = jQuery('#securityCode').val();
		if(captcha != ''){
			var url = WEB_ROOT + '/captchaCheckAjax';
			jQuery.ajax({
				type: "POST",
				url: url,
				data: "captcha="+encodeURI(captcha),
				success: function(data){
					if(data == 0){
						jQuery('#securityCode').addClass('error');
                        var img = document.images['imageCaptchar'];
                        img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.round(1000*Math.random());
					}else{
						jQuery('#securityCode').removeClass('error');
					}
					return false;
				}
			});
		}
	},
    refreshCaptcha:function(){
		$('.iconRefreh').click(function(){
            var img = document.images['imageCaptchar'];
            img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.round(1000*Math.random());
		});
	},
    tab_detail_product:function(){
        jQuery('.conditions-tab li').click(function(){
            var tab_select = jQuery(this).attr('data');
            jQuery('.conditions-tab li').removeClass('selected');
            jQuery(this).addClass('selected');
            jQuery('.content-tab .item-tab').removeClass('act');
            jQuery('.content-tab .item-tab.'+tab_select).addClass('act');
        });
    },
}