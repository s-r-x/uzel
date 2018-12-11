const path = require("path");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const OptimizeCSSAssetsPlugin = require("optimize-css-assets-webpack-plugin");
const UglifyJsPlugin = require("uglifyjs-webpack-plugin");
const webpack = require('webpack');
const CleanWebpackPlugin = require('clean-webpack-plugin')

let cleanWebpackConfig = {
  exclude: ['header.jpg', 'loaders', 'snowflake.png'],
  allowExternal: true
};

const OUTPUT_PATH = path.resolve(__dirname, "..", "assets");

module.exports = {
  entry: {
    customizer: './scripts/customizer.js',
    index: "./scripts/index.js",
    'post-loader': './scripts/post-loader.js',
    preloader: './scripts/preloader.js',
    slider: './scripts/slider.js',
    like: './scripts/like.js',
    snow: './scripts/snow.js',
    'photo-viewer': './scripts/photo-viewer.js',
  },
  output: {
    path: OUTPUT_PATH,
    filename: "[name].js"
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: [
              ['@babel/preset-env', {
                "useBuiltIns": "usage",
              }]
            ],
          },
        },
      },
      {
        test: /(\.css)|(\.less)$/,
        use: [
          { loader: MiniCssExtractPlugin.loader },
          "css-loader",
          "postcss-loader",
          'less-loader',
        ]
      },
      {
        test: /\.(png|jpg|gif|woff|woff2|otf|ttf|svg|eot)(\?v=\d+\.\d+\.\d+)?$/,
        use: [
          {
            loader: 'file-loader',
            options: {}
          }
        ]
      }
    ]
  },
  plugins: [
    new CleanWebpackPlugin(OUTPUT_PATH, cleanWebpackConfig),
    new MiniCssExtractPlugin({
      filename: "[name].css",
      chunkFilename: "[id].css"
    }),
  ],
  optimization: {
    minimizer: [
      new UglifyJsPlugin({
        cache: true,
        parallel: true,
        sourceMap: true
      }),
      new OptimizeCSSAssetsPlugin({})
    ]
  },
};
