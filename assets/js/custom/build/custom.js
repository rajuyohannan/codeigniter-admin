$(function () {

	$("[data-toggle=tooltip]").tooltip();
	
	var actionUrl = "";
	$('#Modal').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget);
		var modal = $(this);
		
		modal.removeClass();
		modal.addClass('modal fade ' + button.data('class'));
		modal.find('.modal-title').text(button.data('title'));
		modal.find('.modal-body').text(button.data('body'));

		modal.find('.modal-footer button:last-child').text(button.data('button'));
		actionUrl = button.data('action');
	});

	$("#modal-submit").on('click', function(event){
		//@TODO AJAX request
		window.location = actionUrl;
	});
});

$(function () {
	
	var dates = [];

	for (var i = 0; i <= 7; i++) {
		var currentDate = new Date();
		currentDate.setDate(currentDate.getDate() + i);
		dates.push(currentDate);
	}
	
	$('#datetimepicker-scheduled').datetimepicker({
		daysOfWeekDisabled: [0],
		format: 'MM/DD/YYYY HH:mm',
		enabledDates: dates,
	});

});
$(function () {
	$('.emoji-show').click(function(){
		var EmojiList = $(this).parents('.form-group').find('.emoji-list');
		if (EmojiList.is(":visible")) {
			EmojiList.addClass('hidden');
		}
		else {
			EmojiList.removeClass('hidden');
		}
	});
});
   (function (){

      $(".upload").mouseover(function() { 
         $(".upload__link").removeClass('hidden');
      }).mouseout(function() { 
         $(".upload__link").addClass('hidden'); 
      }); 


      









   /* Profile photo upload */
   var form = document.forms.userpic;
      if (form && typeof form !== undefined) {
      var input = form.photo;
      var preview = document.getElementById('preview');

      var previewOpts = {
           width:  128
         , height: 128
      };

      var uploadOpts = {
      url: baseurl + 'profile/upload' 
      , data: {} 
      , name: 'userpic' 
      , activeClassName: 'upload_active' 
      };

      var _onSelectFile = function (evt/**Event*/){
      var file = FileAPI.getFiles(evt)[0];

      if( file ){
      _createPreview(file);
      _uploadFile(file);
      }
      };

      var _createPreview = function (file/**File*/){
         FileAPI.Image(file)
         .preview(previewOpts.width, previewOpts.height)
         .get(function (err, image){
            if( !err ){
               preview.innerHTML = '';
               $(".widget-user-image img").remove();
               preview.appendChild(image);
            }
         });
      };

      var _uploadFile = function (file){
      var opts = FileAPI.extend(uploadOpts, {
         files: {},

      upload: function (){
         form.className += ' '+uploadOpts.activeClassName;
      },

      complete: function (err, xhr){
         form.className = (' '+form.className+' ').replace(' '+uploadOpts.activeClassName+' ', ' ');

         if( err ){
            alert('An error occured, please try again later.');
         } else {
      }
      }
      });

      opts.files[opts.name] = file;

      FileAPI.upload(opts);
      };

      FileAPI.event.on(input, "change", _onSelectFile);
    }

   })();
$(function () {

  /**
   * Sortable Jquery UI
   */
  
  	/* Fix for the table sorting */
	 var fixHelperModified = function(e, tr) {
	    var $originals = tr.children();
	    var $helper = tr.clone();
	    $helper.children().each(function(index)
	    {
	      $(this).width($originals.eq(index).width())
	    });
	    return $helper;
	};

	$("#sortable").sortable({
	    helper: fixHelperModified,
	    update: function( event, ui ) {
	    	console.log(ui);
	    }
	}).disableSelection();

});
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
$(function () {
	$('#description').wysihtml5({
		toolbar: {
			"font-styles": false,
			"image": false
		}	
	});
});