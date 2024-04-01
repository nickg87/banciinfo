const path = require('path');
const TerserPlugin = require('terser-webpack-plugin');

module.exports = {
    mode: 'production', // Change mode to production for optimized output
    entry: './consent_v2.js',
    output: {
        filename: 'consent_bundle.js',
        path: path.resolve(__dirname, '..', 'app', 'js', 'dist')
    },
    optimization: {
        minimize: true,
        minimizer: [
            new TerserPlugin({
                terserOptions: {
                    // Keep function names readable for debugging
                    mangle: false
                }
            })
        ]
    }
};
