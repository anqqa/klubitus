module.exports = function(grunt) {
	grunt.loadNpmTasks('grunt-contrib-clean');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-copy');
	grunt.loadNpmTasks('grunt-contrib-less');
	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-watch');

	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

		clean: {
			build: [ 'build' ]
		},

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
				dest: 'public/assets/js/vendor.js'
			},
			klubitus: {
				src: [
					'app/assets/js/klubitus.js',
					'app/assets/js/jquery.googlemap.js',
					'app/assets/js/jquery.dialogify.js',
					'app/assets/js/jquery.ajaxify.js',
					'app/assets/js/jquery.autocomplete.event.js',
					'app/assets/js/jquery.autocomplete.geo.js',
					'app/assets/js/jquery.autocomplete.user.js',
					'app/assets/js/jquery.autocomplete.venue.js',
					'app/assets/js/jquery.notes.js'
				],
				dest: 'public/assets/js/klubitus.js'
			}
		},

		copy: {
			build: {
				files: [
					{
						expand: true,
						src:    [ 'bootstrap/*', 'public/**' ],
						dest:   'build/'
					},
					{
						expand: true,
						src:    [ 'app/**', '!app/{assets,commands,config,database,tests}/**' ],
						dest:   'build/'
					},
					{
						expand: true,
						src:    [ 'app/config/**', '!app/config/{dev,staging,testing}/**' ],
						dest:   'build/'
					}
				]
			}
		},

		imagemin: {
			dist: {
				options: {
					optimizationLevel: 3
				},
				files: [
					{
						expand: true,
						cwd:    'build/public',
						src:    [ '**/*.{jpg,png}' ],
						dest:   'build/public'
					}
				]
			}
		},

		jshint: {
			anqh: [ 'app/assets/js/*.js' ]
		},

		less: {
			options: {
				cleancss: true,
				report:   'min'
			},
			anqh: {
				files: { 'public/assets/css/klubitus.css': 'app/assets/less/klubitus.less' }
			}
		},

		uglify: {
			options: {
				mangle: false
			},
			vendor: {
				files: { 'public/assets/js/vendor.min.js': 'public/assets/js/vendor.js' }
			},
			anqh: {
				files: { 'public/assets/js/klubitus.min.js': 'public/assets/js/klubitus.js' }
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

	grunt.registerTask('prebuild', [ 'clean', 'css', 'js' ]);
	grunt.registerTask('postbuild', [ 'imagemin' ]);
	grunt.registerTask('build', [ 'prebuild', 'copy:build', 'postbuild' ]);
	grunt.registerTaks('deploy', [ 'build' ]);
	grunt.registerTask('js', [ 'concat', 'uglify' ]);
	grunt.registerTask('css', [ 'less' ]);
	grunt.registerTask('default', [ 'js', 'css' ]);
};
