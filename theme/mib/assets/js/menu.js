/* MIB — menu plein écran accessible (Échap, piège du focus, retour du focus). */
(function () {
	var btn = document.getElementById('mib-menu-btn'),
		panel = document.getElementById('mib-menu'),
		root = document.documentElement,
		last = null;
	if (!btn || !panel) return;

	function items() {
		return panel.querySelectorAll('a[href],button');
	}
	function open() {
		last = document.activeElement;
		panel.hidden = false;
		requestAnimationFrame(function () { panel.classList.add('is-open'); });
		btn.setAttribute('aria-expanded', 'true');
		root.classList.add('menu-open');
		items()[0].focus();
	}
	function close() {
		panel.classList.remove('is-open');
		btn.setAttribute('aria-expanded', 'false');
		root.classList.remove('menu-open');
		setTimeout(function () { panel.hidden = true; }, 200);
		(last || btn).focus();
	}

	btn.addEventListener('click', open);
	panel.addEventListener('click', function (e) {
		if (e.target.closest('[data-close]')) close();
	});
	document.addEventListener('keydown', function (e) {
		if (panel.hidden) return;
		if (e.key === 'Escape') { close(); return; }
		if (e.key !== 'Tab') return;
		var el = items(), first = el[0], end = el[el.length - 1];
		if (e.shiftKey && document.activeElement === first) { e.preventDefault(); end.focus(); }
		else if (!e.shiftKey && document.activeElement === end) { e.preventDefault(); first.focus(); }
	});
})();
