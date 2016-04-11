Wee.fn.make('frontPage', {
	init: function() {
		this.$private.more();
		this.$private.info();
	}
}, {
	more: function() {
		var scope = this;

		$('ref:moreToggle').on('click', function() {
			scope.toggle($('ref:more'));
		});
	},
	info: function() {
		var scope = this,
			info = $('ref:info');

		Wee.events.on({
			'ref:infoToggle': {
				click: function() {
					scope.toggle(info);
				}
			},
			'ref:infoClose': {
				click: function() {
					scope.toggle(info);
				}
			}
		});
	},
	toggle: function($el) {
		var isActive = '-is-active';

		if (! $el.hasClass(isActive)) {
			$el.show();

			setTimeout(function() {
				$el.addClass(isActive);
			}, 100);
		} else {
			$el.removeClass(isActive);

			setTimeout(function() {
				$el.hide();
			}, 100);
		}
	}
});