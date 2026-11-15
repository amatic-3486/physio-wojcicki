<?php
/**
 * Plugin Name: Physio Team
 * Description: Mitarbeiter und Teamangaben für die Physiotherapie-Praxis.
 * Version: 1.0.0
 * Text Domain: physio-wojcicki
 *
 * @package Physio_Wojcicki
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Restrict team REST reads to users who may manage the requested content.
 */
class Physio_Team_REST_Controller extends WP_REST_Posts_Controller {
	/**
	 * Check whether the current user may list employees.
	 *
	 * @param WP_REST_Request $request Current request.
	 * @return bool|WP_Error
	 */
	public function get_items_permissions_check( $request ) {
		$post_type = get_post_type_object( $this->post_type );

		if ( ! current_user_can( $post_type->cap->edit_posts ) ) {
			return new WP_Error(
				'rest_cannot_view',
				__( 'Du darfst die Teamliste nicht ansehen.', 'physio-wojcicki' ),
				array( 'status' => rest_authorization_required_code() )
			);
		}

		return parent::get_items_permissions_check( $request );
	}

	/**
	 * Check whether the current user may read this employee.
	 *
	 * @param WP_REST_Request $request Current request.
	 * @return bool|WP_Error
	 */
	public function get_item_permissions_check( $request ) {
		if ( ! current_user_can( 'edit_post', (int) $request['id'] ) ) {
			return new WP_Error(
				'rest_cannot_view',
				__( 'Du darfst diesen Mitarbeiter nicht ansehen.', 'physio-wojcicki' ),
				array( 'status' => rest_authorization_required_code() )
			);
		}

		return parent::get_item_permissions_check( $request );
	}
}

/**
 * Register the team content type and its REST metadata.
 */
function physio_team_register() {
	register_post_type(
		'physio_team',
		array(
			'labels'                => array(
				'name'               => __( 'Unser Team', 'physio-wojcicki' ),
				'singular_name'      => __( 'Mitarbeiter', 'physio-wojcicki' ),
				'menu_name'          => __( 'Unser Team', 'physio-wojcicki' ),
				'add_new'            => __( 'Hinzufügen', 'physio-wojcicki' ),
				'add_new_item'       => __( 'Mitarbeiter hinzufügen', 'physio-wojcicki' ),
				'edit_item'          => __( 'Mitarbeiter bearbeiten', 'physio-wojcicki' ),
				'new_item'           => __( 'Neuer Mitarbeiter', 'physio-wojcicki' ),
				'all_items'          => __( 'Alle Mitarbeiter', 'physio-wojcicki' ),
				'search_items'       => __( 'Mitarbeiter suchen', 'physio-wojcicki' ),
				'not_found'          => __( 'Keine Mitarbeiter gefunden.', 'physio-wojcicki' ),
				'not_found_in_trash' => __( 'Keine Mitarbeiter im Papierkorb gefunden.', 'physio-wojcicki' ),
			),
			'public'                => false,
			'publicly_queryable'    => false,
			'exclude_from_search'   => true,
			'show_ui'               => true,
			'show_in_rest'          => true,
			'rest_controller_class' => 'Physio_Team_REST_Controller',
			'show_in_nav_menus'     => false,
			'has_archive'           => false,
			'rewrite'               => false,
			'query_var'             => false,
			'menu_icon'             => 'dashicons-groups',
			'supports'              => array( 'title', 'editor', 'thumbnail', 'page-attributes', 'custom-fields' ),
		)
	);

	$fields = array(
		'_physio_team_role'       => array( 'string', 'sanitize_textarea_field', '' ),
		'_physio_team_featured'   => array( 'boolean', 'rest_sanitize_boolean', false ),
		'_physio_team_link'       => array( 'string', 'esc_url_raw', '' ),
		'_physio_team_link_label' => array( 'string', 'sanitize_text_field', '' ),
	);

	foreach ( $fields as $key => $field ) {
		register_post_meta(
			'physio_team',
			$key,
			array(
				'type'              => $field[0],
				'single'            => true,
				'default'           => $field[2],
				'show_in_rest'      => true,
				'sanitize_callback' => $field[1],
				'auth_callback'     => 'physio_team_authorize_meta',
			)
		);
	}
}
add_action( 'init', 'physio_team_register' );

/**
 * Restrict protected metadata to users who may edit this employee.
 *
 * @param bool   $allowed  Existing authorization result.
 * @param string $meta_key Metadata key.
 * @param int    $post_id  Employee ID.
 * @return bool
 */
function physio_team_authorize_meta( $allowed, $meta_key, $post_id ) {
	return 'physio_team' === get_post_type( $post_id ) && current_user_can( 'edit_post', $post_id );
}

/**
 * Enable team portraits without removing other thumbnail support.
 */
function physio_team_setup_images() {
	$support = get_theme_support( 'post-thumbnails' );

	if ( false === $support ) {
		add_theme_support( 'post-thumbnails' );
	} elseif ( isset( $support[0] ) && is_array( $support[0] ) && ! in_array( 'physio_team', $support[0], true ) ) {
		add_theme_support( 'post-thumbnails', array_merge( $support[0], array( 'physio_team' ) ) );
	}

	add_image_size( 'physio-team-portrait', 480, 480, true );
}
add_action( 'after_setup_theme', 'physio_team_setup_images', 20 );

/**
 * Add employee details to both classic and block editor screens.
 */
function physio_team_add_meta_boxes() {
	add_meta_box(
		'physio-team-details',
		__( 'Teamangaben', 'physio-wojcicki' ),
		'physio_team_render_meta_box',
		'physio_team',
		'normal',
		'default',
		array( '__block_editor_compatible_meta_box' => true )
	);
}
add_action( 'add_meta_boxes_physio_team', 'physio_team_add_meta_boxes' );

/**
 * Render escaped fields and concise editing instructions.
 *
 * @param WP_Post $post Employee being edited.
 */
function physio_team_render_meta_box( $post ) {
	wp_nonce_field( 'physio_team_save_' . $post->ID, 'physio_team_nonce' );
	?>
	<p><?php esc_html_e( 'Name als Titel eingeben, die Biografie im Texteditor pflegen und ein Porträt als Beitragsbild festlegen. Unter „Seiten-Attribute“ die Reihenfolge bestimmen: kleinere Zahlen erscheinen zuerst.', 'physio-wojcicki' ); ?></p>
	<p>
		<label for="physio-team-role"><strong><?php esc_html_e( 'Funktion / Qualifikation', 'physio-wojcicki' ); ?></strong></label>
		<textarea id="physio-team-role" name="_physio_team_role" rows="3" class="widefat"><?php echo esc_textarea( get_post_meta( $post->ID, '_physio_team_role', true ) ); ?></textarea>
	</p>
	<p>
		<input type="hidden" name="_physio_team_featured" value="0">
		<label for="physio-team-featured">
			<input type="checkbox" id="physio-team-featured" name="_physio_team_featured" value="1" <?php checked( (bool) get_post_meta( $post->ID, '_physio_team_featured', true ) ); ?>>
			<?php esc_html_e( 'Mitarbeiter hervorheben', 'physio-wojcicki' ); ?>
		</label>
	</p>
	<p>
		<label for="physio-team-link"><strong><?php esc_html_e( 'Link (optional)', 'physio-wojcicki' ); ?></strong></label>
		<input type="url" id="physio-team-link" name="_physio_team_link" class="widefat" value="<?php echo esc_attr( get_post_meta( $post->ID, '_physio_team_link', true ) ); ?>">
	</p>
	<p>
		<label for="physio-team-link-label"><strong><?php esc_html_e( 'Linkbeschriftung', 'physio-wojcicki' ); ?></strong></label>
		<input type="text" id="physio-team-link-label" name="_physio_team_link_label" class="widefat" value="<?php echo esc_attr( get_post_meta( $post->ID, '_physio_team_link_label', true ) ); ?>">
	</p>
	<?php
}

/**
 * Save only submitted fields from a verified employee meta box.
 *
 * @param int $post_id Employee ID.
 */
function physio_team_save_meta( $post_id ) {
	if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || wp_is_post_autosave( $post_id ) || wp_is_post_revision( $post_id ) ) {
		return;
	}

	if ( 'physio_team' !== get_post_type( $post_id ) || ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( ! isset( $_POST['physio_team_nonce'] ) || ! is_string( $_POST['physio_team_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['physio_team_nonce'] ) ), 'physio_team_save_' . $post_id ) ) {
		return;
	}

	$fields = array( '_physio_team_role', '_physio_team_featured', '_physio_team_link', '_physio_team_link_label' );

	foreach ( $fields as $key ) {
		if ( ! isset( $_POST[ $key ] ) || ! is_string( $_POST[ $key ] ) ) {
			continue;
		}

		// Registered metadata sanitizers apply to classic saves as well as REST updates.
		update_post_meta( $post_id, $key, wp_slash( wp_unslash( $_POST[ $key ] ) ) );
	}
}
add_action( 'save_post_physio_team', 'physio_team_save_meta' );

/**
 * Default the employee list to the manually maintained display order.
 *
 * @param WP_Query $query Admin list query.
 */
function physio_team_admin_order( $query ) {
	if ( is_admin() && $query->is_main_query() && 'physio_team' === $query->get( 'post_type' ) && ! $query->get( 'orderby' ) ) {
		$query->set( 'orderby', array( 'menu_order' => 'ASC', 'title' => 'ASC' ) );
	}
}
add_action( 'pre_get_posts', 'physio_team_admin_order' );