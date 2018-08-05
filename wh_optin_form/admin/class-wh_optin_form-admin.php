<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.linkedin.com/in/waqas-hassan98/
 * @since      1.0.0
 *
 * @package    Wh_optin_form
 * @subpackage Wh_optin_form/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wh_optin_form
 * @subpackage Wh_optin_form/admin
 * @author     Waqas Hassa <waqashassan98@gmail.com>
 */
class Wh_optin_form_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wh_optin_form_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wh_optin_form_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wh_optin_form-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wh_optin_form_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wh_optin_form_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		//wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wh_optin_form-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function register_admin_page(){
		add_options_page( 'WH Optin Form', 'WH Optin Form', 'manage_options', 'optin_settings', array($this,'settings_page') );
		
	}

	public function settings_page(){
		require_once plugin_dir_path( __FILE__ ) . 'partials/wh_optin_form-admin-display.php';
	}

	/**
	* Creates a new custom post type
	*
	* @since 1.0.0
	* @access public
	* @uses register_post_type()
	*/
	public function customer_post_type() {
		

		register_post_type( 'customer', array(
		  'labels' => array(
		    'name' 			=> 'Customers',
		    'singular_name' => 'Customer',
		   ),
		  'taxonomies'  	=> array('post_tag', 'category' ),
		  'description' 	=> 'Customers from Optin Form.',
		  'public' 			=> true,
		  'menu_position' 	=> 20,
		  'supports' 		=> array( 'title', 'editor', 'custom-fields' )
		));


	}


	/**
	* Add Custom Fields
	*
	* @since 1.0.0
	* @access public
	* @uses add_meta_box()
	*/
	public  function add_meta_fields() {
		add_meta_box(
			'wh_name',
			'Name',
			array($this, 'name_callback'),
			'customer',
			'normal',
			'default'
		);

		add_meta_box(
			'wh_phone',
			'Phone Number',
			array($this, 'phone_callback'),
			'customer',
			'normal',
			'default'
		);

		add_meta_box(
			'wh_email',
			'Email Address',
			array($this, 'email_callback'),
			'customer',
			'normal',
			'default'
		);

		add_meta_box(
			'wh_budget',
			'Desired Budget',
			array($this, 'budget_callback'),
			'customer',
			'normal',
			'default'
		);

		add_meta_box(
			'wh_message',
			'Message',
			array($this, 'message_callback'),
			'customer',
			'normal',
			'default'
		);

		add_meta_box(
			'wh_date_time',
			'Date/Time',
			array($this, 'date_time_callback'),
			'customer',
			'normal',
			'default'
		);

	}

	// Callbacks
	public function name_callback(){
		global $post;
		// Nonce field to validate form request came from current site
		wp_nonce_field( basename( __FILE__ ), 'customer_fields' );
		// Get the location data if it's already been entered
		$name = get_post_meta( $post->ID, 'wh_name', true );
		// Output the field
		echo '<input type="text" name="wh_name" value="' . esc_textarea( $name )  . '" class="wide">';
	}

	public function phone_callback(){
		global $post;
		// Nonce field to validate form request came from current site
		wp_nonce_field( basename( __FILE__ ), 'customer_fields' );
		// Get the location data if it's already been entered
		$phone = get_post_meta( $post->ID, 'wh_phone', true );
		// Output the field
		echo '<input type="text" name="wh_phone" value="' . esc_textarea( $phone )  . '" class="wide">';
	}

	public function email_callback(){
		global $post;
		// Nonce field to validate form request came from current site
		wp_nonce_field( basename( __FILE__ ), 'customer_fields' );
		// Get the location data if it's already been entered
		$email = get_post_meta( $post->ID, 'wh_email', true );
		// Output the field
		echo '<input type="text" name="wh_email" value="' . esc_textarea( $email )  . '" class="wide">';
	}

	public function budget_callback(){
		global $post;
		// Nonce field to validate form request came from current site
		wp_nonce_field( basename( __FILE__ ), 'customer_fields' );
		// Get the location data if it's already been entered
		$budget = get_post_meta( $post->ID, 'wh_budget', true );
		// Output the field
		echo '<input type="text" name="wh_budget" value="' . esc_textarea( $budget )  . '" class="wide">';
	}

	public function message_callback(){
		global $post;
		// Nonce field to validate form request came from current site
		wp_nonce_field( basename( __FILE__ ), 'customer_fields' );
		// Get the location data if it's already been entered
		$message = get_post_meta( $post->ID, 'wh_message', true );
		// Output the field
		echo '<input type="text" name="wh_message" value="' . esc_textarea( $message )  . '" class="wide">';
	}

	public function date_time_callback(){
		global $post;
		// Nonce field to validate form request came from current site
		wp_nonce_field( basename( __FILE__ ), 'customer_fields' );
		// Get the location data if it's already been entered
		$date_time = get_post_meta( $post->ID, 'wh_date_time', true );
		// Output the field
		echo '<input type="text" name="wh_date_time" value="' . esc_textarea( $date_time )  . '" class="wide">';
	}



	//Saving
	function wh_save_customers_meta( $post_id, $post ) {
		// Return if the user doesn't have edit permissions.
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}
		// Verify this came from the our screen and with proper authorization,
		// because save_post can be triggered at other times.
		if ( ! isset( $_POST['customer_fields'] ) || ! wp_verify_nonce( $_POST['customer_fields'], basename(__FILE__) ) ) {
			return $post_id;
		}
		// Now that we're authenticated, time to save the data.
		// This sanitizes the data from the field and saves it into an array $events_meta.
		$events_meta['wh_name'] = esc_textarea( $_POST['wh_name'] );
		$events_meta['wh_phone'] = esc_textarea( $_POST['wh_phone'] );
		$events_meta['wh_email'] = esc_textarea( $_POST['wh_email'] );
		$events_meta['wh_budget'] = esc_textarea( $_POST['wh_budget'] );
		$events_meta['wh_message'] = esc_textarea( $_POST['wh_message'] );
		$events_meta['wh_date_time'] = esc_textarea( $_POST['wh_date_time'] );




		// Cycle through the $events_meta array.
		// Note, in this example we just have one item, but this is helpful if you have multiple.
		foreach ( $events_meta as $key => $value ) :
			// Don't store custom data twice
			if ( 'revision' === $post->post_type ) {
				return;
			}
			if ( get_post_meta( $post_id, $key, false ) ) {
				// If the custom field already has a value, update it.
				update_post_meta( $post_id, $key, $value );
			} else {
				// If the custom field doesn't have a value, add it.
				add_post_meta( $post_id, $key, $value);
			}
			if ( ! $value ) {
				// Delete the meta key if there's no value
				delete_post_meta( $post_id, $key );
			}
		endforeach;
	}

}
