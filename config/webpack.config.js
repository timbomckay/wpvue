const webpack = require('webpack');
const merge = require('webpack-merge');
const path = require('path');
const CleanWebpackPlugin = require('clean-webpack-plugin');
const { VueLoaderPlugin } = require('vue-loader');
var ProgressBarPlugin = require('progress-bar-webpack-plugin');

module.exports = (env, options) => {
  return merge( require('./webpack.' + env + '.js'), {
    entry: {
      main: path.resolve(__dirname, '../src/main.js')
    },
    module: {
      rules: [
        {
          test: /\.json$/,
          use: 'json-loader'
        },
        {
          enforce: 'pre',
          test: /\.(js|vue)$/,
          exclude: /node_modules/,
          loader: 'eslint-loader',
          options: {
            emitWarning: true,
            failOnError: true,
            configFile: path.join(__dirname, ".eslintrc.js"),
          }
        },
        {
          test: /\.vue$/,
          loader: 'vue-loader'
        },
        {
          test: /\.js$/,
          exclude: /node_modules/,
          use: {
            loader: 'babel-loader',
            options: {
              presets: [
                ['env', {
                  useBuiltIns: (env !== 'dev')
                }]
              ],
              plugins: (env !== 'dev') ? ["transform-object-assign"] : []
            }
          }
        }
      ]
    },
    plugins: [
      new ProgressBarPlugin(),
      new CleanWebpackPlugin('dist', {
        root: path.join(__dirname, '..')
      }),
      new webpack.DefinePlugin({
        'ENV': JSON.stringify(env),
        'THEME_URI': JSON.stringify('/wp-content/themes/' + process.env.npm_package_name)
      }),
      new VueLoaderPlugin()
    ]
  });
};
