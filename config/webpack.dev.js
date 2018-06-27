const webpack = require('webpack');
const merge = require('webpack-merge');
const path = require('path');

const config = require('./webpack.config.js');

module.exports = merge(config, {
  devtool: 'inline-source-map',
  devServer: {
    hot: true, // this enables hot reload
    inline: true, // use inline method for hmr
    host: "localhost",
    port: 8080,
    publicPath: "/" + process.env.npm_package_name + "/dist",
    contentBase: path.join(__dirname, "../"),
    compress: true, // enable gzip
    stats: "minimal", // https://webpack.js.org/configuration/stats/
    headers: {
      "Access-Control-Allow-Origin": "*"
    },
    overlay: {
      // warnings: true,
      errors: true
    }
  },
  output: {
    publicPath: "http://localhost:8080/" + process.env.npm_package_name + "/dist"
  },
  module: {
    rules: [
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
    new webpack.NamedModulesPlugin(),
    new webpack.HotModuleReplacementPlugin()
  ]
});
