Wee.routes.map({
	'$root||$any': [
		'search',
		'registerapps',
		'frontPage',
		'common'
	],
	'collection': {
		'$any': 'movie',
		'$root': [
			'search',
			'search:autocomplete'
		]
	},
	'movie': {

	}
});

Wee.ready('routes:run');