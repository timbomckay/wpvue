const webpack = require('webpack');
const path = require('path');

module.exports = {
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
  plugins: [
    new webpack.NamedModulesPlugin(),
    new webpack.HotModuleReplacementPlugin()
  ]
};
