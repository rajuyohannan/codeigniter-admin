   (function (){

      $(".upload").mouseover(function() { 
         $(".upload__link").removeClass('hidden');
      }).mouseout(function() { 
         $(".upload__link").addClass('hidden'); 
      }); 
      
   var form = document.forms.userpic;
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
   })();