<?php
/**
 * Physio Wojcicki theme functions and definitions.
 *
 * @package Physio_Wojcicki
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'PHYSIO_WOJCICKI_VERSION', '1.0.0' );

/**
 * Theme setup.
 */
function physio_wojcicki_setup() {
	// Make theme available for translation.
	load_theme_textdomain( 'physio-wojcicki', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );

	// Switch default core markup to output valid HTML5.
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
			'navigation-widgets',
		)
	);

	// Add support for responsive embedded content.
	add_theme_support( 'responsive-embeds' );

	// Add theme support for custom logo.
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 80,
			'width'       => 240,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	// Register navigation menus.
	register_nav_menus(
		array(
			'primary' => __( 'Hauptmenü', 'physio-wojcicki' ),
			'footer'  => __( 'Footer-Menü', 'physio-wojcicki' ),
		)
	);

	// Custom image sizes used across the theme.
	add_image_size( 'physio-hero', 900, 1000, true );
	add_image_size( 'physio-gallery', 500, 500, true );
}
add_action( 'after_setup_theme', 'physio_wojcicki_setup' );

/**
 * Enqueue scripts and styles.
 */
function physio_wojcicki_scripts() {
	// Tailwind CSS via the Play CDN (no local build step required).
	wp_enqueue_script( 'tailwindcss', 'https://cdn.tailwindcss.com', array(), null, false );

	// Inline Tailwind configuration so brand tokens from the design guidelines are available as utilities.
	$tailwind_config = "tailwind.config = {
		theme: {
			extend: {
				colors: {
					accent: { DEFAULT: '#C85A32', dark: '#BD4F28' },
					secondary: { DEFAULT: '#1E4355', dark: '#163342' },
					cream: '#F9F6F0',
					mint: '#E8F2F4',
				},
				fontFamily: {
					serif: ['Playfair Display', 'serif'],
					sans: ['Inter', 'sans-serif'],
					script: ['Caveat', 'cursive'],
				},
			},
		},
	};";
	wp_add_inline_script( 'tailwindcss', $tailwind_config );

	// Theme stylesheet (fonts + small custom rules not covered by Tailwind utilities).
	wp_enqueue_style( 'physio-wojcicki-style', get_stylesheet_uri(), array(), PHYSIO_WOJCICKI_VERSION );

	// Mobile navigation toggle.
	wp_enqueue_script( 'physio-wojcicki-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), PHYSIO_WOJCICKI_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'physio_wojcicki_scripts' );

/**
 * Register widget areas.
 */
function physio_wojcicki_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Footer', 'physio-wojcicki' ),
			'id'            => 'footer-1',
			'description'   => __( 'Zusätzlicher Widget-Bereich im Footer.', 'physio-wojcicki' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title font-serif text-lg font-semibold mb-3">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'physio_wojcicki_widgets_init' );

/**
 * Fallback menu used while no "primary" menu has been assigned in
 * Appearance → Menus, so the navigation always matches the design.
 */
function physio_wojcicki_fallback_menu() {
	$items = array(
		'Startseite'        => home_url( '/' ),
		'Unsere Leistungen' => home_url( '/#leistungen' ),
		'Praxis'            => home_url( '/#praxis' ),
		'Kontakt'           => home_url( '/#kontakt' ),
	);

	echo '<ul class="flex flex-col gap-3 text-base font-medium lg:flex-row lg:items-center lg:gap-8 lg:text-sm">';
	foreach ( $items as $label => $url ) {
		$is_active = ( 'Startseite' === $label && is_front_page() );
		$classes   = $is_active
			? 'text-secondary font-semibold border-b-2 border-accent pb-1'
			: 'text-secondary hover:text-accent transition-colors';
		printf(
			'<li><a href="%1$s" class="%2$s">%3$s</a></li>',
			esc_url( $url ),
			esc_attr( $classes ),
			esc_html( $label )
		);
	}
	echo '</ul>';
}

/**
 * Practice contact details, centralised so header & footer stay in sync.
 */
function physio_wojcicki_contact( $key ) {
	$contact = array(
		'phone'       => '05034 926050',
		'phone_href'  => 'tel:+4950349260500',
		'address_1'   => 'Hagener Straße 54a',
		'address_2'   => '31535 Neustadt am Rübenberge',
		'email'       => 'info@physiotherapie-wojcicki.de',
	);

	return isset( $contact[ $key ] ) ? $contact[ $key ] : '';
}
