var gulp = require('gulp');
var webserver = require('gulp-webserver');

gulp.task('webserver', function() {
    gulp.src('.')
        .pipe(webserver({
            host: 'localhost',
            port: '8000',
            livereload: true,
            directoryListing: false
        }));
});

gulp.task('default', ['webserver']);