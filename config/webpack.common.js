const path = require( 'path' );
const webpack = require( 'webpack' );
const MiniCssExtractPlugin = require( "mini-css-extract-plugin" );

module.exports = {
    entry: {
        'main': './src/js/main.js',
        'quotes': './src/js/quotes.js',
    },
    output: {
        filename: 'js/[name].bundle.js',
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
        new MiniCssExtractPlugin( {
            filename: "css/[name].bundle.css",
            chunkFilename: "css/[name][id].bundle.css"
        } ),
        new webpack.ProvidePlugin( {
        } ),
    ],
};