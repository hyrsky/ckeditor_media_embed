const path = require('path');
const fs = require('fs');
const webpack = require('webpack');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const TerserPlugin = require('terser-webpack-plugin');

function getDirectories(srcpath) {
    return fs
        .readdirSync(srcpath)
        .filter((item) => fs.statSync(path.join(srcpath, item)).isDirectory());
}

// https://github.com/webpack/webpack/issues/11671
// Extract files used by css from node_modules.
module.exports = [{
    mode: 'production',
    entry: {
        'media_embed.admin': path.resolve(
            __dirname,
            'css/media_embed.admin.css'
        ),
    },
    plugins: [new MiniCssExtractPlugin()],
    output: {
        path: path.resolve(__dirname, './css/build/')
    },
    module: {
        rules: [
            { test: /\.css$/, use: [MiniCssExtractPlugin.loader, "css-loader"] },
            { test: /\.svg$/, type: 'asset/inline' }
        ],
    },
}];

// Loop through every subdirectory and build each one to ./js/build.
getDirectories('./js/ckeditor5_plugins').forEach((dir) => {
    // Build ckeditor5 plugin
    const bc = {
        mode: 'production',
        optimization: {
            minimize: true,
            minimizer: [
                new TerserPlugin({
                    terserOptions: {
                        format: {
                            comments: false,
                        },
                    },
                    test: /\.js(\?.*)?$/i,
                    extractComments: false,
                }),
            ],
            moduleIds: 'named',
        },
        entry: {
            path: path.resolve(
                __dirname,
                'js/ckeditor5_plugins',
                dir,
                'src/index.js',
            ),
        },
        output: {
            path: path.resolve(__dirname, './js/build'),
            filename: `${dir}.js`,
            library: ['CKEditor5', dir],
            libraryTarget: 'umd',
            libraryExport: 'default',
        },
        plugins: [
            new webpack.DllReferencePlugin({
                manifest: require('./node_modules/ckeditor5/build/ckeditor5-dll.manifest.json'), // eslint-disable-line global-require, import/no-unresolved
                scope: 'ckeditor5/src',
                name: 'CKEditor5.dll',
            }),
        ],
        module: {
            rules: [
                { test: /\.svg$/, type: 'asset/source' },
                { test: /\.css$/, type: 'asset/source' }
            ],
        },
    };

    module.exports.push(bc);
});
