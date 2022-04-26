module.exports = (env, argv) => {
    let configType = argv.mode !== 'production' ? 'dev' : 'prod' ;
    return require('./webpack/webpack.'+configType);
}
