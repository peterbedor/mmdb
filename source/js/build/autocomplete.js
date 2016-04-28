Wee.fn.make('autocomplete', {
	init: function(config) {
		var scope = this,
			$input = $(config.input),
			$wrapper = $('<div class="autocomplete"></div>'),
			$results = $('<div class="autocomplete__results js-hide"></div>');

		this.config = config;

		if (! this.config.url) {
			this.config.url = '/contacts/autocomplete';
		}

		// TODO: resolve Wee bug changing wrapped children
		$input.wrap($wrapper.append($results));

		this.$input = $(config.input);
		this.$results = this.$input.prev();

		this.$input.on({
			keydown: function(e) {
				if (e.keyCode === 40 || e.keyCode === 38 || e.keyCode === 13) {
					e.preventDefault();
				}
			},
			keyup: function(e) {
				scope.$private.process(e.keyCode, this.value);
				e.preventDefault();
			},
			blur: function() {
				scope.$prev = false;
			}
		});

		$('.autocomplete__item').on('click', function() {
			scope.select($(this));
		}, {
			delegate: this.$results
		});

		$($._body).on('click', function(e) {
			setTimeout(function() {
				if (scope.$private.$active) {
					if (e.target !== $('ref:autocomplete')[0]) {
						scope.collapse();
					}
				}
			}, 100);
		});
	},
	collapse: function() {
		this.$private.$active = false;
		this.$private.processing = false;

		this.$results.hide();
	},
	select: function($active) {
		this.collapse();

		if (this.config.onSelect) {
			this.config.onSelect($active, this.$input);
		}
	}
}, {
	/**
	 *
	 * @param key
	 * @param value
	 */
	process: function(key, value) {
		var scope = this,
			activeClass = '-is-active';

		if (scope.$active) {
			scope.$active.removeClass(activeClass);
		}

		if (key === 40 || key === 38) {
			if (scope.$active) {
				scope.$active = key === 40 ?
					scope.$active.next() :
					scope.$active.prev();
			} else {
				scope.$entries = scope.$public.$results.children();

				if (scope.$entries.length) {
					scope.$active = key === 40 ?
						scope.$entries.first() :
						scope.$entries.last();
				} else {
					scope.$active = false;
				}
			}

			if (scope.$active.length) {
				scope.$active.addClass(activeClass);
			} else {
				scope.$active = false;
			}
		} else if (key === 13 && scope.$active) {
			this.$public.select(scope.$active);
		} else if (key === 27 || key === 9) {
			scope.$public.collapse();
		} else {
			var val = value;

			if (val.length >= 2) {
				if (! scope.processing) {
					scope.processing = true;

					setTimeout(function() {
						scope.query(val, scope.$public.$results);
					}, 500);
				}
			} else {
				scope.$public.$results.hide();
				scope.$public.collapse();

				if (scope.$public.config.onClear) {
					scope.$public.config.onClear();
				}
			}
		}
	},

	/**
	 *
	 * @param value
	 */
	query: function(value) {
		var scope = this,
			params = scope.$public.config.data || {};
		params.q = value.trim();

		Wee.data.request({
			url: scope.$public.config.url,
			data: params,
			json: true,
			success: function(data) {
				if (($.isArray(data) && data.length) ||
					($.isObject(data) && data.total)
				) {
					var content = $.view.render(scope.$public.config.view, {
						results: data
					});

					scope.$public.$results.html(content)
						.show();
				} else {
					scope.$public.$results.hide();
				}

				scope.processing = false;
			}
		});
	}
});