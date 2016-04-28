Wee.fn.make('common', {
	init: function() {
		var scope = this;

		scope.$private.mobileNav();
		scope.$private.searchToggle();

		Wee.screen.map([
			{
				min: 3,
				callback: function() {
					$('ref:navigation').appendTo($('ref:headerNav'));
				}
			},
			{
				size: 2,
				callback: function() {
					$('ref:navigation').insertAfter($('ref:mobileNavClose'));
				}
			}
		]);
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
					$body.removeClass(isDisabled);

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
					$('ref:headerNav').toggleClass(isHidden);

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