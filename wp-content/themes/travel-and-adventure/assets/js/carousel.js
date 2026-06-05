(function () {
	function initCarousel(carousel) {
		var track = carousel.querySelector('.taa-post-carousel__track');

		if (!track || track.dataset.flkCarouselReady === 'true') {
			return;
		}

		var cards = Array.prototype.slice.call(track.children);

		if (cards.length < 2) {
			return;
		}

		track.dataset.flkCarouselReady = 'true';

		cards.forEach(function (card) {
			var clone = card.cloneNode(true);
			clone.setAttribute('aria-hidden', 'true');
			track.appendChild(clone);
		});

		carousel.classList.add('is-animated');
	}

	function init() {
		if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
			return;
		}

		document.querySelectorAll('.taa-post-carousel').forEach(initCarousel);
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', init);
	} else {
		init();
	}
})();
