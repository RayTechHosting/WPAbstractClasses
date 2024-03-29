import { resolve } from 'path';
import { defineConfig } from 'vite';

export default defineConfig({
	mode: 'development',
	base: '/wp-content/themes/netlantique/assets/dist/',
	css: {
		postcss: {
			plugins: [
				require('postcss-import'),
				require('postcss-inline-svg'),
				require('tailwindcss/nesting'),
				require('tailwindcss'),
				require('autoprefixer'),
				require('postcss-url')({
					url: 'rebase',
					basePath: resolve(__dirname, 'dist/css'),
				}),
				require('cssnano')({
					preset: 'default',
				}),
			],
		},
	},
	build: {
		outDir: resolve(__dirname, 'dist'),
		manifest: true,
		rollupOptions: {
			input: {
				main: resolve(__dirname, 'src/js/index.ts'),
				conditional: resolve(__dirname, 'src/js/conditional.ts'),
				repeater: resolve(__dirname, 'src/js/repeater.ts'),
				'jquery.mediaupload': resolve(__dirname, 'src/js/jquery.mediaupload.js'),
				style: resolve(__dirname, 'src/css/style.css')
			},
			output: {
				entryFileNames: 'js/[name].js',
				chunkFileNames: 'js/[name].js',
				assetFileNames: ({ name }) => {
					if (/\.(gif|jpe?g|png|svg)$/.test(name ?? '')) {
						return 'images/[name][extname]';
					}

					if (/\.css$/.test(name ?? '')) {
						return 'css/[name][extname]';
					}

					if (/\.(ttf|eot|woff2?)$/.test(name ?? '')) {
						return 'fonts/[name][extname]';
					}

					// default value
					// ref: https://rollupjs.org/guide/en/#outputassetfilenames
					return '[name][extname]';
				},
			},
		},
	},
	plugins: [
		
	]
});
