(function($) {

	var	$window = $(window),
		$body = $('body'),
		$head = $('#head'),
		$header = $('#header'),
		$footer = $('#footer'),
		$main = $('#main'),
		$main_articles = $main.children('article');

	//! // Breakpoints.
	// 	breakpoints({
	// 		xlarge:   [ '1281px',  '1680px' ],
	// 		large:    [ '981px',   '1280px' ],
	// 		medium:   [ '737px',   '980px'  ],
	// 		small:    [ '481px',   '736px'  ],
	// 		xsmall:   [ '361px',   '480px'  ],
	// 		xxsmall:  [ null,      '360px'  ]
	// 	})

	$window.on('load', function() {
		window.setTimeout(function() {
			$body.removeClass('is-preload');
		}, 100);
	});

	//! // Fix: Flexbox min-height bug on IE.
	// 	if (browser.name == 'ie') {
	// 		var flexboxFixTimeoutId;
	// 		$window.on('resize.flexbox-fix', function() {
	// 			clearTimeout(flexboxFixTimeoutId);
	// 			flexboxFixTimeoutId = setTimeout(function() {
	// 				if ($wrapper.prop('scrollHeight') > $window.height())
	// 					$wrapper.css('height', 'auto');
	// 				else
	// 					$wrapper.css('height', '100vh');
	// 			}, 250);
	// 		}).triggerHandler('resize.flexbox-fix');
	// 	}

	// Nav.
	var $nav = $header.children('nav'),
		$nav_li = $nav.find('li');
	if ($nav_li.length % 2 == 0) {

		$nav.addClass('use-middle');
		$nav_li.eq( ($nav_li.length / 2) ).addClass('is-middle');

	}

	// Main.
	var	delay = 500,
		locked = false;

	// Methods.
	$main._show = function(id) { // $main._show = function(id,initial) {
		var $article = $main_articles.filter('#' + id);

		if ($article.length == 0)
			return;

		//! // Already locked? Speed through "show" steps w/o delays.
		// if (locked || (typeof initial != 'undefined' && initial === true)) {
		// 	// Mark as switching.
		// 	$body.addClass('is-switching');
		// 	// Mark as visible.
		// 	$body.addClass('is-article-visible');
		// 	// Deactivate all articles (just in case one's already active).
		// 	$main_articles.removeClass('active');
		// 	// Hide header, footer.
		// 	$header.hide();
		// 	$head.hide();
		// 	$footer.hide();
		// 	// Show main, article.
		// 	$main.show();
		// 	$article.show();
		// 	// Activate article.
		// 	$article.addClass('active');
		// 	// Unlock.
		// 	locked = false;
		// 	setTimeout(function() {
		// 		$body.removeClass('is-switching');
		// 	}, (initial ? 1000 : 0));
		// 	return;
		// }

		// Lock.
		// locked = true;

		// Article already visible? Just swap articles.
		if ($body.hasClass('is-article-visible')) {
			// Deactivate current article.
			var $currentArticle = $main_articles.filter('.active');
			$currentArticle.removeClass('active');
			
			// Show article
			setTimeout(function() {
				$currentArticle.hide();
				$article.show();
				setTimeout(function() {
					$article.addClass('active');
					$window
						.scrollTop(0)
						.triggerHandler('resize.flexbox-fix');
					setTimeout(function() {
						locked = false;
					}, delay);
				}, 25);
			}, delay);

		}
		// Otherwise, handle as normal.
		else {
			
			// Mark as visible.
			$body.addClass('is-article-visible');

			// Show article.
			setTimeout(function() {
				$header.hide();
				$head.hide();
				$footer.hide();
				$main.show();
				$article.show();
				setTimeout(function() {
					$article.addClass('active');
					$window
						.scrollTop(0)
						.triggerHandler('resize.flexbox-fix');
					setTimeout(function() {
						locked = false;
					}, delay);
				}, 25);
			}, delay);
		}
	};

	$main._hide = function(addState) {

		var $article = $main_articles.filter('.active');

		if (!$body.hasClass('is-article-visible'))
			return;

		if (typeof addState != 'undefined' &&	addState === true)
			history.pushState(null, null, '#');
		
		if (locked) {
			// Mark as switching.
			$body.addClass('is-switching');
			// Deactivate article.
			$article.removeClass('active');
			// Hide article, main.
			$article.hide();
			$main.hide();
			// Show footer, header.
			$header.show();
			$head.show();
			$footer.show();
			// Unmark as visible.
			$body.removeClass('is-article-visible');
			// Unlock.
			locked = false;
			// Unmark as switching.
			$body.removeClass('is-switching');
			// Window stuff.
			$window
				.scrollTop(0)
				.triggerHandler('resize.flexbox-fix');
			return;
		}
		
		locked = true;
		$article.removeClass('active');
		
		setTimeout(function() {
			$article.hide();
			$main.hide();
			$header.show();
			$head.show();
			$footer.show();
			setTimeout(function() {
				$body.removeClass('is-article-visible');
				$window
					.scrollTop(0)
					.triggerHandler('resize.flexbox-fix');
				setTimeout(function() {
					locked = false;
				}, delay);
			}, 25);
		}, delay);
	};

	// Articles.
	$main_articles.each(function() {

		var $this = $(this);

		$('<div class="close">Close</div>')
			.appendTo($this)
			.on('click', function() {
				location.hash = '';
			});
		$this.on('click', function(event) {
			event.stopPropagation();
		});

	});

	// Events.
	$body.on('click', function(event) {

	if ($body.hasClass('is-article-visible'))
			$main._hide(true);
	});

	$window.on('keyup', function(event) {
		switch (event.keyCode) {
			case 27:
				if ($body.hasClass('is-article-visible'))
					$main._hide(true);
				break;
			default:
				break;
		}
	});

	$window.on('hashchange', function(event) {

		if (location.hash == ''	||	location.hash == '#') {
				event.preventDefault();
				event.stopPropagation();
				$main._hide();
		}
		else if ($main_articles.filter(location.hash).length > 0) {
				event.preventDefault();
				event.stopPropagation();
				$main._show(location.hash.substr(1));
		}
	});
	// Scroll restoration.
	if ('scrollRestoration' in history)
		history.scrollRestoration = 'manual';
	else {
		var	oldScrollPos = 0,
			scrollPos = 0,
			$htmlbody = $('html,body');
		$window
			.on('scroll', function() {
				oldScrollPos = scrollPos;
				scrollPos = $htmlbody.scrollTop();
			})
			.on('hashchange', function() {
				$window.scrollTop(oldScrollPos);
			});
	}
	// Initialize.
	$main.hide();
	$main_articles.hide();
	if (location.hash != ''	&&	location.hash != '#')
		$window.on('load', function() {
			$main._show(location.hash.substr(1), true);
		});
})(jQuery);