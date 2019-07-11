const { watch, parallel, src } = require('gulp');
const phpunit = require('gulp-phpunit');

const phpunitOptions = {
    statusLine: false,
    clear: true,
    notify: false,
};

module.exports.test = () => {
    return src('phpunit.xml')
        .pipe(phpunit('./vendor/bin/phpunit', phpunitOptions));
};

module.exports.watch = () => {
    watch(['src/**/*.php', 'tests/**/*.php'], parallel(['test']));
};
