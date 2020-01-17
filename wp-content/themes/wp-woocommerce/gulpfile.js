/* Nome da pasta para o BrowserSync */
const folderName = 'wp-woocommerce';

// Adiciona os modulos instalados
const gulp = require('gulp');
const sass = require('gulp-sass');
const autoprefixer = require('gulp-autoprefixer');
const notify = require('gulp-notify');
const concat = require('gulp-concat');
const babel = require('gulp-babel');
const uglify = require('gulp-uglify');
const browserSync = require('browser-sync').create();
const del = require('del');

// Deletar cache
function cleanCacheCss() {
	del('./dist/css/style.css')
}

function cleanCacheJs() {
	del('./dist/js/app.js')
}


//Função para compilar o SASS e adicionar os prefixos
function buildScss() {
  return gulp
  .src('./src/scss/style.scss').pipe(autoprefixer({cascade: false}))
  .pipe(sass({outputStyle: 'compressed'}))
  .on('error', notify.onError({title: "erro scss", message: "<%= error.message %>"}))
  .pipe(gulp.dest('./dist/css/'))
  .pipe(browserSync.stream());
}
gulp.task('sass', function(done){
	cleanCacheCss();
	buildScss();
  done();
});

// Pega os plugins necessarios de scss para o projeto e cria dentro da pasta src para utilização
function buildFrameworksCSS() {
  return gulp.src(['node_modules/bootstrap/scss/**',])
  .pipe(gulp.dest('./src/scss/bootstrap/'))
  .pipe(browserSync.stream());
}
gulp.task('buildFrameworksCSS', buildFrameworksCSS)


// Builda o Javascript exclusivo da aplicação
function buildJs() {
  return gulp.src('./src/js/*.js')
  .pipe(babel({presets: ['@babel/env'] }))
  .pipe(uglify())
  .on('error', notify.onError({title: "erro scss", message: "<%= error.message %>"}))
  .pipe(gulp.dest('./dist/js/'))
  .pipe(browserSync.stream());
}
gulp.task('appjs', function(done){
	cleanCacheJs();
	buildJs();
    done();
});


// Pega os plugins necessarios de JavaScript para o projeto e concatena em um unico arquivo.
function buildFrameworksJS() {
  return gulp.src([
		'node_modules/jquery/dist/jquery.min.js',
		'node_modules/jquery-mask-plugin/dist/jquery.mask.min.js',
		'node_modules/popper.js/dist/umd/popper.js',
    'node_modules/bootstrap/dist/js/bootstrap.min.js'
  ])
  .pipe(concat('main.js'))
  .pipe(uglify())
  .pipe(gulp.dest('./dist/js/'))
  .pipe(browserSync.stream());
}
gulp.task('buildFrameworksJS', buildFrameworksJS)


//Move o conteudo de webfonts para dist/fonts 
function buildFonts() {
  return gulp.src(['node_modules/@fortawesome/fontawesome-free/webfonts/**',])
  .pipe(gulp.dest('./dist/fonts/'))
}
gulp.task('buildFonts', buildFonts)


// Função para iniciar o browser
function browser() {
  browserSync.init({
    proxy: `localhost/${folderName}`
  })
}
// Tarefa para iniciar o browser-sync
gulp.task('browser-sync', browser);


// Função de watch do Gulp
function watch() {
  gulp.watch('./src/scss/**/*.scss', buildScss);
  gulp.watch('./src/js/**/*.js', buildJs);
  gulp.watch([ './**/*.php']).on('change', browserSync.reload);
}
// Inicia a tarefa de Watch
gulp.task('watch', watch);

//Tarefa padrão do Gulp, que inicia o Watch e o Browser-sync // Aqui são os nomes que ficam nas tarefas
gulp.task('default', gulp.parallel('watch', 'browser-sync', 'sass', 'appjs')); 

gulp.task('build-start', gulp.parallel('buildFrameworksJS', 'buildFrameworksCSS', 'buildFonts')); 


/* Como utilizar 
1 - $ npm install
2 - $ gulp buildFrameworksCSS
3 - $ gulp buildFrameworksJS
4 - $ gulp
*/