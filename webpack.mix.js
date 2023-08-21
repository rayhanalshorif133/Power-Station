const mix = require("laravel-mix");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js("resources/js/app.js", "public/js")
    .sass("resources/sass/app.scss", "public/css")
    .js("resources/js/issue/issue.js", "public/js/issue/issue.js")
    .js("resources/js/issue/show.js", "public/js/issue/show.js")
    .js("resources/js/issue/logs.js", "public/js/issue/logs.js")
    .js(
        "resources/js/issue/issueHasDevice.js",
        "public/js/issue/issueHasDevice.js"
    )
    .js("resources/js/device/index.js", "public/js/device/index.js")
    .js("resources/js/device/edit.js", "public/js/device/edit.js")
    .js("resources/js/device/status.js", "public/js/device/status.js")
    .js("resources/js/device/main-device.js", "public/js/device/main-device.js")
    .js("resources/js/device/section.js", "public/js/device/section.js")
    .js("resources/js/device/area.js", "public/js/device/area.js")
    .js("resources/js/device/category.js", "public/js/device/category.js")
    .js(
        "resources/js/device/device-schedule.js",
        "public/js/device/device-schedule.js"
    )
    .js(
        "resources/js/device/device-stock.js",
        "public/js/device/device-stock.js"
    )
    .js("resources/js/user/index.js", "public/js/user/index.js")
    .js("resources/js/user/create.js", "public/js/user/create.js")
    .js("resources/js/others/department.js", "public/js/others/department.js")
    .js(
        "resources/js/others/recommendation.js",
        "public/js/others/recommendation.js"
    )
    .js("resources/js/room/index.js", "public/js/room/index.js")
    .js("resources/js/room/create.js", "public/js/room/create.js")
    .js("resources/js/worker-ot/index.js", "public/js/worker-ot/index.js")
    .js(
        "resources/js/shift_engineer/index.js",
        "public/js/shift_engineer/index.js"
    )
    .js(
        "resources/js/shift_engineer/create.js",
        "public/js/shift_engineer/create.js"
    )
    .sourceMaps();
