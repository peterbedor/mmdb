Wee.fn.make('search', {
	init: function() {
		this.$private.search();
	}
}, {
	search: function() {
		var scope = this,
			$results = $('ref:searchResults'),
			isActive = '-is-active';

		$('ref:searchForm').on('submit', function(e) {
			scope.sendRequest();

			scope.pagination();

			$results.show();

			setTimeout(function() {
				$results.addClass(isActive);
			}, 50);

			e.preventDefault();
		});

		$('ref:resultsClose').on('click', function() {
			$results.removeClass(isActive);

			setTimeout(function() {
				$results.hide();
			}, 50);
		}, {
			delegate: 'ref:results'
		});
	},
	sendRequest: function(page) {
		var scope = this,
			data = scope.getData().data;

		if (page) {
			data = data + '&page=' + page;
		}

		Wee.data.request({
			url: scope.getData().url,
			method: 'post',
			data: data,
			success: function(data) {
				var obj = JSON.parse(data),
					page = obj.results.page,
					totalPages = obj.results.total_pages,
					hasNext = true,
					hasPrev = false;

				if (page === totalPages) {
					hasNext = false;
				}

				if (page > 1) {
					hasPrev = true;
				}

				Wee.app.searchResults.$set({
					results: obj.results.results,
					page: page,
					totalResults: obj.results.total_results,
					totalPages: obj.results.total_pages,
					config: obj.config,
					hasNext: hasNext,
					hasPrev: hasPrev
				});

				$('ref:results').addClass('-is-active');
			}
		});
	},
	getData: function() {
		var $form = $('ref:searchForm');

		return {
			data: $form.serialize(),
			url: $form.attr('action')
		};
	},
	pagination: function() {
		var scope = this,
			$prev = $('ref:searchPaginationPrev'),
			$next = $('ref:searchPaginationNext');

		$next.on('click', function() {
			var $this = $(this),
				page = $this.data('page'),
				totalPages = $this.data('pages');

			if (page <= totalPages) {
				scope.sendRequest(page);

				Wee.animate.tween('body', {
					scrollTop: 0
				});
			}
		}, {
			delegate: 'ref:results'
		});

		$prev.on('click', function() {
			var page = $(this).data('page');

			if (page !== 0) {
				scope.sendRequest(page);

				Wee.animate.tween('body', {
					scrollTop: 0
				});
			}
		}, {
			delegate: 'ref:results'
		});
	}
});