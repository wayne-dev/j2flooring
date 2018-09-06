<?php
/**
 * WP Reset
 * https://wpreset.com/
 * (c) WebFactory Ltd, 2017-2018
 */


// include only file
if (!defined('ABSPATH')) {
	wp_die(__('Do not open this file directly.', 'wp-error'));
}


/**
 * Resets the site to the default values without modifying any files.
 */
class WP_Reset_CLI extends WP_CLI_Command {

    /**
     * Reset the site database to default values. No files are modified.
     *
     * ## OPTIONS
     * 
     * [--reactivate-theme]
     * : Reactivate currently active theme after reset.
     * 
     * [--reactivate-plugins]
     * : Reactivate all currently active plugins after reset.
     * 
     * [--deactivate-wp-reset]
     * : Deactivate WP Reset plugin after reset. By default it will stay active after reset.
     * 
     * [--yes]
     * : Answer yes to the confirmation message.
     *
     * ## EXAMPLES
     *
     * $ wp reset reset --yes
     * Success: Database has been reset.
     *
     * @when after_wp_load
     */
    function reset( $_, $assoc_args ) {
      WP_CLI::confirm( 'Are you sure you want to do this?', $assoc_args );
      
      global $wp_reset;
      $params = array();

      if ( !empty( $assoc_args['reactivate-theme'] ) ) {
        $params['reactivate_theme'] = true;
      }
      if ( !empty( $assoc_args['disable-wp-reset'] ) ) {
        $params['reactivate_wpreset'] = false;
      } else {
        $params['reactivate_wpreset'] = true;
      }
      if ( !empty( $assoc_args['reactivate-plugins'] ) ) {
        $params['reactivate_plugins'] = true;
      }

      $result = $wp_reset->do_reinstall( $params );
      if (is_wp_error($result)) {
        WP_CLI::error( $result->get_error_message );
      } else {
        WP_CLI::success( 'Database has been reset.' );
      }
    } // reset


    /**
     * Display WP Reset version.
     * 
     * @when after_wp_load
     */
    function version( $_, $assoc_args ) {
      global $wp_reset;
      
      WP_CLI::line( 'WP Reset v' . $wp_reset->version );
    } // version
} // WP_Reset_CLI

WP_CLI::add_command( 'reset', 'WP_Reset_CLI' );
