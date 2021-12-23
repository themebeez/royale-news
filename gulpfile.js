
// gulp file to generate Royale news WP POT, compile assets & zip Production files

const gulp = require('gulp');
const zip = require('gulp-zip');
const wpPot = require('gulp-wp-pot');
const sourcemaps = require('gulp-sourcemaps');
const sass = require('gulp-sass')(require('sass'));
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const cssnano = require('cssnano');
const replace = require('gulp-replace');
const notify = require('gulp-notify');
const plumber = require('gulp-plumber');
const rtlcss = require('gulp-rtlcss');
const rename = require('gulp-rename');
const shell = require('gulp-shell');

/*
*
# npm update
# npm init
# npm install gulp@4.0.2 gulp-zip gulp-wp-pot gulp-sourcemaps gulp-sass gulp-concat gulp-uglify gulp-postcss autoprefixer cssnano gulp-replace gulp-notify gulp-plumber gulp-rtlcss gulp-rename gulp-shell -g
# npm install gulp@4.0.2 gulp-zip gulp-wp-pot gulp-sourcemaps gulp-sass gulp-concat gulp-uglify gulp-postcss autoprefixer cssnano gulp-replace gulp-notify gulp-plumber gulp-rtlcss gulp-rename gulp-shell --save-dev
*
*/


/*
####################
=
= Var 1: varibales to ZIP production files
=
####################
*/

// #1.1 project name 

const output_filename = 'royale-news.zip';

// #1.2 files & folders to zip
const files_folders = {

    filefolders_src: [

        './*',
        './*/**',

        '!./node_modules/**',
        '!./assets/src/**',
        '!./gulpfile.js',
        '!./.gitignore',
        '!./package.json',
        '!./package-lock.json',
        '!./composer.json',
        '!./composer.lock',
        '!./README.md',
        '!./sftp-config.json'
    ],

    production_zip_file_path: "./",
}

/*
####################
=
= Var 2: varibales to make WP POT file
=
####################
*/

// #2.1 path of php files to generate WordPress POT file

const php_files = {

    php_files_path: [

        './**/*.php',
        '!./themebeez/third-party/class-tgm-plugin-activation.php'
    ],
}

// #2.2 project text domain

const project_name = 'Royale News';
const project_text_domain = 'royale-news';

/*
####################
=
= Var 3: varibales for royaleNews static resources 
=
####################
*/

// #3.1 Script files path
const royaleNewsScriptsPath = {

    royaleNews_scripts_path: [

        './assets/src/js/plugins/*.js',
        './assets/src/js/vendor/*.js',
        './assets/src/js/custom/*.js'
    ],

    royaleNews_script_dist: "./assets/dist/js/",
}
const royaleNews_build_js_file_name = "bundle.js"; // what would you like to name your minified bundled js file


// #3.2 Conditional scripts
const royaleNewsConditionalScriptsPath = {

    royaleNews_con_scripts_src: [

        './assets/src/js/conditional/*/**.js',
    ],

    royaleNews_con_scripts_dist: "./assets/dist/js/conditional/",
}


// #3.3 SASS/SCSS file path
const royaleNewsSassPath = {

    royaleNews_sass_src: ["./assets/src/scss/**/*.scss", "!./assets/src/scss/conditional/**"],
    royaleNews_sass_dist: "./assets/dist/css/",
}
const royaleNews_compiled_sass_css_file_name = "main.css"; // what would you like to name your compiled CSS file


// #3.4 Conditional SASS/SCSS file path 
const royaleNewsConditionalSassPath = {

    royaleNews_cond_sass_src: "./assets/src/scss/conditional/**/*.scss",
    royaleNews_cond_sass_dist: "./assets/dist/css/conditional/",
}

// #3.5 LTR & RTL CSS path
const royaleNewsRtlCssPath = {

    royaleNews_rtlcss_src: "./assets/dist/css/" + royaleNews_compiled_sass_css_file_name,
    royaleNews_rtlcss_dist: "./assets/dist/css/", // where would you like to save your generated RTL CSS
}


/*
===========================================================
=
= Task 1: Make POT file
=
====================================================
*/

gulp.task('WordpressPot', function () {
    return gulp.src(php_files.php_files_path)
        .pipe(wpPot({
            domain: project_text_domain,
            package: project_name,
        }))
        .pipe(gulp.dest('languages/' + project_text_domain + '.pot'));
});

/*
===========================================================
=
= Task 2: Zips production files
=
====================================================
*/

gulp.task('ZipProductionFiles', function () {
    return gulp.src(files_folders.filefolders_src)
        .pipe(zip(output_filename))
        .pipe(gulp.dest(files_folders.production_zip_file_path))
});

/*
===========================================================
=
= Task 3: Compile royaleNews static resources
=
====================================================
*/

gulp.task('royaleNewsScriptsTask', function () {
    return gulp.src(royaleNewsScriptsPath.royaleNews_scripts_path)
        .pipe(concat(royaleNews_build_js_file_name))
        .pipe(rename({ suffix: '.min' }))
        .pipe(uglify())
        .pipe(gulp.dest(royaleNewsScriptsPath.royaleNews_script_dist));
});

gulp.task('royaleNewsConditionalScriptsTask', function () {
    return gulp.src(royaleNewsConditionalScriptsPath.royaleNews_con_scripts_src)
        .pipe(rename({ suffix: '.min' }))
        .pipe(uglify())
        .pipe(gulp.dest(royaleNewsConditionalScriptsPath.royaleNews_con_scripts_dist));
});

gulp.task('royaleNewsSassTask', function () {
    var onError = function (err) {
        notify.onError({
            title: "Gulp",
            subtitle: "Failure!",
            message: "Error: <%= error.message %>",
            sound: "Beep"
        })(err);
        this.emit('end');
    };
    return gulp.src(royaleNewsSassPath.royaleNews_sass_src)
        .pipe(sourcemaps.init()) // initialize sourcemaps first
        .pipe(plumber({ errorHandler: onError }))
        .pipe(sass.sync().on('error', sass.logError))
        .pipe(postcss([autoprefixer('last 2 version'), cssnano()])) // PostCSS plugins
        .pipe(concat(royaleNews_compiled_sass_css_file_name))
        .pipe(sourcemaps.write('.')) // write sourcemaps file in current directory
        .pipe(gulp.dest(royaleNewsSassPath.royaleNews_sass_dist)); // put final CSS in dist folder
});

gulp.task('royaleNewsConditionalSassTask', function () {
    var onError = function (err) {
        notify.onError({
            title: "Gulp",
            subtitle: "Failure!",
            message: "Error: <%= error.message %>",
            sound: "Beep"
        })(err);
        this.emit('end');
    };
    return gulp.src(royaleNewsConditionalSassPath.royaleNews_cond_sass_src)
        .pipe(sourcemaps.init()) // initialize sourcemaps first
        .pipe(plumber({ errorHandler: onError }))
        .pipe(sass.sync().on('error', sass.logError))
        .pipe(postcss([autoprefixer('last 2 version'), cssnano()])) // PostCSS plugins
        .pipe(sourcemaps.write('.')) // write sourcemaps file in current directory
        .pipe(gulp.dest(royaleNewsConditionalSassPath.royaleNews_cond_sass_dist)); // put final CSS in dist folder
});

// task to convert LTR css to RTL
gulp.task('royaleNewsDortlTask', function () {
    return gulp.src(royaleNewsRtlCssPath.royaleNews_rtlcss_src)
        .pipe(rtlcss()) // Convert to RTL.
        .pipe(rename({ suffix: '-rtl' })) // Append "-rtl" to the filename.
        .pipe(gulp.dest(royaleNewsRtlCssPath.royaleNews_rtlcss_dist)); // Output RTL stylesheets.
});


/*
++++++++++++++++++++++++++++++++++++++++++++++++++++
=
= Run All tasks
=
++++++++++++++++++++++++++++++++++++++++++++++++++++
*/

//=========================================
// = C O M M A N D S                      = 
//=========================================
//
// 1. Command: gulp makepot (will generate WP POT file)
// 2. Command: gulp assets (will compile royaleNews scss, js & watch for the changes)
// 3. Command: gulp zipprod (zips the production files)
//
//=========================================

// Run Task: none, just echo message for default command

gulp.task('default', shell.task(

    'echo ====================== ⛔️ Hello Folks, gulp default command is disabled in this project. These are the available commands gulp zipprod, gulp assets, gulp makepot. If you need additional info refer gulpfile.js L269. Cheers 😜 ======================',

));


// Run Task: Zip production files

gulp.task('zipprod', gulp.series('ZipProductionFiles', (done) => {

    done();
}));

// Run Task: Make Pot file

gulp.task('makepot', gulp.series('WordpressPot', (done) => {

    gulp.watch(files_folders.filefolders_src, gulp.series('WordpressPot'));
    done();
}));

// Run Task: Compile royaleNews assets.

gulp.task('assets', gulp.series('royaleNewsScriptsTask', 'royaleNewsSassTask', (done) => {

    gulp.watch(royaleNewsScriptsPath.royaleNews_scripts_path, gulp.series('royaleNewsScriptsTask'));
    gulp.watch(royaleNewsSassPath.royaleNews_sass_src, gulp.series('royaleNewsSassTask'));
    done();
}));

