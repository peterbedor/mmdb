Wee.fn.make('movie',{
	init: function() {
		this.$private.removeMovie();
	}
}, {
	removeMovie: function() {
		var $movieDeleteForm = $('ref:movieDeleteForm');

		$('ref:movieDelete').on('click', function() {
			$movieDeleteForm.toggle();
		});

		$('ref:movieDeleteCancel').on('click', function() {
			$movieDeleteForm.toggle();
		});
	}
});