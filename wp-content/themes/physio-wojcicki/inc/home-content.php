<?php
/**
 * Editable front page texts (Customizer: "Startseite").
 *
 * @package Physio_Wojcicki
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Definition of all editable front page texts.
 *
 * @return array Sections with their fields: key => array( label, default, type ).
 */
function physio_wojcicki_home_fields() {
	static $fields = null;

	if ( null !== $fields ) {
		return $fields;
	}

	$fields = array(
		'hero'     => array(
			'title'  => 'Startseite: Hero-Bereich',
			'fields' => array(
				'hero_eyebrow'     => array( 'Kleiner Text über der Überschrift', 'Bewegung · Gesundheit · Lebensqualität', 'text' ),
				'hero_title'       => array( 'Überschrift', 'Gemeinsam in Bewegung.', 'text' ),
				'hero_subtitle'    => array( 'Unterüberschrift', 'Ihre Physiotherapiepraxis in Neustadt am Rübenberge.', 'text' ),
				'hero_text'        => array( 'Beschreibung', 'Wir begleiten Sie auf dem Weg zu mehr Beweglichkeit, weniger Schmerzen und einem aktiven Leben – mit Erfahrung, Fachkompetenz und Zeit für Sie.', 'textarea' ),
				'hero_button'      => array( 'Button „Termin“', 'Termin vereinbaren', 'text' ),
				'hero_image_alt'   => array( 'Bildbeschreibung (Alt-Text) Hero-Bild', 'Empfang der Physiotherapiepraxis Wojcicki', 'text' ),
				'hero_badge'       => array( 'Badge-Text auf dem Bild', 'Gesundheit in guten Händen.', 'text' ),
			),
		),
		'services' => array(
			'title'  => 'Startseite: Leistungen',
			'fields' => array(
				'services_eyebrow' => array( 'Kleiner Text über der Überschrift', 'Unsere Leistungen', 'text' ),
				'services_title'   => array( 'Überschrift', 'Gezielte Therapie für mehr Lebensqualität.', 'text' ),
				'services_text'    => array( 'Einleitungstext', 'Wir bieten Ihnen ein breites Spektrum an bewährten physiotherapeutischen Methoden – individuell auf Ihre Bedürfnisse abgestimmt.', 'textarea' ),
				'service_1_title'  => array( 'Leistung 1: Titel', 'Physiotherapie', 'text' ),
				'service_1_text'   => array( 'Leistung 1: Text', 'Individuelle Behandlung für mehr Beweglichkeit und weniger Schmerzen.', 'textarea' ),
				'service_2_title'  => array( 'Leistung 2: Titel', 'Manuelle Therapie', 'text' ),
				'service_2_text'   => array( 'Leistung 2: Text', 'Gezielte, sanfte Techniken bei Funktionsstörungen und Beschwerden.', 'textarea' ),
				'service_3_title'  => array( 'Leistung 3: Titel', 'Manuelle Lymphdrainage', 'text' ),
				'service_3_text'   => array( 'Leistung 3: Text', 'Unterstützt den Abfluss, reduziert Schwellungen und fördert das Wohlbefinden.', 'textarea' ),
				'service_4_title'  => array( 'Leistung 4: Titel', 'Osteopathische Medizin', 'text' ),
				'service_4_text'   => array( 'Leistung 4: Text', 'Ganzheitliche Betrachtung des Bewegungsapparates.', 'textarea' ),
				'service_5_title'  => array( 'Leistung 5: Titel', 'Trainingstherapie', 'text' ),
				'service_5_text'   => array( 'Leistung 5: Text', 'Individuell, sicher und wirkungsvoll.', 'textarea' ),
			),
		),
		'gallery'  => array(
			'title'  => 'Startseite: Unsere Praxis',
			'fields' => array(
				'gallery_eyebrow'  => array( 'Kleiner Text über der Überschrift', 'Unsere Praxis', 'text' ),
				'gallery_title'    => array( 'Überschrift', 'Helle und freundliche Räume für Ihre Gesundheit.', 'text' ),
				'gallery_text'     => array( 'Einleitungstext', 'In unserer Praxis in Neustadt am Rübenberge erwarten Sie moderne Behandlungsräume und ein Trainingsbereich mit aktuellen Geräten – für eine angenehme und effektive Therapie in ruhiger Atmosphäre.', 'textarea' ),
				'gallery_button'   => array( 'Button-Text', 'Unsere Praxis entdecken', 'text' ),
				'gallery_1_label'  => array( 'Bild 1: Beschriftung', 'Unsere Behandlungsräume', 'text' ),
				'gallery_1_alt'    => array( 'Bild 1: Alt-Text', 'Behandlungsraum mit Therapieliege', 'text' ),
				'gallery_2_label'  => array( 'Bild 2: Beschriftung', 'Aktiv und beweglich bleiben', 'text' ),
				'gallery_2_alt'    => array( 'Bild 2: Alt-Text', 'Trainingsbereich mit Sprossenwand', 'text' ),
				'gallery_3_label'  => array( 'Bild 3: Beschriftung', 'Individuelle Therapie', 'text' ),
				'gallery_3_alt'    => array( 'Bild 3: Alt-Text', 'Heller Behandlungsraum mit Therapieliege', 'text' ),
				'gallery_4_label'  => array( 'Bild 4: Beschriftung', 'So finden Sie uns', 'text' ),
				'gallery_4_alt'    => array( 'Bild 4: Alt-Text', 'Außenansicht der Praxis Wojcicki', 'text' ),
			),
		),
		'usps'     => array(
			'title'  => 'Startseite: Vorteile',
			'fields' => array(
				'usps_title' => array( 'Überschrift', 'Ihr Weg zu mehr Lebensqualität.', 'text' ),
				'usp_1'      => array( 'Vorteil 1', 'Individuelle Behandlung', 'text' ),
				'usp_2'      => array( 'Vorteil 2', 'Zeit für Ihre Anliegen', 'text' ),
				'usp_3'      => array( 'Vorteil 3', 'Moderne und freundliche Praxisräume', 'text' ),
				'usp_4'      => array( 'Vorteil 4', 'Barrierefreier Zugang und Parkplätze', 'text' ),
				'usp_5'      => array( 'Vorteil 5', 'Zentrale Lage mit Bushaltestelle direkt vor der Praxis', 'text' ),
			),
		),
	);

	return $fields;
}

/**
 * Get an editable front page text (falls back to the default text).
 *
 * @param string $key Field key.
 * @return string
 */
function physio_wojcicki_home_text( $key ) {
	foreach ( physio_wojcicki_home_fields() as $section ) {
		if ( isset( $section['fields'][ $key ] ) ) {
			$value = get_theme_mod( 'physio_home_' . $key, $section['fields'][ $key ][1] );
			return '' === trim( (string) $value ) ? $section['fields'][ $key ][1] : (string) $value;
		}
	}

	return '';
}

/**
 * Register Customizer sections and controls.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager.
 */
function physio_wojcicki_home_customize_register( $wp_customize ) {
	$wp_customize->add_panel(
		'physio_home',
		array(
			'title'    => 'Startseite: Texte',
			'priority' => 30,
		)
	);

	foreach ( physio_wojcicki_home_fields() as $section_id => $section ) {
		$wp_customize->add_section(
			'physio_home_' . $section_id,
			array(
				'title' => $section['title'],
				'panel' => 'physio_home',
			)
		);

		foreach ( $section['fields'] as $key => $field ) {
			$wp_customize->add_setting(
				'physio_home_' . $key,
				array(
					'default'           => $field[1],
					'sanitize_callback' => 'textarea' === $field[2] ? 'sanitize_textarea_field' : 'sanitize_text_field',
					'transport'         => 'refresh',
				)
			);
			$wp_customize->add_control(
				'physio_home_' . $key,
				array(
					'label'   => $field[0],
					'section' => 'physio_home_' . $section_id,
					'type'    => $field[2],
				)
			);
		}
	}
}
add_action( 'customize_register', 'physio_wojcicki_home_customize_register' );
