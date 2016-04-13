Wee.routes.map({
	'$root||$any': [
		'registerapps',
		'frontPage',
		'common'
	],
	'home': [
		'search',
		'common'
	]
});

Wee.ready('routes:run');