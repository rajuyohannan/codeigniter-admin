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

	var hash = window.location.hash.substring(1);

	if (hash) {
		$('a[href="#password"]').tab('show')	
	}

	

});