/**
 * Mobile navigation (hamburger menu) toggle.
 */
( function () {
	'use strict';

	document.addEventListener( 'DOMContentLoaded', function () {
		var toggle = document.getElementById( 'menu-toggle' );
		var menu = document.getElementById( 'mobile-menu' );
		var iconOpen = document.getElementById( 'icon-open' );
		var iconClose = document.getElementById( 'icon-close' );

		if ( ! toggle || ! menu ) {
			return;
		}

		toggle.addEventListener( 'click', function () {
			var isOpen = menu.classList.contains( 'max-h-screen' );

			if ( isOpen ) {
				menu.classList.remove( 'max-h-screen' );
				menu.classList.add( 'max-h-0' );
				toggle.setAttribute( 'aria-expanded', 'false' );
			} else {
				menu.classList.remove( 'max-h-0' );
				menu.classList.add( 'max-h-screen' );
				toggle.setAttribute( 'aria-expanded', 'true' );
			}

			if ( iconOpen && iconClose ) {
				iconOpen.classList.toggle( 'hidden' );
				iconClose.classList.toggle( 'hidden' );
			}
		} );

		// Close the mobile menu when a link inside it is clicked.
		menu.querySelectorAll( 'a' ).forEach( function ( link ) {
			link.addEventListener( 'click', function () {
				menu.classList.remove( 'max-h-screen' );
				menu.classList.add( 'max-h-0' );
				toggle.setAttribute( 'aria-expanded', 'false' );
				if ( iconOpen && iconClose ) {
					iconOpen.classList.remove( 'hidden' );
					iconClose.classList.add( 'hidden' );
				}
			} );
		} );
	} );
} )();
