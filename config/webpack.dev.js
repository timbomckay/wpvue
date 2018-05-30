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
    publicPath: "/dist",
    // publicPath: "/" + process.env.npm_package_name + "/dist", // this isn't working with HMR for some reason
    contentBase: path.join(__dirname, "../"),
    stats: "minimal", // https://webpack.js.org/configuration/stats/
    // watchOptions: {
    //   poll: false // needed for homestead/vagrant setup --- TM removed and doesn't seem to harm anything
    // },
    headers: {
      "Access-Control-Allow-Origin": "*"
    },
    overlay: {
      // warnings: true,
      errors: true
    }
  },
  output: {
    publicPath: 'http://localhost:8080/dist'
  },
  module: {
    rules: [
      {
        test: /\.less$/,
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
            loader: 'less-loader',
            options: {}
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
