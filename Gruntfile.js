var path = require('path');

module.exports = function (grunt) {

	var file = grunt.file;
	var task = grunt.task;
	var pathname = path.basename(__dirname);
	
    grunt.initConfig({

        // 对页面进行清理
        clean: {
            doc: {
                src: 'doc/*'
			}
        },

		// 拷贝文件
		copy : {
			main: {
				files:[
					{
						expand:true,
						cwd:'src/',
						src: ['**/*','!**/*.md','!**/*.markdown'], 
						dest: 'doc/', 
						filter: 'isFile'
					}
				]
			}
		},
		markdown: {
			api: {
				files: [
					{
						expand: true,
						cwd:'src/api',
						src: '**/*.md',
						dest: 'doc/api/',
						ext: '.html'
					}
				],
				options:{
					template:'src/api/assets/template.jst',
					templateContex:{},
					markdownOptions:{
						gfm:false
					}
				}

			},
			guide: {
				files: [
					{
						expand: true,
						cwd:'src/',
						src: ['**/*.md','!api/**/*'],
						dest: 'doc/',
						ext: '.html'
					}
				],
				options:{
					template:'src/templates/index.jst',
					templateContex:{},
					markdownOptions:{
						gfm:false
					}
				}

			}
		},
        watch: {
            'all': {
                files: [ 'src/**/*.md' ,'src/**/*.js','src/**/*.css','src/**/*.jst'],
                tasks: [ 'clean:doc', 'copy','markdown' ]
            }
        }

		// 合并文件
		/*
		concat: {
			dist: {
				src: ['from.css'],
				dest: 'build/to.css'
		
			}
		},
		*/

    });

	// ======================= 载入使用到的通过NPM安装的模块 ==========================
	
    grunt.loadNpmTasks('grunt-contrib-clean');
	grunt.loadNpmTasks('grunt-contrib-copy');
	grunt.loadNpmTasks('grunt-markdown');
    grunt.loadNpmTasks('grunt-contrib-watch');

	grunt.registerTask('listen', 'clam watch ...', function() {
		task.run('watch');
	});

	grunt.registerTask('default', ['clean:doc', 'copy', 'markdown']);

};
