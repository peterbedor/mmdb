Wee.fn.make('common', {
	init: function() {
		var scope = this;

		scope.$private.mobileNav();
		scope.$private.searchToggle();

		scope.$private.extend();
	}
}, {
	mobileNav: function() {
		var $nav = $('ref:mainNav'),
			$body = $(Wee._body),
			isActive = '-is-active',
			isDisabled = '-is-disabled';

		Wee.events.on({
			'ref:mobileNavToggle': {
				click: function() {
					$nav.show();
					$body.addClass(isDisabled);

					setTimeout(function() {
						$nav.addClass(isActive);
					}, 50);
				}
			},
			'ref:mobileNavClose': {
				click: function() {
					$nav.removeClass(isActive);
					$body.addClass(isDisabled);

					setTimeout(function() {
						$nav.hide();
					}, 50);
				}
			}
		});
	},
	searchToggle: function() {
		var $search = $('ref:headerSearch'),
			$add = $('ref:headerAdd'),
			isActive = '-is-active';

		Wee.events.on({
			'ref:searchMovie': {
				click: function() {
					var isHidden = '-is-hidden';

					$search.toggleClass(isActive);
					$(this).toggleClass(isActive);
					$('ref:headerHeading').toggleClass(isHidden);
					$('ref:mobileNavToggle').toggleClass(isHidden);

					if ($add.hasClass(isActive)) {
						$add.removeClass(isActive);
					}
				}
			}
		});
	},
	extend: function() {
		Wee.fn.extend({
			click: function(fn) {
				$(this).on('click', fn);
			}
		});
	}
});