module.exports = function(grunt) {
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-less');
	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-watch');

	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

		concat: {
			options: {
				separator: ';'
			},
			vendor: {
				src: [
					'app/assets/js/vendor/jquery.markitup.js',
					'app/assets/js/vendor/markitup.bbcode.js',
					'app/assets/js/vendor/jquery.cookie.js'
				],
				dest: 'public/assets/js/c/vendor.js'
			},
			klubitus: {
				src: [
					'app/assets/js/klubitus/klubitus.js',
					'app/assets/js/klubitus/jquery.form.js',
					'app/assets/js/klubitus/jquery.googlemap.js',
					'app/assets/js/klubitus/jquery.dialogify.js',
					'app/assets/js/klubitus/jquery.ajaxify.js',
					'app/assets/js/klubitus/jquery.autocomplete.event.js',
					'app/assets/js/klubitus/jquery.autocomplete.geo.js',
					'app/assets/js/klubitus/jquery.autocomplete.user.js',
					'app/assets/js/klubitus/jquery.autocomplete.venue.js',
					'app/assets/js/klubitus/jquery.notes.js'
				],
				dest: 'public/assets/js/c/klubitus.js'
			}
		},

		jshint: {
			anqh: [ 'app/assets/js/klubitus/*.js' ]
		},

		less: {
			options: {
				cleancss: true,
				report:   'min'
			},
			anqh: {
				files: {
					'public/assets/css/klubitus.css': 'app/assets/less/klubitus.less'
				}
			}
		},

		uglify: {
			options: {
				mangle: false
			},
			vendor: {
				files: {
					'public/assets/js/c/vendor.min.js': 'public/assets/js/c/vendor.js'
				}
			},
			anqh: {
				files: {
					'public/assets/js/c/klubitus.min.js': 'public/assets/js/c/klubitus.js'
				}
			}
		},

		watch: {
			css: {
				files: [ 'app/assets/less/*.less' ],
				tasks: [ 'less' ]
			},
			js: {
				files: [ '<%= concat.vendor.src %>', '<%= concat.klubitus.src %>' ],
				tasks: [ 'js' ]
			}
		}

	});

	grunt.registerTask('js', [ 'concat', 'uglify' ]);
	grunt.registerTask('css', [ 'less' ]);
	grunt.registerTask('default', [ 'js', 'css' ]);
};
