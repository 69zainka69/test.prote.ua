'use strict';

var gulp = require('gulp');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');

sass.compiler = require('node-sass');

gulp.task('sass', function () {
  return gulp.src('./catalog/view/theme/default/stylesheet/*.sass')
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest('./catalog/view/theme/default/stylesheet'));
});

gulp.task('sass:watch', function () {
  gulp.watch('./catalog/view/theme/default/stylesheet/*.sass', gulp.series('sass'));
})

gulp.task('prefix', function () {
  return gulp.src('./catalog/view/theme/default/stylesheet/theme.css')
      .pipe(autoprefixer())
      .pipe(gulp.dest('./catalog/view/theme/default/stylesheet'));
});