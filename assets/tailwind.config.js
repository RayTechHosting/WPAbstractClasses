module.exports = {
	purge: [ '../**/*.php', './**/*.js' ],
	theme: {
		extend: {
			gridTemplateColumns: {
				'modules-tabs': '250px 1fr',
				subheader: '310px 1fr',
				link: '25% 1fr 50px 50px',
				'xs-space-head': '75px 1fr',
				'space-head': '100px 1fr 161px',
			},
			colors: {
				primary: '#1ba5b0',
				secondary: '#464c53',
				grey: '#909498',
				content: '#707070',
				white: '#f0f1f2',
				rwhite: '#ffffff',
			},
			fontFamily: {
				content: 'Poppins',
				desc: 'Roboto',
				button: 'Oswald',
				headers: 'Poppins',
			},
			/*screens: {
				mobile: { max: '767px' },
				tablet: { max: '1024px' },
				desktop: '1025px',
			}, */
		},
	},
	variants: {},
	plugins: [],
	future: {
		removeDeprecatedGapUtilities: true,
		purgeLayersByDefault: true,
	},
};
