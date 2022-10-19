/* global require, module, __dirname */
const path = require( 'path' );
const MiniCssExtractPlugin = require( 'mini-css-extract-plugin' );
const { CleanWebpackPlugin } = require( 'clean-webpack-plugin' );
//const DependencyExtractionPlugin = require( '@wordpress/dependency-extraction-webpack-plugin' );

module.exports = {
	entry: {
		main: [ './src/js/index.js', './src/js/jquery.mediaupload.js', './src/css/style.css' ],
	},
	output: {
		path: path.resolve( __dirname, 'dist' ),
		filename: '[name].js',
	},
	module: {
		rules: [
			{
				test: /\.(ts|tsx)?$/,
				use: 'ts-loader',
				exclude: /node_modules/,
			},
			{
				test: /\.js$/,
				exclude: /node_modules/,
				use: [ 'babel-loader' ],
			},
			{
				test: /\.(sc|c|sa)ss$/,
				exclude: /node_modules/,
				use: [
					MiniCssExtractPlugin.loader,
					{ loader: 'css-loader', options: { importLoaders: 1 } },
					'postcss-loader',
				],
			},
			{
				test: /\.(ttf|jpg)$/,
				use: {
					loader: 'file-loader',
					options: {
						fileName: '[path][name].[ext]',
					},
				},
			},
		],
	},
	externals: {
		wp: 'wp',
		jQuery: 'jQuery',
	},
	plugins: [
		new CleanWebpackPlugin(),
		//new DependencyExtractionPlugin(),
		new MiniCssExtractPlugin( {
			filename: '[name].css',
		} ),
	],
	resolve: {
		extensions: [ '.tsx', '.ts', '.js' ],
	},
};
