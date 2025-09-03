const gulp = require("gulp");
const sass = require("gulp-sass")(require("sass"));
const autoprefixer = require("gulp-autoprefixer");
const cleanCSS = require("gulp-clean-css");
const sourcemaps = require("gulp-sourcemaps");
const plumber = require("gulp-plumber");
const rename = require("gulp-rename");
const browserSync = require("browser-sync").create();

// Configuration
const config = {
  // Update this to your local WordPress site URL
  proxy: "http://julian2025.local", // Change this to match your local site URL

  // Paths
  paths: {
    sass: {
      src: "sass/**/*.scss",
      dest: "./",
      main: "sass/style.scss",
    },
    php: ["**/*.php", "!node_modules/**", "!vendor/**"],
    js: ["js/**/*.js", "!js/**/*.min.js"],
  },

  // Sass options
  sass: {
    outputStyle: "expanded",
    indentType: "tab",
    indentWidth: 1,
    precision: 3,
    errLogToConsole: true,
  },

  // Autoprefixer options
  autoprefixer: {
    // Will read from .browserslistrc file
  },
};

// Error handler
const handleError = (err) => {
  console.log("\n❌ Error: " + err.message);
  console.log("📁 File: " + err.file);
  console.log("📍 Line: " + err.line + ", Column: " + err.column);
  console.log("");
};

// Sass compilation task
function compileSass() {
  return gulp
    .src(config.paths.sass.main)
    .pipe(
      plumber({
        errorHandler: handleError,
      })
    )
    .pipe(sourcemaps.init())
    .pipe(sass(config.sass).on("error", sass.logError))
    .pipe(autoprefixer(config.autoprefixer))
    .pipe(sourcemaps.write("./"))
    .pipe(gulp.dest(config.paths.sass.dest))
    .pipe(browserSync.stream({ match: "**/*.css" }));
}

// Sass compilation for production (minified)
function compileSassProduction() {
  return gulp
    .src(config.paths.sass.main)
    .pipe(
      plumber({
        errorHandler: handleError,
      })
    )
    .pipe(
      sass({
        ...config.sass,
        outputStyle: "compressed",
      }).on("error", sass.logError)
    )
    .pipe(autoprefixer(config.autoprefixer))
    .pipe(
      cleanCSS({
        level: 2,
        format: {
          breaks: {
            afterAtRule: false,
            afterBlockBegins: false,
            afterBlockEnds: false,
            afterComment: false,
            afterProperty: false,
            afterRuleBegins: false,
            afterRuleEnds: false,
            beforeBlockEnds: false,
            betweenSelectors: false,
          },
          indentBy: 0,
          indentWith: "tab",
          spaces: {
            aroundSelectorRelation: false,
            beforeBlockBegins: false,
            beforeValue: false,
          },
          wrapAt: false,
        },
      })
    )
    .pipe(gulp.dest(config.paths.sass.dest));
}

// Browser Sync initialization
function browserSyncInit() {
  browserSync.init({
    proxy: config.proxy,
    open: true,
    notify: false,
    ghostMode: {
      clicks: false,
      forms: true,
      scroll: false,
    },
  });
}

// Reload browser
function reload(done) {
  browserSync.reload();
  done();
}

// Watch files
function watchFiles() {
  gulp.watch(config.paths.sass.src, compileSass);
  gulp.watch(config.paths.php, reload);
  gulp.watch(config.paths.js, reload);
}

// Define complex tasks
const build = gulp.series(compileSassProduction);
const dev = gulp.series(
  compileSass,
  gulp.parallel(browserSyncInit, watchFiles)
);
const watch = gulp.series(compileSass, watchFiles);
const sync = gulp.series(compileSass, browserSyncInit, watchFiles);

// Export tasks
exports.sass = compileSass;
exports.build = build;
exports.watch = watch;
exports.sync = sync;
exports.default = dev;

// Log available commands
console.log("\n🚀 Available commands:");
console.log("  npm run dev    - Start development with BrowserSync");
console.log("  npm run build  - Build production CSS");
console.log("  npm run watch  - Watch files without BrowserSync");
console.log("  npm run sync   - Start BrowserSync with file watching");
console.log("  gulp sass      - Compile Sass once");
console.log(
  "\n💡 Don't forget to update the proxy URL in gulpfile.js to match your local site!\n"
);
