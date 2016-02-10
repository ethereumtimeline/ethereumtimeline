<?php
/*
Plugin Name: Go Daddy Quick Setup
Author: GoDaddy.com, LLC
Author URI: http://www.godaddy.com/
Plugin URI: http://www.godaddy.com/
Description: Get your site started in ten minutes by answering some easy questions.  Use our beautiful themes and popular plugin configurations to get your website started quickly.
Version: 1.04
Text Domain: gd_quicksetup
Domain Path: /lang
Network: false
License: Proprietary
*/

/**
 * Copyright 2013 Go Daddy Operating Company, LLC. All Rights Reserved.
 */

// Make sure it's wordpress
if ( !defined( 'ABSPATH' ) )
	die( 'Forbidden' );

// Load languages
load_plugin_textdomain( 'gd_quicksetup', false, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );

// Our path
define( 'GD_QUICKSETUP_DIR', realpath( dirname( __FILE__ ) ) );

// Run the plugin
$gd_quicksetup_plugin = new GD_QuickSetup_Plugin();

// Activation hook -- reload the environment settings
register_activation_hook( __FILE__, array( $gd_quicksetup_plugin, 'activate' ) );

// Cleanup -- roll back environment changes
register_deactivation_hook( __FILE__, array( $gd_quicksetup_plugin, 'deactivate' ) );

/**
 * Go Daddy Quick Setup Plugin for WordPress
 */
class GD_QuickSetup_Plugin {

	/**
	 * Plugin slug
	 * @var string
	 */
	public $slug = '';
	
	/**
	 * API communicator
	 * @var object
	 */
	public $api = null;

	/**
	 * Current plugin options
	 * @var array
	 */
	protected $_current_plugin_options = array();

	/**
	 * Current theme options
	 * @var array
	 */
	protected $_current_theme_options = array();

	/**
	 * Constructor
	 * @return GD_QuickSetup_Plugin
	 */
	public function __construct() {
		$this->slug = 'gd_quicksetup';
		$this->hooks();
	}

	/**
	 * Add all of our admnin hooks
	 * @return void
	 */
	public function hooks() {

		// Always run
		if ( is_admin() ) {
			add_action( 'init',       array( $this, 'library_init' ) );
			add_action( 'admin_init', array( $this, 'modules_init' ) );
			add_action( 'admin_init', array( $this, 'init_api'     ) );
		}

		// Ajax hooks
		if ( is_admin() && defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			add_action( 'wp_ajax_quick_setup_ajax_poll', array( $this, 'done_install' ) );

		// Admin UI hooks
		} elseif ( is_admin() && !defined( 'DOING_AJAX' ) || ( defined( 'DOING_AJAX' ) && !DOING_AJAX ) ) {
			add_filter( 'plugin_row_meta', array( $this, 'add_leave_feedback_link' ), 10, 2 );
			add_action( 'admin_init',      array( $this, 'upgrade' ) );
			add_action( 'admin_menu',      array( $this, 'settings_page' ) );
			add_action( 'admin_notices',   array( $this, 'show_banner' ) );
			add_action( 'admin_init',      array( $this, 'self_upgrade' ) );
		}
	}

	/**
	 * Enqueue javascripts
	 * Respect SCRIPT_DEBUG
	 */
	public function enqueue_scripts() {
		if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
			wp_enqueue_script( 'gd_quicksetup_js', plugins_url( 'quick-setup/js/gd-quick-setup.js' ) );
			wp_enqueue_script( 'jquery_tiptip', plugins_url( 'quick-setup/js/jquery.tiptip.js' ) );
			wp_enqueue_script( 'jquery_placeholder', plugins_url( 'quick-setup/js/jquery.placeholder.js' ) );
		} else {
			wp_enqueue_script( 'gd_quicksetup_js', plugins_url( 'quick-setup/js/gd-quick-setup.min.js' ) );
			wp_enqueue_script( 'jquery_tiptip', plugins_url( 'quick-setup/js/jquery.tiptip.min.js' ) );
			wp_enqueue_script( 'jquery_placeholder', plugins_url( 'quick-setup/js/jquery.placeholder.min.js' ) );
		}
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-dialog' );
		add_thickbox();
		wp_localize_script(
						'gd_quicksetup_js',
						'objectL10n',
						array(
							'add'      => __( 'Add', 'gd_quicksetup' ),
							'remove'   => __( 'Remove', 'gd_quicksetup' ),
							'building' => __( 'Building Site...', 'gd_quicksetup' ),
							'publish'  => __( 'Publish Website', 'gd_quicksetup' ),
						)
		);
	}
	
	/**
	 * Enqueue css
	 * Respect SCRIPT_DEBUG
	 */
	public function enqueue_styles() {
		global $wp_styles;

		if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
			wp_enqueue_style( 'gd_quicksetup_css', plugins_url( 'quick-setup/css/gd-quick-setup.css' ) );
			wp_register_style( 'gd_quicksetup_ie_css', plugins_url( 'quick-setup/css/gd-quick-setup-ie.css' ) );
			$wp_styles->add_data( 'gd_quicksetup_ie_css', 'conditional', 'lte IE 9' );
			wp_enqueue_style( 'gd_quicksetup_ie_css' );
		} else {
			wp_enqueue_style( 'gd_quicksetup_css', plugins_url( 'quick-setup/css/gd-quick-setup.min.css' ) );
			wp_register_style( 'gd_quicksetup_ie_css', plugins_url( 'quick-setup/css/gd-quick-setup-ie.min.css' ) );
			$wp_styles->add_data( 'gd_quicksetup_ie_css', 'conditional', 'lte IE 9' );
			wp_enqueue_style( 'gd_quicksetup_ie_css' );
		}
	}

	/**
	 * Bootstrap our own upgrader
	 */
	public function self_upgrade() {
		$options = get_option( 'gd_quicksetup_options' );
		if ( !empty( $options['key'] ) ) {
			$plugin_slug = plugin_basename( __FILE__ );
			$gd_quicksetup_upgrader = new GD_QuickSetup_Upgrader( $plugin_slug );
			$gd_quicksetup_upgrader->set_api( $this->api );
		}
	}
	
	/**
	 * Include required libraries
	 */
	public function library_init() {

		// Autoload if possible
		if ( function_exists( 'spl_autoload_register' ) ) {
			spl_autoload_register( array( $this, 'autoload' ) );
		} else {
			require_once( ABSPATH . '/wp-admin/includes/class-wp-upgrader.php' );
			require_once( GD_QUICKSETUP_DIR . '/classes/class.gd-quicksetup-api.php' );
			require_once( GD_QUICKSETUP_DIR . '/classes/class.gd-quicksetup-plugin-upgrader.php' );
			require_once( GD_QUICKSETUP_DIR . '/classes/class.gd-quicksetup-installer-skin.php' );
			require_once( GD_QUICKSETUP_DIR . '/classes/class.gd-quicksetup-object-cache.php' );
		}
	}
	
	/**
	 * Init API communicator
	 */
	public function init_api() {
		
		// API communicator
		$this->api = new GD_QuickSetup_API();
	}

	/**
	 * Autoloader
	 * @param string $class_name
	 */
	public function autoload( $class_name ) {
		switch ( $class_name ) {
			case 'GD_QuickSetup_API' :
				require_once( GD_QUICKSETUP_DIR . '/classes/class.gd-quicksetup-api.php' );
				break;
			case 'GD_QuickSetup_Plugin_Upgrader' :
				require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
				require_once( ABSPATH . '/wp-admin/includes/class-wp-upgrader.php' );
				require_once( GD_QUICKSETUP_DIR . '/classes/class.gd-quicksetup-plugin-upgrader.php' );
				break;
			case 'GD_QuickSetup_Installer_Skin' :
				require_once( ABSPATH . '/wp-admin/includes/class-wp-upgrader.php' );
				require_once( GD_QUICKSETUP_DIR . '/classes/class.gd-quicksetup-installer-skin.php' );
				break;
			case 'GD_QuickSetup_ObjectCache' :
				require_once( GD_QUICKSETUP_DIR . '/classes/class.gd-quicksetup-object-cache.php' );
				break;
			case 'GD_QuickSetup_Upgrader' :
				require_once( GD_QUICKSETUP_DIR . '/classes/class.gd-quicksetup-upgrader.php' );
				break;
			case 'GD_QuickSetup_Theme_Upgrader' :
				require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
				require_once( ABSPATH . '/wp-admin/includes/class-wp-upgrader.php' );
				require_once( GD_QUICKSETUP_DIR . '/classes/class.gd-quicksetup-theme-upgrader.php' );
				break;
			case 'GD_QuickSetup_Shortcodes' :
				require_once( GD_QUICKSETUP_DIR . '/classes/class.gd-quicksetup-shortcodes.php' );
				break;
		}
	}
	
	/**
	 * Get current plugin options
	 * @return array
	 */
	public function get_current_plugin_options() {
		return $this->_current_plugin_options;
	}

	/**
	 * Get current theme options
	 * @return array
	 */
	public function get_current_theme_options() {
		return $this->_current_theme_options;
	}

	/**
	 * Include all of the modules
	 */
	public function modules_init() {		
		
		// Get installer modules
		foreach ( glob( GD_QUICKSETUP_DIR . '/modules/*.php' ) as $module ) {
			if ( 'index.php' === pathinfo( $module, PATHINFO_BASENAME ) ) {
				continue;
			}
			require_once( $module );
		}

		do_action( 'gd_quicksetup_modules_init' );
	}
	
	/**
	 * Install routine
	 * All of the heavy lifting happens here
	 */
	public function do_install() {
		
		// Don't time out
		set_time_limit( 0 );
		
		// Don't abort the site in a bad state if the connection drops
		ignore_user_abort( true );
		
		// Ask the API what to do
		$result = $this->api->get_setup_instructions( $_POST['site_type'], $_POST['theme_slug'] );
		if ( is_wp_error( $result ) ) {
			wp_die( __( 'There was a problem fetching the data', 'gd_quicksetup' ) );
		} else {
			$result = json_decode( $result['body'], true );
		}

		// Start the installation process
		do_action( 'gd_quicksetup_install' );
		
		// Install plugins
		$this->_current_plugin_options = array();
		$plugin_installer_skin = new GD_QuickSetup_Installer_Skin();
		$plugin_installer = new GD_QuickSetup_Plugin_Upgrader( $plugin_installer_skin );
		do_action( 'gd_quicksetup_install_plugins' );
		foreach ( (array) $result['plugins'] as $plugin ) {
			$this->_current_plugin_options = ( isset( $plugin['options'] ) ? $plugin['options'] : array() );
			$this->flush();
			$plugin_installer->install( $plugin['url'] );
			$plugin_installer->activate_plugin( $plugin['slug'] );
			$this->flush();
		}
		do_action( 'gd_quicksetup_install_plugins_done' );

		// Theme
		do_action( 'gd_quicksetup_install_theme' );
		$this->_current_theme_options = ( isset( $result['theme']['options'] ) ? $result['theme']['options'] : array() );
		$theme_installer_skin = new GD_QuickSetup_Installer_Skin();
		$theme_installer = new GD_QuickSetup_Theme_Upgrader( $theme_installer_skin );
		$this->flush();
		$theme_installer->install( $result['theme']['url'] );
		$this->flush();
		$theme_installer->switch_theme( $result['theme']['stylesheet'] );
		do_action( 'gd_quicksetup_install_theme_done' );

		// Content
		do_action( 'gd_quicksetup_install_content' );
		
		// Start the menu at 30
		// home = 10
		// gallery = 20
		// location = 700
		// contact = 800
		// blog = 999
		$menu = 30;
		
		// Create pages
		$this->flush();
		foreach ( (array) $_POST['type'] as $k => $v ) {
			if ( !$_POST['enabled'][$k] || 'false' === $_POST['enabled'][$k] ) {
				continue;
			}
			if ( 'page' === $v ) {
				if ( !isset( $_POST['title'][$k] ) || empty( $_POST['title'][$k] ) ) {
					$title = __( 'Untitled', 'gd_quicksetup' );
				} else {
					$title = $_POST['title'][$k];
				}
				$pageid = wp_insert_post(
								array(
								'comment_status' => 'closed',
								'ping_status'    => 'closed',
								'post_content'   => wp_kses( $_POST['content'][$k], wp_kses_allowed_html( 'post' ) ),
								'post_name'      => sanitize_title( $title ),
								'post_title'     => strip_tags( $title ),
								'post_type'      => 'page',
								'post_status'    => 'publish',
								'menu_order'     => ( $_POST['home'][$k] ? 10 : $menu += 10 ),
							)
				);
				if ( $_POST['home'][$k] && 0 !== strcasecmp( $_POST['home'][$k], 'false' ) ) {
					update_option( 'show_on_front', 'page' );
					update_option( 'page_on_front', $pageid );
				}
			}
		}
		$this->flush();

		// Create gallery
		$this->flush();
		foreach ( (array) $_POST['type'] as $k => $v ) {
			if ( !$_POST['enabled'][$k] || 'false' === $_POST['enabled'][$k] ) {
				continue;
			}
			if ( 'gallery' === $v ) {
				$gallery_ids = array();
				foreach ( $_FILES as $k2 => $v2 ) {
					if ( 0 === strpos( $k2, 'upload_image_' . $k . '_' ) && is_uploaded_file( $_FILES[$k2]['tmp_name'] ) ) {

						// Check mime type, only allow "image/*" files
						$info = wp_check_filetype_and_ext( $_FILES[$k2]['tmp_name'], $_FILES[$k2]['name'] );
						if ( isset( $info['type'] ) && 0 === stripos( $info['type'], 'image/' ) ) {
							$id = media_handle_upload( $k2, 0 );
							if ( !is_wp_error( $id ) && is_numeric( $id ) ) {
								$gallery_ids[] = $id;
							}
						}
					}
				}
				if ( empty( $gallery_ids ) ) {
					continue;
				}
				$pageid = wp_insert_post(
								array(
									'comment_status' => 'closed',
									'ping_status'    => 'closed',
									'post_content'   => '[gallery ids="' . implode( ',', $gallery_ids ) . '"]',
									'post_name'      => __( 'gallery', 'gd_quicksetup' ),
									'post_title'     => __( 'Gallery', 'gd_quicksetup' ),
									'post_type'      => 'page',
									'post_status'    => 'publish',
									'menu_order'     => 20,
								)
				);
				if ( $_POST['home'][$k] && 0 !== strcasecmp( $_POST['home'][$k], 'false' ) ) {
					update_option( 'show_on_front', 'page' );
					update_option( 'page_on_front', $pageid );
				}
			}
		}
		$this->flush();
		
		// Create blog post
		$this->flush();
		foreach ( (array) $_POST['type'] as $k => $v ) {
			if ( !$_POST['enabled'][$k] || 'false' === $_POST['enabled'][$k] ) {
				continue;
			}
			if ( 'blog' === $v ) {
				if ( !isset( $_POST['title'][$k] ) || empty( $_POST['title'][$k] ) ) {
					$title = __( 'Untitled', 'gd_quicksetup' );
				} else {
					$title = $_POST['title'][$k];
				}
				wp_insert_post(
								array(
									'post_content' => wp_kses( $_POST['content'][$k], wp_kses_allowed_html( 'post' ) ),
									'post_name'    => sanitize_title( $title ),
									'post_title'   => strip_tags( $title ),
									'post_type'    => 'post',
									'post_status'  => 'publish',
								)
				);
				if ( 'page' === get_option( 'show_on_front', 'page' ) ) {
					$pageid = wp_insert_post(
									array(
										'comment_status' => 'closed',
										'ping_status'    => 'closed',
										'post_content'   => '',
										'post_name'      => __( 'blog', 'gd_quicksetup' ),
										'post_title'     => __( 'Blog', 'gd_quicksetup' ),
										'post_type'      => 'page',
										'post_status'    => 'publish',
										'menu_order'     => 999,
									)
					);
					update_option( 'page_for_posts', $pageid );
				}
			}
		}
		$this->flush();
		do_action( 'gd_quicksetup_install_content_done' );

		// Done
		do_action( 'gd_quicksetup_install_done' );

		// Stash $_POST in a fake transient (needed for communicating with the install_after_done action
		// we can't use a real transient because of volatility with the database and object cache after
		// resetting the site
		update_option( 'gd_quicksetup_last_post', $_POST );
		
		// Save the response as a fake transient so the theme skin (and any other options) can be switched
		// (deleted after ajax call is done, we don't need it for longer than that)
		set_transient( 'gd_quicksetup_last_api_response', $result, 3600 );

		// "Done" Flag
		update_option( 'gd_quicksetup_wizard_complete', time() );
	}

	/**
	 * Install is done, move on
	 * Call the gd_quicksetup_after_install_done hook
	 * This is called via ajax
	 */
	public function done_install() {
		if ( get_option( 'gd_quicksetup_wizard_complete' ) > 0 ) {
			$flag = get_transient( 'gd_quicksetup_doing_done_install' );
			if ( empty( $flag ) ) {
				set_transient( 'gd_quicksetup_doing_done_install', time(), 120 );
				do_action( 'gd_quicksetup_after_install_done' );
				wp_die( admin_url() );
			}
		}
		wp_die( 2 );
	}

	/**
	 * Upgrade between versions
	 * @return void
	 */
	public function upgrade() {

		// Get the current version
		$version = get_option( 'gd_quicksetup_version' );

		// Set default options
		if ( empty( $version ) || version_compare( $version, '1.0' ) < 0 ) {
			update_option( 'gd_quicksetup_version', '1.0' );
			$options = array(
				'key'     => '',
				'api_url' => 'https://wpqs.secureserver.net/v1/',
			);
			if ( !get_option( 'gd_quicksetup_options' ) ) {
				update_option( 'gd_quicksetup_options', $options );
			}
		}
		
		// Upgrade to 1.04
		if ( empty( $version ) || version_compare( $version, '1.04' ) < 0 ) {
			update_option( 'gd_quicksetup_version', '1.04' );
		}
	}

	/**
	 * Hook into the admin menu
	 * @return void
	 */
	public function settings_page() {
		$page = add_management_page( __( 'Go Daddy Quick Setup', 'gd_quicksetup' ), __( 'Go Daddy Quick Setup', 'gd_quicksetup' ), 'manage_options', $this->slug . '-wizard', array( $this, 'quicksetup_wizard' ) );
		add_action( 'admin_print_scripts-' . $page, array( $this, 'enqueue_scripts' ) );
		add_action( 'admin_print_styles-' . $page, array( $this, 'enqueue_styles' ) );
	}
	
	/**
	 * Start the wizard
	 * @return void
	 */
	public function quicksetup_wizard() {

		// Check permissions
		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}
		
		// Shortcodes handler
		$this->shortcodes = new GD_QuickSetup_Shortcodes();
		
		// Run the wizard
		if ( !isset( $_GET['step'] ) || !in_array( $_GET['step'], array( -1, 2, 3, 4 ) ) ) {			
			include_once( GD_QUICKSETUP_DIR . '/resources/header.php' );
			include_once( GD_QUICKSETUP_DIR . '/resources/step1.php' );
			include_once( GD_QUICKSETUP_DIR . '/resources/footer.php' );
		} elseif ( 2 == $_GET['step'] ) {
			check_admin_referer( 'quick_setup_step2' ) || wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
			include_once( GD_QUICKSETUP_DIR . '/resources/header.php' );
			include_once( GD_QUICKSETUP_DIR . '/resources/step2.php' );
			include_once( GD_QUICKSETUP_DIR . '/resources/footer.php' );
		} elseif ( 3 == $_GET['step'] ) {
			check_admin_referer( 'quick_setup_step3' ) || wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
			include_once( GD_QUICKSETUP_DIR . '/resources/header.php' );
			include_once( GD_QUICKSETUP_DIR . '/resources/step3.php' );
			include_once( GD_QUICKSETUP_DIR . '/resources/footer.php' );
		} elseif ( 4 == $_GET['step'] ) {
			check_admin_referer( 'quick_setup_step4' ) || wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
			
			// Don't force a specific file system method
			$method = '';

			// Define any extra pass-thru fields (none)
			$form_fields = array();

			// Define the URL to post back to (this one)
			$url = wp_nonce_url( $_SERVER['REQUEST_URI'], 'quick_setup_step4' );

			// Ask for credentials, if necessary
			if ( false === ( $creds = request_filesystem_credentials( $url, $method, false, false, $form_fields ) ) ) {
				// Show the credentials form
				include_once( GD_QUICKSETUP_DIR . '/resources/filesystem-message.php' );
				return true;
			} elseif ( ! WP_Filesystem( $creds ) ) {
				// The credentials are bad, ask again
				request_filesystem_credentials( $url, $method, true, false, $form_fields );
				include_once( GD_QUICKSETUP_DIR . '/resources/filesystem-message.php' );
				return true;
			} else {
				// Once we get here, we should have credentials, do the file system operations
				global $wp_filesystem;
				delete_option( 'gd_quicksetup_wizard_complete' );

				/**
				 * Use some aggressive cache-busting to get the "Building your site..." message to
				 * appear as soon as possible.  This is based on core ticket #18525
				 * @link http://core.trac.wordpress.org/ticket/18525
				 */
				
				// Stop compressing
				if ( !headers_sent() && ini_get( 'zlib.output_handler' ) ) { 
					ini_set( 'zlib.output_handler', '' ); 
					ini_set( 'zlib.output_compression', 0 ); 
				}
				if ( !headers_sent() && function_exists( 'apache_setenv' ) ) { 
					apache_setenv( 'no-gzip', '1' );
				}
				ini_set( 'output_handler', '' ); 
				ini_set( 'output_buffering', false ); 
				ini_set( 'implicit_flush', true ); 

				$this->flush();
				include_once( GD_QUICKSETUP_DIR . '/resources/header.php' );
				$this->flush();
				include_once( GD_QUICKSETUP_DIR . '/resources/step4.php' );
				$this->flush();
				include_once( GD_QUICKSETUP_DIR . '/resources/footer.php' );
				$this->flush();

				add_action( 'shutdown', array( $this, 'do_install' ) );
			}
		} elseif ( -1 == $_GET['step'] ) {
			wp_die( __( 'Error', 'gd_quicksetup' ) );
		}
	}

	/**
	 * Show the banner on the dashboard
	 */
	public function show_banner() {
		
		// Only works for admins
		if ( !current_user_can( 'manage_options' ) ) {
			return;
		}
		
		// Only works on dashboard
		if ( 'dashboard' != get_current_screen()->id ) {
			return;
		}
		
		// Get a list of dismissed pointers
		$pointers = array_filter( explode( ',', (string) get_user_meta( get_current_user_id(), 'dismissed_wp_pointers', true ) ) );
		
		// Show the "Go play with your new site!" banner?		
		if ( get_option( 'gd_quicksetup_wizard_complete' ) && !in_array( 'gd-quicksetup-wizard-complete', $pointers ) ) {
			if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
				wp_enqueue_style( 'gd_quicksetup_banner_css', plugins_url( 'quick-setup/css/gd-quick-setup-banner.css' ) );
			} else {
				wp_enqueue_style( 'gd_quicksetup_banner_css', plugins_url( 'quick-setup/css/gd-quick-setup-banner.min.css' ) );
			}
			include_once( GD_QUICKSETUP_DIR . '/resources/site-built-banner.php' );
			return;
		}
		
		// If they haven't dismissed the "Build your site!" pointer, show that
		if ( !in_array( 'gd-quicksetup-start-wizard', $pointers ) ) {
			if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
				wp_enqueue_style( 'gd_quicksetup_banner_css', plugins_url( 'quick-setup/css/gd-quick-setup-banner.css' ) );
			} else {
				wp_enqueue_style( 'gd_quicksetup_banner_css', plugins_url( 'quick-setup/css/gd-quick-setup-banner.min.css' ) );
			}
			include_once( GD_QUICKSETUP_DIR . '/resources/build-site-banner.php' );
			return;
		}
	}

	/**
	 * Activate
	 */
	public function activate() {
		global $wp_version;

		// Version check, only 3.5+
		if ( ! version_compare( $wp_version, '3.5-beta', '>=' ) ) {
			if ( function_exists( 'deactivate_plugins' ) ) {
				deactivate_plugins( __FILE__ );
			}
			
			// Don't call wp_die, this will take over the screen
			add_filter( 'wp_die_handler', create_function( '', "{return '_ajax_wp_die_handler';}" ) );
			wp_die( __( '<strong>Go Daddy Quick Setup</strong> requires WordPress 3.5 or later', 'gd_quicksetup' ) );
		}

		// Not for multisite
		if ( is_multisite() ) {
			if ( function_exists( 'deactivate_plugins' ) ) {
				deactivate_plugins( __FILE__ );
			}

			// Don't call wp_die, this will take over the screen
			add_filter( 'wp_die_handler', create_function( '', "{return '_ajax_wp_die_handler';}" ) );
			wp_die( __( '<strong>Go Daddy Quick Setup</strong> will not work on multisite installations', 'gd_quicksetup' ) );
		}

		// Add our option
		add_option( 'gd_quicksetup_last_post', array(), '', false );
	}

	/**
	 * Clean up when deactivated
	 * Currently there's nothing to clean up, so we'll leave
	 * that for uninstall.php
	 * @return void
	 */
	public function deactivate() {
		// todo
	}
	
	/**
	 * Flush
	 * Use some aggressive flushing to make the "Building ..." dialog appear as soon as possible
	 * on step 4.  This is based on ticket #18525
	 * @link http://core.trac.wordpress.org/ticket/18525
	 */
	public function flush() {
		if ( 'cli' === php_sapi_name() ) {
			return;
		}
		wp_ob_end_flush_all();
		$buffer_string = '<!--' . str_repeat( chr( ' ' ), 16384 ) . '-->'; // 16 KB
		if ( headers_sent() ) { 
			echo $buffer_string;
			flush(); 
		}		
	}
	
	/**
	 * Show the "Leave feedback" link on the plugins table
	 * @param array $links
	 * @param string $file
	 * @return array New links
	 */
	public static function add_leave_feedback_link( $links, $file ) {
		if ( $file === plugin_basename( __FILE__ ) ) {
			$links['feedback'] = '<a href="http://x.co/quickwp" target="_blank">' . __( 'Leave feedback', 'gd_quicksetup' ) . '</a>';
			$links['support']  = '<a href="http://x.co/quicksetup" target="_blank">' . __( 'Get support', 'gd_quicksetup' ) . '</a>';
		}
		return $links;
	}
}
