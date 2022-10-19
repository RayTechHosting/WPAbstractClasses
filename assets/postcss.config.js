/* global module, require */
module.exports = {
	syntax: 'postcss-scss',
	plugins: [
		require( 'stylelint' ),
		require( 'tailwindcss' ),
		require( 'postcss-import' ),
		require( 'postcss-simple-vars' )( { silent: true } ),
		require( 'postcss-each' ),
		require( 'postcss-nested' ),
		require( 'autoprefixer' ),
	],
};
