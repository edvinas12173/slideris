module.exports = function(grunt) {
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		sass: {
			dist: {
                options: {
                    style: 'compressed'
                },
				files: {
					'assets/css/styles.css' : 'assets/css/styles.scss'
				}
			}
		},
		watch: {
			css: {
				files: '**/**/*.scss',
				tasks: ['sass']
			}
		}
	});
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.registerTask('default',['watch']);
}
