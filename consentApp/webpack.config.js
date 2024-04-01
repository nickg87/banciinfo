const path = require('path');
const TerserPlugin = require('terser-webpack-plugin');

module.exports = {
    mode: 'production', // Change mode to production for optimized output
    entry: './consent.js',
    output: {
        filename: 'bundle.js',
        path: path.resolve(__dirname, '..', 'app', 'js', 'dist')
    },
    module: {
        rules: [
            {
                test: /\.css$/,
                use: ['style-loader', 'css-loader']
            }
        ]
    },
    optimization: {
        minimize: true,
        // minimizer: [
        //     new TerserPlugin({
        //         terserOptions: {
        //             // Keep function names readable for debugging
        //             mangle: false
        //         }
        //     })
        // ]
    }
};
