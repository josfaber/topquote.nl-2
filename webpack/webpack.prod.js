const path = require('path');
const { merge } = require('webpack-merge');
const common = require('./webpack.common');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const TerserPlugin = require("terser-webpack-plugin");
const WebpackAssetsManifest = require( 'webpack-assets-manifest' );

const version = require('../package.json').version;

let manifest = new WebpackAssetsManifest( {
    transform( assets, manifest ) {
        // assets["version" ] = new Date().getTime().toString();
        assets["version" ] = require('../package.json').version + "_" + new Date().getFullYear().toString() + (new Date().getMonth() + 1).toString() + new Date().getDate().toString() + "_" + new Date().getHours().toString() + new Date().getMinutes().toString();
    },
} );

module.exports = merge(common, {
    mode: 'production',
    devtool: 'hidden-source-map',
    // devtool: 'eval-cheap-module-source-map',
    output: {
        filename: 'js/[name]-[hash].js',
    },
    module: {
        rules: [
            {
                test: /\.(png|jpg|jpeg|gif)$/,
                // type: 'asset/resource',
                type: 'asset',
                parser: {
                    dataUrlCondition: {
                        maxSize: 6 * 1024
                    }
                },
                generator: {
                    filename: 'img/[hash][ext][query]',
                },
            },
            {
                test: /\.svg$/,
                // type: 'asset/inline',
                type: 'asset',
                generator: {
                    filename: 'font/[name][hash][ext][query]',
                },
                parser: {
                    dataUrlCondition: {
                        maxSize: 10 * 1024
                    }
                }
            },
            {
                test: /\.(woff|woff2|eot|ttf|otf)$/,
                type: 'asset/resource',
                generator: {
                    filename: 'font/[hash][ext][query]',
                },
            },
        ]
    },
    plugins: [
        new CleanWebpackPlugin({
            verbose: true
        }),
        new MiniCssExtractPlugin({
            filename: "css/[name]-[hash].css",
            chunkFilename: "css/[name][id]-[hash].css"
        }),
        manifest,
    ],
    optimization: {
        minimize: true,
        minimizer: [new TerserPlugin({
            extractComments: true,
            terserOptions: {
              compress: {
                // drop_console: true
              }
            }
        })],
        moduleIds: "deterministic",
    }
});
