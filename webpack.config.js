const path = require('path');

module.exports = {
     mode: process.env.NODE_ENV ,
     devtool: process.env.NODE_ENV == 'development' ? 'source-map' : false,
     entry: {
          app: ['./public/assets/js/app.js'],
     },
     output: {
          path: path.resolve(__dirname, 'public','assets','js','dist'),
          filename: '[name].js',
     },
     module: {
          rules: [
               {
                    test: /\.js$/,
                    exclude: /node_modules/,
                    loader: 'babel-loader',
               },
          ],
     },
};