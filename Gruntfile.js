module.exports = function(grunt) {

// 1. All configuration goes here 
grunt.initConfig({
  pkg: grunt.file.readJSON('package.json'),

  concat: {
    js: {
      files: [
      { 
        src: [
        'bower_components/jquery/dist/jquery.js', 
        'bower_components/jquery/jquery.js', 
        'bower_components/bootstrap/dist/js/bootstrap.js', 
        'bower_components/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.all.js', 
        'bower_components/iCheck/icheck.js',
        'bower_components/AdminLTE/dist/js/app.js',
        'bower_components/jquery-ui/jquery-ui.js',
        'bower_components/fileapi/dist/FileAPI.js',
        'bower_components/moment/moment.js',
        'bower_components/eonasdan-bootstrap-datetimepicker/src/js/bootstrap-datetimepicker.js',
        ], 
        dest: 'assets/js/vendor/vendor.js' 
      },
      {
        src: [
        'assets/js/custom/*.js'
        ],
        dest: 'assets/js/custom/build/custom.js'
      },
      ],
    },
    css: {
      files: [
      { 
        src: [
        'bower_components/bootstrap/dist/css/bootstrap.css', 
        'bower_components/font-awesome/css/font-awesome.css',
        'bower_components/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.css', 
        'bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css',
        'bower_components/iCheck/skins/square/square.css',
        'bower_components/iCheck/skins/square/green.css',
        'bower_components/iCheck/skins/square/aero.css',
        'bower_components/iCheck/skins/square/grey.css',
        'bower_components/iCheck/skins/square/orange.css',
        'bower_components/iCheck/skins/square/pink.css',
        'bower_components/iCheck/skins/square/purple.css',
        'bower_components/iCheck/skins/square/red.css',
        'bower_components/iCheck/skins/square/yellow.css',
        'bower_components/iCheck/skins/square/blue.css',
        'bower_components/AdminLTE/dist/css/AdminLTE.css',
        'bower_components/AdminLTE/dist/css/skins/_all-skins.css',
        ], 
        dest: 'assets/css/vendor/vendor.css' 
      },
      {
        src: [
        'assets/css/custom/*.css'
        ],
        dest: 'assets/css/custom/build/custom.css'
      },
      ],
    },
  },
  uglify: {
    build: {
      files: [
      {	
        src: [
        'assets/js/vendor/vendor.js'
        ],
        dest: 'assets/js/vendor/vendor.min.js'
      },
      {
        src: [
        'assets/js/custom/build/custom.js'
        ],
        dest: 'assets/js/custom/build/custom.min.js'
      }
      ],
    },
  },
  cssmin: {
    options: {
      shorthandCompacting: false,
      roundingPrecision: -1,
      keepSpecialComments: 0
    },
    target: {
      files: [
      {
        'assets/css/vendor.min.css': ['assets/css/vendor/vendor.css']
      },
      {
        'assets/css/custom.min.css': ['assets/css/custom/build/custom.css']
      },
      ]
    }
  },
  copy: {
    images: {
      files: [
      {
        expand: true,
        flatten: true,
        src: 'bower_components/AdminLTE/dist/img/*',
        dest: 'assets/images/'

      },
      {
        expand: true,
        flatten: true,
        src: 'bower_components/iCheck/skins/square/*.png',
        dest: 'assets/css/'

      },
      ]
    },
    fonts: {
      files: [
      {
        expand: true,
        flatten: true,
        src: 'bower_components/font-awesome/fonts/*',
        dest: 'assets/fonts/'

      },
      {
        expand: true,
        flatten: true,
        src: 'bower_components/bootstrap/dist/fonts/*',
        dest: 'assets/fonts/'

      },
      ]
    },
    fileAPI: {
      files: [
      {
        expand: true,
        cwd:  'bower_components/fileapi/dist',
        src: ['**'],
        dest: 'assets/plugins/fileapi'

      },
      ]
    },
    emojiOne: {
      files: [
      {
        expand: true,
        cwd:  'bower_components/emojione/assets/png',
        src: ['**'],
        dest: 'assets/plugins/emojione'

      },
      ]
    }
  }

});

// 3. Where we tell Grunt we plan to use this plug-in.
grunt.loadNpmTasks('grunt-contrib-concat');
grunt.loadNpmTasks('grunt-contrib-uglify');
grunt.loadNpmTasks('grunt-contrib-cssmin');
grunt.loadNpmTasks('grunt-contrib-copy');

// 4. Where we tell Grunt what to do when we type "grunt" into the terminal.
grunt.registerTask('default', ['concat', 'uglify', 'cssmin', 'copy']);

};