Wee.fn.make('registerapps', {
	init: function() {
		this.loadApps();
		this.loadHelpers();
	},
	loadApps: function() {
		Wee.app.make('searchResults', {
			target: 'ref:results',
			view: 'search.external'
		});
	},
	loadHelpers: function() {
		Wee.view.addHelper('next', function() {
			return this.val + 1;
		});

		Wee.view.addHelper('prev', function() {
			return this.val -1;
		});
	}
});