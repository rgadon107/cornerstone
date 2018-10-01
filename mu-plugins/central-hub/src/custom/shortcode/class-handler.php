<?php
/**
 *  Shortcode handler.
 *
 * @package    spiralWebDb\Module\Custom\Shortcode
 * @since      1.0.0
 * @author     Robert A. Gadon
 * @link       http://spiralwebdb.com
 * @license    GPL-2.0+
 */

namespace spiralWebDb\Module\Custom\Shortcode;

use KnowTheCode\ConfigStore;

class Handler {

	/**
	 * Instance of the Singleton.
	 *
	 * @var static
	 */
	private static $instance;

	/**
	 * Array of shortcode's that have fired.
	 *
	 * @var array
	 */
	static $fired_shortcodes = [];

	/**
	 * Default configuration parameters.
	 *
	 * @var array
	 */
	private $default_config = [
		'shortcode_name'              => '',
		'do_shortcode_within_content' => true,
		'processing_function'         => null,
		'view'                        => '',
		'defaults'                    => [],
	];

	/**
	 * Create or get the Singleton.
	 *
	 * @since 1.1.0
	 *
	 * @return static
	 */
	public static function get_instance() {
		if ( is_null( static::$instance ) ) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	/**
	 *  Register your shortcode with the Custom Module.
	 *
	 * @since 1.0.0
	 *
	 * @param string $pathto_configuration_file Absolute path to the configuration file's location.
	 *
	 * @return false|void
	 * @throws \Exception
	 */
	public function register( $pathto_configuration_file ) {
		// Register the configuration first.
		$config = $this->register_config( $pathto_configuration_file );
		if ( ! $this->validConfig( $config ) ) {
			return false;
		}

		// If the configuration is valid, then register the shortcode with WordPress.
		add_shortcode( $config['shortcode_name'], [ $this, 'process_the_shortcode' ] );
	}

	/**
	 * Register the configuration file with ConfigStore.
	 *
	 * @since 1.0.0
	 *
	 * @param string $pathto_configuration_file Absolute path to the configuration file's location.
	 *
	 * @return mixed
	 * @throws \Exception
	 */
	private function register_config( $pathto_configuration_file ) {
		$store_key = ConfigStore\loadConfigFromFilesystem( $pathto_configuration_file, $this->default_config );

		return ConfigStore\getConfig( $store_key );
	}

	/**
	 * Checks if the configuration is valid or not.
	 *
	 * @since 1.0.0
	 *
	 * @param mixed $config Should be an array of configuration parameters for this shortcode.
	 *
	 * @return bool
	 */
	private function validConfig( $config ) {
		if ( ! is_array( $config ) || empty( $config ) ) {
			return false;
		}

		if ( empty( $config['shortcode_name'] ) ) {
			return;
		}

		return ! empty( $config['view'] );
	}

	/**
	 *  Process and render the HTML for the shortcode.
	 *
	 * @since 1.0.0
	 *
	 * @param array|string $user_defined_attributes User defined attributes for this shortcode instance.
	 * @param string|null  $content                 Content between the opening and closing shortcode elements.
	 * @param string       $shortcode_name          Name of the shortcode.
	 *
	 * @return string
	 * @throws \Exception
	 */
	public function process_the_shortcode( $user_defined_attributes, $content, $shortcode_name ) {
		$config = $this->get_config( $shortcode_name );
		if ( false === $config ) {
			return '';
		}

		$attributes = shortcode_atts(
			$config['defaults'],
			$user_defined_attributes,
			$shortcode_name
		);

		if ( $content && $config['do_shortcode_within_content'] ) {
			$content = do_shortcode( $content );
		}

		$this->set_shortcode_fired( $shortcode_name );

		return $this->render_and_return( $shortcode_name, $config, $attributes, $content );
	}

	/**
	 * Get the shortcode's configuration from ConfigStore.
	 *
	 * @since 1.0.0
	 *
	 * @param string $shortcode_name Name of the shortcode.
	 *
	 * @return bool|array
	 * @throws \Exception
	 */
	private function get_config( $shortcode_name ) {
		$config = ConfigStore\getConfig( "shortcode.{$shortcode_name}" );

		if ( empty( $config ) ) {
			return false;
		}

		return $config;
	}

	/**
	 * Render and return the shortcode's HTML.
	 *
	 * @since 1.0.0
	 *
	 * @param string       $shortcode_name Name of the shortcode.
	 * @param array        $config         Array of configuration parameters.
	 * @param array        $attributes     Array of instance attributes.
	 * @param  string|null $content        Content between the opening and closing shortcode elements.
	 *
	 * @return mixed|string
	 */
	private function render_and_return( $shortcode_name, array $config, array $attributes, $content ) {
		if ( $config['processing_function'] ) {
			return $this->call_processing_function( $shortcode_name, $config, $attributes, $content );
		}

		ob_start();
		include $config['view'];
		return ob_get_clean();
	}

	/**
	 * Call the processing function.
	 *
	 * @since 1.0.0
	 *
	 * @param string       $shortcode_name Name of the shortcode.
	 * @param array        $config         Array of configuration parameters.
	 * @param array        $attributes     Array of instance attributes.
	 * @param  string|null $content        Content between the opening and closing shortcode elements.
	 *
	 * @return string
	 */
	private function call_processing_function( $shortcode_name, array $config, array $attributes, $content ) {
		$function_name = $config['processing_function'];

		return $function_name( $config, $attributes, $content, $shortcode_name );
	}

	/**
	 * Checks if the shortcode has been processed yet or not.
	 *
	 * @since 1.0.0
	 *
	 * @param string $shortcode_name Name of the shortcode.
	 *
	 * @return int|false
	 */
	public function did_shortcode( $shortcode_name ) {
		if ( ! isset( $this->fired_shortcodes[ $shortcode_name ] ) ) {
			return false;
		}

		return $this->fired_shortcodes[ $shortcode_name ];
	}

	/**
	 * Sets that this shortcode has fired.  This method increments the count.
	 *
	 * @since 1.0.0
	 *
	 * @param string $shortcode_name Name of the shortcode.
	 *
	 * @return void
	 */
	private function set_shortcode_fired( $shortcode_name ) {
		$this->fired_shortcodes[ $shortcode_name ] += 1;
	}

	/**
	 * Prevent a new instance of this Singleton via the "new" operator.
	 */
	private function __construct() {
		// nothing here.
	}

	/**
	 * Prevent cloning of this Singleton.
	 */
	private function __clone() {
		// nothing here.
	}

	/**
	 * Prevent unserializing of this Singleton.
	 */
	private function __wakeup() {
		// nothing here.
	}
}
