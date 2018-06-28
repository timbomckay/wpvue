const webpack = require('webpack');
const merge = require('webpack-merge');
const path = require('path');
const ProgressBarPlugin = require('progress-bar-webpack-plugin');
const CleanWebpackPlugin = require('clean-webpack-plugin');
const { VueLoaderPlugin } = require('vue-loader');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

module.exports = (env, options) => {
  let config = merge( require('./webpack.' + env + '.js'), {
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
        },
        {
          test: /\.scss$/,
          use: [
            'vue-style-loader',
            'css-loader',
            {
              loader: 'postcss-loader',
              options: {
                config: {
                  path: path.resolve(__dirname, 'postcss.config.js')
                }
              }
            },
            {
              loader: 'sass-loader',
              options: {
                data: "@import '" + path.resolve(__dirname, '../src/utils/variables') + "';@import '" + path.resolve(__dirname, '../src/utils/mixins') + "';"
              }
            }
          ]
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

  // Add CSS Extraction if not in devServer
  if (!config.devServer) {
    // Find .scss test to add MiniCssExtractPlugin loader
    // Has to be added after vue-style-loader
    config.module.rules.find(function(value, index) {
      if(value.test.test('.scss')) {
        config.module.rules[index].use.splice(1, 0, MiniCssExtractPlugin.loader);
      }
    });
    // Push MiniCssExtractPlugin Plugin
    config.plugins.push(
      new MiniCssExtractPlugin()
    );
  }

  return config;
};
