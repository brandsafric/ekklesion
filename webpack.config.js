var Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    //.setManifestKeyPrefix('build/')

    .addEntry('app', './assets/js/app.js')
    .addStyleEntry('login', './assets/css/login.css')
    .addStyleEntry('dashboard', './assets/css/dashboard.css')

    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())
    .enableSassLoader()
    .enableVueLoader()
;

module.exports = Encore.getWebpackConfig();