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
                     url: baseurl + 'files/upload',
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

                        if (!err) {
                           var idsVal = $("[name=fileIds]").val();
                           var response = xhr.responseText;
                           idsVal += response + ',';
                           $("[name=fileIds]").val(idsVal);

                        }

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