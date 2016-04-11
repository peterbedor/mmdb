Wee.fn.make('common', {
	init: function() {
		this.$private.mobileNav();
	}
}, {
	mobileNav: function() {
		$('ref:mobileNavToggle').on('click', function() {
			$('ref:mobileNav').toggleClass('-is-active');
		});
	}
});