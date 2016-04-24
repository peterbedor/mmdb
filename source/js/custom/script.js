Wee.routes.map({
	'$root||$any': [
		'search',
		'registerapps',
		'frontPage',
		'common'
	],
	'home': [
		'search'
	],
	'movie': {

	}
});

Wee.ready('routes:run');