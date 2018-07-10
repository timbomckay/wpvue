const webpack = require('webpack');
const merge = require('webpack-merge');
const path = require('path');
const ProgressBarPlugin = require('progress-bar-webpack-plugin');
const CleanWebpackPlugin = require('clean-webpack-plugin');
const { VueLoaderPlugin } = require('vue-loader');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

module.exports = (env, options) => {
  // define path to theme directory
  const THEME_URI = '/wp-content/themes/' + process.env.npm_package_name;

  let config = merge({
    entry: {
      main: path.resolve(__dirname, '../src/main.js')
    },
    output: {
      // set publicPath to output path in theme directory
      publicPath: THEME_URI + '/dist/'
    },
    resolve: {
      alias: {
        // need the full version to compile templates on the client side (mostly for router-links)
        // doc: https://vuejs.org/v2/guide/installation.html#Runtime-Compiler-vs-Runtime-only
        vue$: 'vue/dist/vue.esm.js'
      }
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
              plugins: ["transform-object-assign","syntax-dynamic-import"]
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
        'THEME_URI': JSON.stringify(THEME_URI)
      }),
      new VueLoaderPlugin()
    ]
  }, require('./webpack.' + env + '.js'));

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
