<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.linkedin.com/in/waqas-hassan98/
 * @since      1.0.0
 *
 * @package    Wh_optin_form
 * @subpackage Wh_optin_form/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wh_optin_form
 * @subpackage Wh_optin_form/public
 * @author     Waqas Hassa <waqashassan98@gmail.com>
 */
class Wh_optin_form_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wh_optin_form-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wh_optin_form-public.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( "moment", plugin_dir_url( __FILE__ ) . 'js/moment.min.js', array( 'jquery' ), $this->version, false );
		wp_localize_script(	$this->plugin_name,	'ajax_submit_obj',	array( 'ajaxurl' => admin_url( 'admin-ajax.php' ),  'nonce' => wp_create_nonce( "unique_id_nonce" ) )	);


	}
	public function shortcode_form_generator($atts){
		
		$atts = shortcode_atts(
					array(
									'full_name' => 'Full Name|50',
									'email' => 'Email|100',
									'phone' => 'Phone Number|20',
									'budget' => 'Desired Budget|10',
									'message' => 'Message|3|150',
								), $atts, 'create_form' );

		/*
		[create_form full_name="Full Name|50" email="Email|100" phone="Phone Number|20" budget="Desired Budget|10" message="Message|3|150"]
			
		*/

		$atts["full_name"]	= explode("|", $atts["full_name"]);  
		$atts["email"] 		= explode("|", $atts["email"]);
		$atts["phone"] 		= explode("|", $atts["phone"]);
		$atts["budget"] 	= explode("|", $atts["budget"]);
		$atts["message"] 	= explode("|", $atts["message"]);

	 	require_once plugin_dir_path( __FILE__ ) . 'partials/wh_optin_form-public-display.php';
	}

	public function shortcode_form_submission_handler(){


		$full_name  = filter_var($_POST['full_name'], FILTER_SANITIZE_STRING);
		$email 		= filter_var($_POST['u_email'], FILTER_SANITIZE_EMAIL);
		$phone 		= filter_var($_POST['phone_num'], FILTER_SANITIZE_STRING);
		$budget 	= filter_var($_POST['budget'], FILTER_SANITIZE_NUMBER_FLOAT);
		$message	= filter_var($_POST['u_message'], FILTER_SANITIZE_STRING);
		$date_time 	= filter_var($_POST['dt'], FILTER_SANITIZE_STRING);

		if (empty($full_name)||empty($email)||empty($phone)||empty($budget)||empty($message)||empty($date_time)) {
			$msg = "All Field Values are Required";
			header('HTTP/1.1 500 Internal Server Error');
	        header('Content-Type: application/json; charset=UTF-8');
	        die(json_encode(array('msg' => $msg, 'code' => 2)));
		}

		$my_post = array(
					  'post_title'    => $full_name,
					  'post_content'  => "Customer Details",
					  'post_status'   => 'publish',
					  'post_author'   => 1,
					  'post_type'	  => "customer",
					  'meta_input'    => array(
					        'wh_name' 		=> $full_name,
					        'wh_phone'		=> $phone,
					        'wh_email' 		=> $email,
					        'wh_message' 	=> $message,
					        'wh_budget'  	=> $budget,
					        'wh_date_time'  => $date_time					        
					    ),
					);
	 
		// Insert the post into the database
		$post_ID = wp_insert_post( $my_post );
		if ($post_ID!=0) {
			$msg = "Success";
			header('Content-Type: application/json');
        	print json_encode($msg);
		}
		else{
			$msg = "Error Establishing Network Connection. Kindly Email the admin from your mailbox.";
			header('HTTP/1.1 500 Internal Server Error');
	        header('Content-Type: application/json; charset=UTF-8');
	        die(json_encode(array('msg' => $msg, 'code' => 5)));
			
		}
		die();
	}

}
