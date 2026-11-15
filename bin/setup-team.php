<?php
/**
 * One-time, repeatable team content import. Run with the site's PHP CLI:
 * php bin/setup-team.php
 * Existing employees and page content are never overwritten.
 */

if ( PHP_SAPI !== 'cli' ) {
	http_response_code( 403 );
	exit;
}

require dirname( __DIR__ ) . '/wp-load.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/media.php';
require_once ABSPATH . 'wp-admin/includes/image.php';

if ( ! post_type_exists( 'physio_team' ) ) {
	fwrite( STDERR, "The Physio Team must-use plugin is missing.\n" );
	exit( 1 );
}

/** Import a bundled image once, keeping the media library editable. */
function physio_team_import_image( $filename, $parent, $alt ) {
	$existing = get_posts(
		array(
			'post_type'      => 'attachment',
			'post_status'    => 'inherit',
			'posts_per_page' => 1,
			'meta_key'       => '_physio_team_source',
			'meta_value'     => $filename,
		)
	);
	if ( $existing ) {
		return $existing[0]->ID;
	}

	$source = get_template_directory() . '/assets/img/' . $filename;
	$temp   = wp_tempnam( basename( $filename ) );
	if ( ! $temp || ! copy( $source, $temp ) ) {
		if ( $temp ) {
			unlink( $temp );
		}
		throw new RuntimeException( 'Cannot prepare image: ' . $filename );
	}
	$id = media_handle_sideload( array( 'name' => basename( $filename ), 'tmp_name' => $temp ), $parent, $alt );
	if ( is_wp_error( $id ) ) {
		if ( file_exists( $temp ) ) {
			unlink( $temp );
		}
		throw new RuntimeException( $id->get_error_message() );
	}
	update_post_meta( $id, '_wp_attachment_image_alt', $alt );
	update_post_meta( $id, '_physio_team_source', $filename );
	return $id;
}

$employees = array(
	array( 'Sylwia Wojcicki', "Praxisinhaberin\nOsteopathin für Säuglinge, Kinder und Erwachsene\nManuelle Therapie", 'sylwia-wojcicki', true ),
	array( 'Roman Wojcicki', 'Physiotherapeut', 'roman-wojcicki', true ),
	array( 'Pawel Wojcicki', 'Osteopath D.O. und Manualtherapeut', '', false ),
	array( 'Ilyada Akaydin', 'Physiotherapeutin', 'ilyada-akaydin', false ),
	array( 'Skadi Briest', 'Physiotherapeutin, Manualtherapeutin', 'skadi-briest', false ),
	array( 'Serap Ilhan', 'Physiotherapeutin', 'serap-ilhan', false ),
	array( 'Micela Klischies', 'Anmeldung und Praxisorganisation', 'micela-klischies', false ),
	array( 'Agata Sokolowska', 'Anmeldung und Praxisorganisation', 'agata-sokolowska', false ),
);

try {
	foreach ( $employees as $index => $employee ) {
		$slug = sanitize_title( $employee[0] );
		$post = get_page_by_path( $slug, OBJECT, 'physio_team' );
		if ( ! $post ) {
			$id = wp_insert_post(
				array(
					'post_type'    => 'physio_team',
					'post_status'  => 'publish',
					'post_title'   => $employee[0],
					'post_name'    => $slug,
					'menu_order'   => ( $index + 1 ) * 10,
					'post_content' => 1 === $index ? '<p>Als ehemaliger polnischer Fußballnationalspieler nahm Roman Wojcicki an drei Weltmeisterschaften teil (1978, 1982 und 1986). 1982 wurde Polen WM-Dritter. Mit Hannover 96 gewann er 1992 den DFB-Pokal.</p>' : '',
					'meta_input'   => array(
						'_physio_team_role'     => $employee[1],
						'_physio_team_featured' => $employee[3],
						'_physio_team_seed_pending' => true,
					),
				),
				true
			);
			if ( is_wp_error( $id ) ) {
				throw new RuntimeException( $id->get_error_message() );
			}
			if ( 1 === $index ) {
				update_post_meta( $id, '_physio_team_link', 'https://de.wikipedia.org/wiki/Roman_W%C3%B3jcicki' );
				update_post_meta( $id, '_physio_team_link_label', 'Mehr über Romans Fußballkarriere' );
			}
		} else {
			$id = $post->ID;
		}
		if ( get_post_meta( $id, '_physio_team_seed_pending', true ) ) {
			if ( $employee[2] && ! has_post_thumbnail( $id ) ) {
				set_post_thumbnail( $id, physio_team_import_image( 'team/' . $employee[2] . '.jpg', $id, $employee[0] ) );
			}
			delete_post_meta( $id, '_physio_team_seed_pending' );
		}
		echo 'Ready: ' . $employee[0] . PHP_EOL;
	}

	$page = get_page_by_path( 'unser-team' );
	if ( ! $page ) {
		$page_id = wp_insert_post(
			array(
				'post_type'    => 'page',
				'post_status'  => 'publish',
				'post_name'    => 'unser-team',
				'post_title'   => 'Unser Team',
				'post_excerpt' => 'Kompetenz · Vertrauen · Menschlichkeit',
				'post_content' => '<p>Wir sind für Sie da – mit Erfahrung, persönlichem Engagement und einem offenen Ohr für Ihre Anliegen. Lernen Sie die Menschen hinter unserer Praxis kennen.</p>',
				'meta_input'   => array( '_wp_page_template' => 'page-unser-team.php', '_physio_team_seed_pending' => true ),
			),
			true
		);
		if ( is_wp_error( $page_id ) ) {
			throw new RuntimeException( $page_id->get_error_message() );
		}
	} else {
		$page_id = $page->ID;
	}
	if ( get_post_meta( $page_id, '_physio_team_seed_pending', true ) ) {
		if ( ! has_post_thumbnail( $page_id ) ) {
			set_post_thumbnail( $page_id, physio_team_import_image( 'hero-reception-wide.jpeg', $page_id, 'Empfang der Physiotherapiepraxis Wojcicki' ) );
		}
		delete_post_meta( $page_id, '_physio_team_seed_pending' );
	}

	$locations = get_nav_menu_locations();
	if ( ! empty( $locations['primary'] ) ) {
		$menu_id = $locations['primary'];
		$items   = wp_get_nav_menu_items( $menu_id ) ?: array();
		$found   = false;
		foreach ( $items as $item ) {
			if ( ( 'page' === $item->object && (int) $item->object_id === $page_id ) || untrailingslashit( $item->url ) === untrailingslashit( get_permalink( $page_id ) ) ) {
				$found = true;
			}
		}
		if ( ! $found ) {
			$result = wp_update_nav_menu_item( $menu_id, 0, array( 'menu-item-object-id' => $page_id, 'menu-item-object' => 'page', 'menu-item-type' => 'post_type', 'menu-item-status' => 'publish' ) );
			if ( is_wp_error( $result ) ) {
				throw new RuntimeException( $result->get_error_message() );
			}
		}
	}
	echo 'Team page: ' . get_permalink( $page_id ) . PHP_EOL;
} catch ( Throwable $error ) {
	fwrite( STDERR, $error->getMessage() . PHP_EOL );
	exit( 1 );
}