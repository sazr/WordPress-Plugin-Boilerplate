<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Newsletter_Builder_vD
 * @subpackage Newsletter_Builder_vD/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Newsletter_Builder_vD
 * @subpackage Newsletter_Builder_vD/admin
 * @author     Your Name <email@example.com>
 */
class Newsletter_Builder_vD_Admin {

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
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( 'wp-color-picker' );

        wp_enqueue_style( "vd-material-icons", 'https://fonts.googleapis.com/icon?family=Material+Icons', array(),$this->version, 'all' );

        wp_enqueue_style( "visual-designer-css", plugin_dir_url( __FILE__ ) . 'css/visual-designer.min.css', array(),$this->version, 'all' );

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/newsletter-builder-vd-admin.css', array(), $this->version, 'all' );

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
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */


		wp_enqueue_media();

        wp_enqueue_script('iris', admin_url('js/iris.min.js'),array('jquery-ui-draggable', 'jquery-ui-slider', 'jquery-touch-punch'), false, 1);
        wp_enqueue_script('wp-color-picker', admin_url('js/color-picker.min.js'), array('iris'), false,1);
        wp_enqueue_script( 'vd-colour-picker', plugin_dir_url( __FILE__ ) . 'js/vendor/vd-colour-picker.js', array( 'iris' ), '1.2.2', 1 );
        $colorpicker_l10n = array('clear' => __('Clear'), 'defaultString' => __('Default'), 'pick' => __('Select Color'));

        wp_localize_script( 'wp-color-picker', 'wpColorPickerL10n', $colorpicker_l10n ); 

        wp_enqueue_script( "visual-designer-js", plugin_dir_url( __FILE__ ) . 'js/visual-designer.min.js', array('jquery-ui-widget', 'wp-color-picker'), $this->version, true );

        wp_register_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/newsletter-builder-vd-admin.js', array('jquery') );
        wp_localize_script( $this->plugin_name, 'ajax_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));    
            
        wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/newsletter-builder-vd-admin.js', array( 'visual-designer-js' ), $this->version, true );

	}

	public function add_admin_page() {
        add_menu_page(
            'Newsletter Builder', //$this->plugin_name, // pageTitle
            'Newsletter Builder', //$this->plugin_name, // pageMenu
            'manage_options', // capability
            'newsletter-builder-vd', // menuSlug
            array($this, 'show_admin_page'), // function 
            'dashicons-carrot', // icon
            '3.0' // menu position
        );

        // Add editor page (this wont show in menu) 
        add_submenu_page(
	        null,
	        'Newsletter Builder Editor',
	        'Newsletter Builder Editor',
	        'manage_options',
	        'newsletter-builder-vd-editor',
	        array($this, 'show_admin_editor_page')
	    );
    }

    public function show_admin_page() {
        include_once 'partials/newsletter-builder-vd-admin-display.php';
    }

    public function show_admin_editor_page() {
    	show_admin_bar( false );

        include_once 'partials/newsletter-builder-vd-admin-editor-display.php';
    }

  //   public function admin_bar_menu($wp_admin_bar) {

  //       $wp_admin_bar->add_node( array(
		// 	'id'    => 'vd-frontend-edit-link',
		// 	'title' => 'Edit with VD',
		// 	'href'  => set_url_scheme( add_query_arg( 'vd', '', get_permalink( $wp_the_query->post->ID ) ) )
		// ));
  //   }


  //   public function save_visual_design($post_id, $content) {
  //       // Get the post status.
		// $post_status = get_post_status($post_id);

		// $is_draft           = strstr($post_status, 'draft');
		// $is_pending         = strstr($post_status, 'pending');
  //       $can_edit           = current_user_can( 'edit_post', $wp_the_query->post->ID );
  //       $existingContent    = get_post($post_id)->post_content;
  //       $alreadyHsVd        = get_post_meta($post_id, 'uses_visual_designer', true);

		// if ( current_user_can( 'publish_posts' ) ) {
		// 	$post_status = $is_draft || $is_pending ? 'publish' : $post_status;
		// }
		// else if( $is_draft ) {
		// 	$post_status = 'pending';
		// }

  //       wp_save_post_revision($post_id);

  //       add_post_meta($post_id, 'uses_visual_designer', true, true);

  //       // Get post content and update VD
  //       if ($alreadyHsVd) {
  //           $beginVd = strpos($existingContent, $this->VD_BEGIN_SIGNATURE);
  //           $endVd = strrpos($existingContent, $this->VD_END_SIGNATURE) + strlen($this->VD_END_SIGNATURE); // get last occurence

  //           $content = substr_replace($existingContent, $content, $beginVd, $endVd - $beginVd);
  //       }
  //       else {
  //           $content = $existingContent . $content;
  //       }

		// // Update the post with stripped down content.
		// wp_update_post(array(
		// 	'ID'			=> $post_id,
		// 	'post_status'	=> $post_status,
		// 	'post_content'	=> $content
		// ));
  //   }

  public function send_email_campaign() {
        if ( !wp_verify_nonce( $_REQUEST['nonce'], "send_email_campaign")) {
            exit("No naughty business please");
        }   

        $result = [];
        $result['type'] = "failure";
        $result['message'] = "No emails sent";

        // TODO: send emails out

        $result = json_encode($result);
        echo $result;
        die();
    }

   public send_emails($subject, $recipientsArray, $htmlContent) {
   		$name 	= $_POST['vd-name'];
		$email 	= $_POST['vd-email'];
		$supportType = $_POST['vd-support-type'];
		$msg 	= $_POST['vd-message'];
		$url 	= $_POST['vd-url'];
		$timestamp = $date->format('Y-m-d H:i:s');

		$to = 'contact@visualdesigner.io, samzielkeryner@gmail.com'; // note the comma
		$subject = 'vD Support: ' . $timestamp;

		// Message
		$message = "
		<html>
		<head>
		  <title>vD Support</title>
		</head>
		<body>
		  <p>Support Message:</p>
		  <ul>
	  		<li><strong>Name:</strong> $name</li>
	  		<li><strong>Email:</strong> $email</li>
	  		<li><strong>Support Type:</strong> $supportType</li>
	  		<li><strong>Message:</strong> $msg</li>
		  </ul>
		  <br/>
		  <hr/>
		  <ul>
	  		<li><strong>Url:</strong> $url</li>
		  </ul>
		</body>
		</html>
		";

		// To send HTML mail, the Content-type header must be set
		$headers[] = 'MIME-Version: 1.0';
		$headers[] = 'Content-type: text/html; charset=iso-8859-1';

		// Additional headers
		$headers[] = 'To: Visual Designer <contact@visualdesigner.io>, Sam <samzielkeryner@gmail.com>';
		$headers[] = 'From: Visual Designer <contact@visualdesigner.io>';
		// $headers[] = 'Cc: birthdayarchive@example.com';
		// $headers[] = 'Bcc: birthdaycheck@example.com';

		mail($to, $subject, $message, implode("\r\n", $headers));
   }
}
