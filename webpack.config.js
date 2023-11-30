const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
module.exports = {
  mode: 'development',
  watch: true,
  entry: {
    'js/app' : './src/js/app.js',
    'js/inicio' : './src/js/inicio.js',
    'js/solicitud/index' : './src/js/solicitud/index.js',
    'js/marca/index' : './src/js/marca/index.js',
    'js/tipoequipo/index' : './src/js/tipoequipo/index.js',
    'js/equipo_estado/index' : './src/js/equipo_estado/index.js',
    'js/mantenimiento/index' : './src/js/mantenimiento/index.js',
    'js/mantenimiento2/index' : './src/js/mantenimiento2/index.js',
    'js/mantenimiento3/index' : './src/js/mantenimiento3/index.js',
    'js/estadisticas/index' : './src/js/estadisticas/index.js',
    // 'js/reporte/index' : './src/js/reporte/index.js',
  },
  output: {
    filename: '[name].js',
    path: path.resolve(__dirname, 'public/build')
  },
  plugins: [
    new MiniCssExtractPlugin({
        filename: 'styles.css'
    })
  ],
  module: {
    rules: [
      {
        test: /\.(c|sc|sa)ss$/,
        use: [
            {
                loader: MiniCssExtractPlugin.loader
            },
            'css-loader',
            'sass-loader'
        ]
      },
      {
        test: /\.(png|svg|jpg|gif)$/,
        loader: 'file-loader',
        options: {
           name: 'img/[name].[hash:7].[ext]'
        }
      },
    ]
  }
};