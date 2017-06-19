'use strict';

const gulp = require('gulp'),
    concat = require('gulp-concat'),
    sass = require('gulp-sass');

gulp.task('default', ['sass', 'js']);

gulp.task('js', function () {
    return gulp.src('./resources/js/**/*.js')
        .pipe(concat('bundle.js'))
        .pipe(gulp.dest('./web/bundles'));
});

gulp.task('sass', function () {
    return gulp.src('./resources/sass/**/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('./web/bundles'));
});

gulp.task('watch', function () {
    gulp.watch('./resources/sass/**/*.scss', ['sass']);
    gulp.watch('./resources/js/**/*.js', ['js']);
});