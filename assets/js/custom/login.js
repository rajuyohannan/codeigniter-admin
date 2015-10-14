$(function () {
	$('input').iCheck({
  		checkboxClass: 'icheckbox_square-grey',
  		radioClass: 'iradio_square-grey',
  		increaseArea: '10%' // optional
	});


	var url = window.location.pathname, 
	urlRegExp = new RegExp(url.replace(/\/$/,'') + "$"); 
	$('.sidebar-menu a').each(function(){
	    if(urlRegExp.test(this.href.replace(/\/$/,''))){
	        $(this).parents('li').addClass('active');
	    }
	});

	var hash = window.location.hash;

	if (hash) {
		$('a[href="' + hash + '"]').tab('show');
		$("html, body").animate({ scrollTop: 0 }, "slow");
	}
	
});