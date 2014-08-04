module.exports = function(grunt) {
	grunt.loadNpmTasks('grunt-contrib-clean');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-copy');
	grunt.loadNpmTasks('grunt-contrib-imagemin');
	grunt.loadNpmTasks('grunt-contrib-less');
	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-manifest');
	grunt.loadNpmTasks('grunt-shell');

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
						src:    [ 'bootstrap/*', 'vendor/**', 'public/**', '!public/packages/**' ],
						dest:   'build/'
					},
					{
						expand: true,
						src:    [ 'app/**', '!app/{assets,commands,config,database,storage,tests}/**' ],
						dest:   'build/'
					},
					{
						expand: true,
						src:    [ 'app/config/**', '!app/config/{dev,staging,testing}/**' ],
						dest:   'build/'
					},
					{
						expand: true,
						src:    [ 'app/storage/*' ],
						dest:   'build/',
						filter: 'isDirectory'
					}
				]
			},
			deploy: {
				files: [
					{
						expand: true,
						cwd:    'build',
						src:    [ '**/*' ],
						dest:   '../8.klubitus.org'
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

		manifest: {
			generate: {
				options: {
					basePath: 'build/public',
					network:  [ '*', 'http://*', 'https://*']
				},
				src:  [ 'assets/**/*.{min.js,css,gif,png,jpg}' ],
				dest: 'build/public/manifest.appcache'
			}
		},

		shell: {
			chown: {
				command: 'sudo chgrp -R apache ../8.klubitus.org/app/storage/*'
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

	grunt.registerTask('js', [ 'concat', 'uglify' ]);
	grunt.registerTask('css', [ 'less' ]);
	grunt.registerTask('prebuild', [ 'clean', 'css', 'js' ]);
	grunt.registerTask('postbuild', [ 'manifest', 'imagemin' ]);
	grunt.registerTask('build', [ 'prebuild', 'copy:build', 'postbuild' ]);
	grunt.registerTask('deploy', [ 'build', 'copy:deploy' ]);
	grunt.registerTask('default', [ 'js', 'css' ]);
};
