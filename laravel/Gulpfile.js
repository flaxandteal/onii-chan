var gulp = require('gulp');
var sass = require('gulp-ruby-sass');
var autoprefixer = require('gulp-autoprefixer');
var gutil = require('gulp-util');

gulp.task('css', function() {
  gulp.src('app/assets/sass/**/*.s*ss')
    .pipe(sass()).on('error', gutil.log)
    .pipe(autoprefixer('last 10 versions'))
    .pipe(gulp.dest('public/css'));
});

gulp.task('watch', function() {
  gulp.watch('app/assets/sass/**/*.s*ss', ['css'])
});

gulp.task('default', ['watch']);

