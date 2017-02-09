module.exports = function(grunt) {
	grunt.initConfig({
		bower_concat: {
			basic: {
				dest: {
					js: 'bower_components/_tmp/bowercomp.js',
					css: 'bower_components/_tmp/bowercomp.css'
				}
			}
		},
		copy: {
		  main: {
		    files: [
				{
					expand: true,
					cwd: 'bower_components/materialize/fonts/',
					src: '**',
					dest: 'public_html/assets/fonts/',
				},
				{
					expand: true,
					cwd: 'bower_components/font-awesome/fonts/',
					src: '**',
					dest: 'public_html/assets/fonts/',
				},
				{
					expand: true,
					cwd: 'bower_components/trumbowyg/dist/ui/',
					src: '**',
					dest: 'public_html/assets/components/ui/',
				}
		    ],
		  },
		},
		concat: {
		    dist: {
		      files: [
		        {src: ['bower_components/_tmp/bowercomp.js', 'src/js/lib.js', 'src/js/*.js', '!src/js/init.js', 'src/js/init.js'], dest: 'public_html/assets/components/data.js'},
				{src: ['bower_components/_tmp/bowercomp.css', 'bower_components/trumbowyg/dist/ui/trumbowyg.min.css', 'src/css/*.css', 'src/css/main.css'], dest: 'public_html/assets/components/data.css'}
		      ],
		    },
		},
		clean: ['bower_components/_tmp/bowercomp.js', 'bower_components/_tmp/bowercomp.css'],
		uglify: {
			options: {
			  mangle: false,
			  preserveComments: 'some'
			},
			my_target: {
			  files: {
			    'public_html/assets/components/data.js': ['public_html/assets/components/data.js']
			  }
			}
		},
		cssmin: {
		  options: {
		    shorthandCompacting: false,
		    roundingPrecision: -1
		  },
		  target: {
		    files: {
		      'public_html/assets/components/data.css': ['public_html/assets/components/data.css']
		    }
		  }
	  	},
		watch: {
		    scripts: {
		        files: ['src/js/*.js', 'src/css/*.css'],
		        tasks: ['dev-watcher'],
		        options: {
		            interrupt: true
		        }
		    }
		}
	});
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-clean');
	grunt.loadNpmTasks('grunt-bower-concat');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-copy');
	grunt.registerTask('default', ['bower_concat', 'concat', 'copy', 'uglify', 'cssmin', 'clean']);
	grunt.registerTask('prep', ['bower_concat', 'concat', 'copy']);
	grunt.registerTask('dev-watcher', ['concat']);
};
