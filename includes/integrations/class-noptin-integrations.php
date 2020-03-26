<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * Handles integrations with other products and services
 *
 * @since       1.0.8
 */
class Noptin_Integrations {

	/**
	 * @var array Available Noptin integrations.
	 */
	public $integrations = array();

	/**
	 * Class Constructor.
	 */
	public function __construct() {

		// The base class for most integrations.
		require_once plugin_dir_path( __FILE__ ) . 'class-noptin-abstract-integration.php';
		require_once plugin_dir_path( __FILE__ ) . 'class-noptin-abstract-ecommerce-integration.php';

		if ( noptin_should_show_optins() ) {

			// Maybe ask users to subscribe to the newsletter after commenting...
			add_filter( 'comment_form_submit_field', array( $this, 'comment_form' ) );
			add_action( 'comment_post', array( $this, 'subscribe_commentor' ) );

			// Comment prompts.
			add_filter( 'comment_post_redirect', array( $this, 'comment_post_redirect' ), 10, 2 );

		}

		// Ninja forms integration.
		if ( class_exists( 'Ninja_Forms' ) ) {
			require_once plugin_dir_path( __FILE__ ) . 'class-noptin-ninja-forms.php';
		}

		// WPForms integration.
		add_action( 'wpforms_loaded', array( $this, 'load_wpforms_integration' ) );
		if ( did_action( 'wpforms_loaded' ) ) {
			$this->load_wpforms_integration();
		}

		// WooCommerce integration.
		if ( class_exists( 'WooCommerce' ) ) {
			require_once plugin_dir_path( __FILE__ ) . 'class-noptin-woocommerce.php';
			$this->integrations['woocommerce'] = new Noptin_WooCommerce();
		}

		// EDD integration.
		if ( class_exists( 'Easy_Digital_Downloads' ) ) {
			require_once plugin_dir_path( __FILE__ ) . 'class-noptin-edd.php';
			$this->integrations['edd'] = new Noptin_EDD();
		}

		// WP Registration form integration.
		require_once plugin_dir_path( __FILE__ ) . 'class-noptin-wp-registration-form.php';
		$this->integrations['wp_registration_form'] = new Noptin_WP_Registration_Form();

	}

	/**
	 * Loads WPForms integration
	 *
	 * @access      public
	 * @since       1.2.6
	 */
	public function load_wpforms_integration() {
		require_once plugin_dir_path( __FILE__ ) . 'class-noptin-wpforms.php';
		new Noptin_WPForms();
	}

	/**
	 * Maybe ask users to subscribe to the newsletter after commenting
	 *
	 * @access      public
	 * @since       1.0.8
	 * @param       string $submit_field The html for the comment submit string.
	 * @return      string
	 */
	public function comment_form( $submit_field ) {

		if ( ! get_noptin_option( 'comment_form' ) ) {
			return $submit_field;
		}

		$text = get_noptin_option( 'comment_form_msg' );
		if ( empty( $text ) ) {
			$text = __( 'Add me to your newsletter and keep me updated whenever your publish new blog posts.', 'newsletter-optin-box' );
		}

		$checkbox = "<label class='comment-form-noptin'><input name='noptin-subscribe' type='checkbox' />$text</label>";

		return $checkbox . $submit_field;
	}

	/**
	 * Maybe subscribe a commentor
	 *
	 * @param       int $comment_id The id of the comment.
	 * @access      public
	 * @since       1.0.8
	 * @return      void
	 */
	public function subscribe_commentor( $comment_id ) {

		if ( ! get_noptin_option( 'comment_form' ) ) {
			return;
		}

		if ( isset( $_POST['noptin-subscribe'] ) ) {
			$author = get_comment_author( $comment_id );

			if ( 'Anonymous' === $author ) {
				$author = '';
			}

			$fields = array(
				'email'           => get_comment_author_email( $comment_id ),
				'name'            => $author,
				'_subscriber_via' => 'comment',
			);

			if ( ! is_string( add_noptin_subscriber( $fields ) ) ) {
				do_action( 'noptin_after_add_comment_subscriber' );
			}
		}

	}

	/**
	 * Redirect to a custom URL after a comment is submitted
	 * Added query arg used for displaying prompt
	 *
	 * @param string $location Redirect URL.
	 * @param object $comment Comment object.
	 * @return string $location New redirect URL
	 */
	function comment_post_redirect( $location, $comment ) {

		$location = add_query_arg(
			array(
				'noptin_comment_added' => $comment->comment_ID,
			),
			$location
		);

		return $location;
	}


}