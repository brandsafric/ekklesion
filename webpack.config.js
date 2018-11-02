var Encore = require('@symfony/webpack-encore');
const CopyWebpackPlugin = require('copy-webpack-plugin');

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    //.setManifestKeyPrefix('build/')
    .addEntry('app', './assets/js/app')
    .autoProvidejQuery()

    .addPlugin(new CopyWebpackPlugin([
        { from: './assets/images', to: 'images' },
    ]))
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())
;

module.exports = Encore.getWebpackConfig();