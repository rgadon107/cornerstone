<?php
/**
 * ConfigStore's Internal Functionality (Private)
 *
 * @package     KnowTheCode\ConfigStore
 * @since       1.0.0
 * @author      hellofromTonya
 * @link        https://KnowTheCode.io
 * @license     GNU-2.0+
 */

namespace KnowTheCode\ConfigStore;

/**
 * Get, save, or remove a configuration from the store.
 *
 * @since 1.0.0
 *
 * @param string    $store_key       Optional. Storage key to locate the configuration in the store.
 * @param array     $config_to_store Optional. Configuration parameters to save in the store.
 * @param bool|null $remove          Optional. Set to true to remove the config from the store.
 *
 * @return void
 * @throws \Exception
 */
function _the_store( $store_key = '', $config_to_store = array(), $remove = null ) {
	static $config_store = array();

	// Return all stored configurations when no store key or config to store is given.
	if ( empty( $store_key ) and empty( $config_to_store ) ) {
		return $config_store;
	}

	// Store the given configuration.
	if ( $config_to_store ) {
		$config_store[ $store_key ] = $config_to_store;

		return true;
	}

	// If the key does not exist in the store, throw an error.
	if ( ! array_key_exists( $store_key, $config_store ) ) {
		throw new \Exception(
			sprintf(
				'Configuration for [%s] does not exist in the ConfigStore',
				esc_html( $store_key )
			)
		);
	}

	// If remove requested, remove the configuration.
	if ( true === $remove ) {
		unset( $config_store[ $store_key ] );

		return true;
	}

	return $config_store[ $store_key ];
}

/**
 * Load a configuration from the filesystem, returning its storage key and configuration parameters.
 *
 * @since 1.0.0
 *
 * @param string $path_to_file Absolute path to the config file.
 *
 * @return array returns an array with storage key => config parameters.
 * @throws \Exception
 */
function _load_config_from_filesystem( $path_to_file ) {
	$config    = (array) require $path_to_file;

	$store_key = key( $config );
	if ( empty( $store_key ) ) {
		throw new \Exception(
			sprintf( 'No store key exists in the %s configuration file.', esc_attr( $path_to_file ) )
		);
	}

	$config_params = current( $config );
	if ( empty( $config_params ) ) {
		throw new \Exception(
			sprintf( 'No configuration parameters exist for store key [%s] in the %s configuration file.',
				esc_attr( $store_key ), esc_attr( $path_to_file ) )
		);
	}

	return [ $store_key, $config_params ];
}

/**
 * Merge the configuration with defaults.
 *
 * @since 1.0.0
 *
 * @param array $config   Array of configuration parameters
 * @param array $defaults Array of default parameters
 *
 * @return array
 */
function _merge_with_defaults( array $config, array $defaults ) {
	return array_replace_recursive( $defaults, $config );
}


/**
 * Checks if a string starts with a character or substring.
 *
 * @since 1.0.0
 *
 * @param string $haystack  The string to be searched
 * @param string $needle    The character or substring to
 *                          find at the start of the $haystack
 * @param string $encoding  Default is UTF-8
 *
 * @return bool
 */
function str_starts_with( $haystack, $needle, $encoding = 'UTF-8' ) {
	$needle_length = mb_strlen( $needle, $encoding );

	// Using string lengths, check if given a haystack and needle to compare.
	if ( $needle_length == 0 || mb_strlen( $haystack, $encoding ) == 0 ) {
		throw new \InvalidArgumentException(
			sprintf( 'The haystack and needle cannot be empty. Given: haystack [%s] and needle of [%s].', $haystack, $needle )
		);
	}

	return ( mb_substr( $haystack, 0, $needle_length, $encoding ) === $needle );
}

