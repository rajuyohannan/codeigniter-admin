autosize(document.querySelectorAll('textarea'));
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


	$("#dob").datetimepicker({
		format: 'MM/DD/YYYY',
		maxDate: new Date(new Date().setYear(new Date().getFullYear() - 20)),
	});


});
(function (){
	$('#selfestimated').on('ifChecked', function(event){
	    $(".estimationRef").hide();
	    $(".add-more_container, p.addmore").removeClass("hidden");
	}).on('ifUnchecked', function(event){
	    $(".estimationRef").show(); 
	    $(".add-more_container").addClass("add-more_container hidden");
	   	$("p.addmore").addClass("addmore hidden text-right");

	    //Remove all added element from dom
	    $(".add-more_container").nextAll('div.row').remove();
	});

	$(".addmore a").on("click", function(e){
	  e.preventDefault();
	  var elementToAdd = $(".add-more_container .row:first").html();
	  var newElement   = $('<div />', {"class": 'row'}).html(elementToAdd);
	  $(".add-more_container").after(newElement);
	});


	$("#existingclient").on('ifChecked', function(event){
		console.log("Checked");
		$(".newClientBlock").hide();
		$(".existingClientBlock").removeClass('hidden');
	}).on('ifUnchecked', function(event){
		console.log("Unchecked");
		$(".newClientBlock").show();
		$(".existingClientBlock").addClass('existingClientBlock hidden');
	});

})();
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


      

      $('input[type="file"]').on('change', function (evt){
         var files = FileAPI.getFiles(evt);
         onFiles(files);
         FileAPI.reset(evt.currentTarget);
      });

         var FU = {
            icon: {
                 def:   '//cdn1.iconfinder.com/data/icons/CrystalClear/32x32/mimetypes/unknown.png'
               , image: '//cdn1.iconfinder.com/data/icons/humano2/32x32/apps/synfig_icon.png'
               , audio: '//cdn1.iconfinder.com/data/icons/august/PNG/Music.png'
               , video: '//cdn1.iconfinder.com/data/icons/df_On_Stage_Icon_Set/128/Video.png'
            },

            files: [],
            index: 0,
            active: false,

            add: function (file){
               FU.files.push(file);

               if( /^image/.test(file.type) ){
                  FileAPI.Image(file).preview(35).rotate('auto').get(function (err, img){
                     if( !err ){
                        FU._getEl(file, '.js-left')
                           .addClass('b-file__left_border')
                           .html(img)
                        ;
                     }
                  });
               }
            },

            getFileById: function (id){
               var i = FU.files.length;
               while( i-- ){
                  if( FileAPI.uid(FU.files[i]) == id ){
                     return   FU.files[i];
                  }
               }
            },

            showLayer: function (id){
               var $Layer = $('#layer-'+id), file = this.getFileById(id);

               if( !$Layer[0] ){
                  $Layer = $('<div/>').appendTo('body').attr('id', 'layer-'+id);
               }

               $Layer.css('top', $(window).scrollTop() + 30);

               FileAPI.getInfo(file, function (err, info){
                  $Layer
                     .click(function (){ $(document).click(); })
                     .html(tmpl($('#b-layer-ejs').html(), {
                          file: file
                        , info: $.extend(err ? {} : info, { size: (file.size/1024).toFixed(3) + ' KB' })
                     }))
                  ;

                  if( /image/i.test(file.type) ){
                     if( err ){
                        $Layer.find('.js-img').html('Ooops.');
                     }
                     else {
                        FileAPI.Image(file).preview(300).get(function (err, img){
                           $Layer.find('.js-img').append(img);
                        });
                     }
                  } else {
                     $Layer.find('.js-img').remove();
                  }

                  $(document).off('click.layer keyup.layer').one('click.layer keyup.layer', function (evt){
                     $Layer.remove();
                  });
               });
            },

            start: function (){
               if( !FU.active && (FU.active = FU.files.length > FU.index) ){
                  FU._upload(FU.files[FU.index]);
               }
            },

            abort: function (id){
               var file = this.getFileById(id);
               if( file.xhr ){
                  file.xhr.abort();
               }
            },

            _getEl: function (file, sel){
               var $el = $('#file-'+FileAPI.uid(file));
               return   sel ? $el.find(sel) : $el;
            },

            _upload: function (file){
               if( file ){
                  file.xhr = FileAPI.upload({
                     url: '/upload',
                     files: { file: file },
                     upload: function (){
                        FU._getEl(file).addClass('b-file_upload');
                        FU._getEl(file, '.js-progress')
                           .css({ opacity: 0 }).show()
                           .animate({ opacity: 1 }, 100)
                        ;
                     },
                     progress: function (evt){
                        FU._getEl(file, '.js-bar').css('width', evt.loaded/evt.total*100+'%');
                     },
                     complete: function (err, xhr){
                        var state = err ? 'error' : 'done';

                        FU._getEl(file).removeClass('b-file_upload');
                        FU._getEl(file, '.js-progress').animate({ opacity: 0 }, 200, function (){ $(this).hide() });
                        FU._getEl(file, '.js-info').append(', <b class="b-file__'+state+'">'+(err ? (xhr.statusText || err) : state)+'</b>');

                        FU.index++;
                        FU.active = false;

                        FU.start();
                     }
                  });
               }
            }
         };

         function onFiles(files){
            var $Queue = $('<div/>').prependTo('#preview');

            FileAPI.each(files, function (file){
               if( file.size >= 25*FileAPI.MB ){
                  alert('Sorrow.\nMax size 25MB')
               }
               else if( file.size === void 0 ){
                  $('#oooops').show();
                  $('#buttons-panel').hide();
               }
               else {
                  $Queue.append(tmpl($('#b-file-ejs').html(), { file: file, icon: FU.icon }));

                  FU.add(file);
                  FU.start();
               }
            });
         }





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

	var hash = window.location.hash;

	if (hash) {
		$('a[href="' + hash + '"]').tab('show');
		$("html, body").animate({ scrollTop: 0 }, "slow");
	}
	
 	$("#contact").inputmask("mask", {"mask": "(999) 999-9999"});
 	$("#name").inputmask("mask", {"mask": "a{5,25} a{5,25} a{5,25}"});

});
$(function () {

    $("#skills").select2({
    	tags: true
    });

    $("#estimation").select2();

    $("#assignTo").select2({
      ajax: {
        url: baseurl + 'user/get',
        dataType: 'json',
        delay: 250,
        data: function (params) {
          return {
            q: params.term, 
          };
        },
        processResults: function (data, page) {
          return {
            results: data
          };
        },
        cache: true
      },
      escapeMarkup: function (markup) { return markup; }, 
      minimumInputLength: 1,
      templateResult: formatRepo, 
      templateSelection: formatRepoSelection 
    });


    $(".categoriesSelect").on("change", function(e){
      this.form.submit();
    });

});


 function formatRepo (user) {
    if (user.loading) return user.text;

    var markup = '<div class="clearfix">' +
    '<div class="col-sm-1">' +
    '<img src="' + 'http://localhost/codeigniter-admin/assets/images/default-male.jpg' + '" style="max-width: 100%" />' +
    '</div>' +
    '<div clas="col-sm-11">' + user.name + '</div>' +
    '</div>';

    return markup;
  }

  function formatRepoSelection (user) {
    return user.name || user.text;
  }
// Simple JavaScript Templating
// John Resig - http://ejohn.org/ - MIT Licensed
(function (){
	var cache = {};

	this.tmpl = function tmpl(str, data){
		// Figure out if we're getting a template, or if we need to
		// load the template - and be sure to cache the result.
		var fn = !/\W/.test(str) ?
				cache[str] = cache[str] ||
						tmpl(document.getElementById(str).innerHTML) :

			// Generate a reusable function that will serve as a template
			// generator (and which will be cached).
				new Function("obj",
						"var p=[],print=function(){p.push.apply(p,arguments);};" +

							// Introduce the data as local variables using with(){}
								"with(obj){p.push('" +

							// Convert the template into pure JavaScript
								str
										.replace(/[\r\t\n]/g, " ")
										.split("<%").join("\t")
										.replace(/((^|%>)[^\t]*)'/g, "$1\r")
										.replace(/\t=(.*?)%>/g, "',$1,'")
										.split("\t").join("');")
										.split("%>").join("p.push('")
										.split("\r").join("\\'")
								+ "');}return p.join('');");

		// Provide some basic currying to the user
		return data ? fn(data) : fn;
	};
})();
$(function () {
	$('#description').wysihtml5({
		toolbar: {
			"font-styles": false,
			"image": false
		}	
	});
});