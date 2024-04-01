const path = require('path');
const TerserPlugin = require('terser-webpack-plugin');

module.exports = {
    mode: 'production',
    entry: './consent_v2.js',
    output: {
        filename: 'consent_bundle.js', // Output filename
        path: path.resolve(__dirname, '..', 'app', 'js', 'dist') // Output directory path
    },
    optimization: {
        minimize: true,
        minimizer: [new TerserPlugin()]
    }
};