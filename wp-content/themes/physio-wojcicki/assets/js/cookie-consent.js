(function () {
	'use strict';

	const banner = document.getElementById('cookie-consent-banner');
	const settingsButton = document.getElementById('cookie-settings-button');
	const acceptButton = document.getElementById('cookie-consent-accept');
	const rejectButton = document.getElementById('cookie-consent-reject');

	if (!banner || !settingsButton || !acceptButton || !rejectButton) {
		return;
	}

	const storageKey = 'physioWojcickiCookieConsent';
	const consentDuration = 180 * 24 * 60 * 60 * 1000;
	const fontStylesheetId = 'physio-google-fonts';
	let sessionChoice = null;
	let fontsEnabled = false;
	let openedFromSettings = false;

	function readChoice() {
		try {
			const storedChoice = window.localStorage.getItem(storageKey);

			if (!storedChoice) {
				return sessionChoice;
			}

			const consent = JSON.parse(storedChoice);

			if (
				(consent.choice === 'accepted' || consent.choice === 'rejected') &&
				numberIsValid(consent.expiresAt) &&
				consent.expiresAt > Date.now()
			) {
				return consent.choice;
			}

			window.localStorage.removeItem(storageKey);
		} catch (error) {
			return sessionChoice;
		}

		return sessionChoice;
	}

	function numberIsValid(value) {
		return typeof value === 'number' && Number.isFinite(value);
	}

	function saveChoice(choice) {
		sessionChoice = choice;

		try {
			window.localStorage.setItem(
				storageKey,
				JSON.stringify({
					choice: choice,
					expiresAt: Date.now() + consentDuration,
				})
			);
		} catch (error) {
			// Keep the choice for this page view when browser storage is unavailable.
		}
	}

	function loadGoogleFonts() {
		if (document.getElementById(fontStylesheetId)) {
			fontsEnabled = true;
			return;
		}

		const stylesheet = document.createElement('link');
		stylesheet.id = fontStylesheetId;
		stylesheet.rel = 'stylesheet';
		stylesheet.href = 'https://fonts.googleapis.com/css2?family=Caveat:wght@600&family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap';
		document.head.appendChild(stylesheet);
		fontsEnabled = true;
	}

	function setBannerVisibility(visible, moveFocus) {
		banner.hidden = !visible;
		settingsButton.setAttribute('aria-expanded', String(visible));

		if (visible && moveFocus) {
			acceptButton.focus();
		} else if (!visible && openedFromSettings) {
			settingsButton.focus();
			openedFromSettings = false;
		}
	}

	acceptButton.addEventListener('click', function () {
		saveChoice('accepted');
		loadGoogleFonts();
		setBannerVisibility(false, false);
	});

	rejectButton.addEventListener('click', function () {
		const revokeLoadedFonts = fontsEnabled;
		saveChoice('rejected');
		setBannerVisibility(false, false);

		if (revokeLoadedFonts) {
			window.location.reload();
		}
	});

	settingsButton.addEventListener('click', function () {
		openedFromSettings = true;
		setBannerVisibility(true, true);
	});

	const savedChoice = readChoice();

	if (savedChoice === 'accepted') {
		loadGoogleFonts();
		setBannerVisibility(false, false);
	} else if (savedChoice === 'rejected') {
		setBannerVisibility(false, false);
	} else {
		setBannerVisibility(true, false);
	}
})();