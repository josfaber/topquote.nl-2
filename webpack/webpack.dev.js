const path = require( 'path' );
const { merge } = require( 'webpack-merge' );
const common = require( './webpack.common' );
const BrowserSyncPlugin = require( 'browser-sync-webpack-plugin' );
const WebpackAssetsManifest = require( 'webpack-assets-manifest' );

let manifest = new WebpackAssetsManifest( {
    transform( assets, manifest ) {
        // assets["version" ] = new Date().getFullYear().toString() + "-" + (new Date().getMonth() + 1).toString() + "-" + new Date().getDate().toString();
        assets["version" ] = require('../package.json').version;
    },
} );

module.exports = merge( common, {
    mode: 'development',
    devtool: 'eval-cheap-module-source-map',
    module: {
        rules: [
            {
                test: /\.(png|jpg|jpeg|gif)$/,
                type: 'asset/resource',
                generator: {
                    filename: 'img/[name][ext]',
                },
            },
            {
                test: /\.svg$/,
                type: 'asset/inline',
            },
            {
                test: /\.(woff|woff2|eot|ttf|otf)$/,
                type: 'asset/resource',
                generator: {
                    filename: 'font/[name][ext]',
                },
                // loader: 'file-loader',
                // options: {
                //   name: '[name].[ext]',
                //   outputPath: 'images'
                // }
            },
        ]
    },
    plugins: [
        new BrowserSyncPlugin( {
            files: [
                path.resolve( __dirname, '../app/**/*.css' ),
                path.resolve( __dirname, '../app/**/*.js' ),
                path.resolve( __dirname, '../app/**/*.php' ),
                path.resolve( __dirname, '../app/**/*.html' ),
            ],
            proxy: 'http://topquote.local',
            open: false,
        }, {
            reload: false,
            name: 'bs-webpack-plugin',
        } ),
        manifest,
    ],
} );