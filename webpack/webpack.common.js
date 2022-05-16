const path = require( 'path' );
const webpack = require( 'webpack' );
const MiniCssExtractPlugin = require( "mini-css-extract-plugin" );
const CopyWebpackPlugin = require('copy-webpack-plugin');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');

module.exports = {
    entry: {
        'main': './src/js/main.js',
        'home': './src/js/home.js',
        'inline': './src/js/inline.js',
        'quotes': './src/js/quotes.js',
    },
    output: {
        // filename: 'js/[name].bundle.js',
        filename: 'js/[name]-[hash].js',
        path: path.resolve( __dirname, '../app/public' )
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: {
                    loader: "babel-loader",
                    options: {
                        presets: [ '@babel/preset-env' ],
                    }
                }
            },
            {
                test: /\.(sa|sc|c)ss$/,
                use: [
                    {
                        loader: MiniCssExtractPlugin.loader,
                        options: {
                            publicPath: '../'
                        }
                    },
                    'css-loader',
                    {
                        loader: 'resolve-url-loader',
                        options: {
                            
                        }
                    },
                    {
                        loader: 'sass-loader',
                        options: {
                            sourceMap: true, 
                        },
                    },
                ]
            },
        ]
    },
    plugins: [
        new CleanWebpackPlugin({
            cleanOnceBeforeBuildPatterns: ["**/*", "!*.php", "!sitemap*.*", "!favicon.ico", "!visual.png", "!ads.txt"],
        }),
        new MiniCssExtractPlugin( {
            // filename: "css/[name].bundle.css",
            // chunkFilename: "css/[name][id].bundle.css"
            filename: "css/[name]-[hash].css",
            chunkFilename: "css/[name][id]-[hash].css"
        } ),
        new webpack.ProvidePlugin( {
        } ),
        new CopyWebpackPlugin({
            patterns: [
                { from: 'src/static' }
            ]
        })
    ],
};