(function () {
	var toggle = document.querySelector('.taa-menu-toggle');
	var menu = document.querySelector('#taa-primary-menu');

	if (!toggle || !menu) {
		return;
	}

	toggle.addEventListener('click', function () {
		var expanded = toggle.getAttribute('aria-expanded') === 'true';

		toggle.setAttribute('aria-expanded', expanded ? 'false' : 'true');
		menu.classList.toggle('is-open', !expanded);
		document.body.classList.toggle('taa-menu-is-open', !expanded);
	});

	document.addEventListener('keyup', function (event) {
		if (event.key !== 'Escape' || toggle.getAttribute('aria-expanded') !== 'true') {
			return;
		}

		toggle.setAttribute('aria-expanded', 'false');
		menu.classList.remove('is-open');
		document.body.classList.remove('taa-menu-is-open');
		toggle.focus();
	});
})();
