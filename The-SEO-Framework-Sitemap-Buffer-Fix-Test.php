<?php
/**
 * Plugin Name: The SEO Framework - Sitemap Buffer Fix Test
 * Plugin URI: https://wordpress.org/plugins/autodescription/
 * Description: This is a test plugin to see whether buffer flushing before the SiteMap output works as expected.
 * Version: 1.0.0
 * Author: Sybre Waaijer
 * Author URI: https://cyberwire.nl/
 * License: GPLv3
 */

//tsf_test_broken_sitemap();
/**
 * Creates an empty space as soon as this plugin's loaded.
 * For Testing purposes only.
 *
 * @since 1.0.0
 */
function tsf_test_broken_sitemap() {
	?>

	<?php // Broken sitemap emerges.
}

add_action( 'template_redirect', 'tsf_sitemap_buffer', 0 );
/**
 * Flushes the PHP buffer right before when The SEO Framework's sitemap is output.
 * Also removes rogue header information, if any.
 *
 * @since 1.0.0
 * @global $wp_query
 */
function tsf_sitemap_buffer() {

	if ( '' !== get_option( 'permalink_structure' ) && function_exists( 'tsf_get_option' ) && tsf_get_option( 'sitemaps_output' ) ) {
		global $wp_query;

		if ( isset( $wp_query->query_vars['the_seo_framework_sitemap'] ) && 'xml' === $wp_query->query_vars['the_seo_framework_sitemap'] ) {
			wp_ob_end_flush_all();
			ob_clean();
			header_remove(); // PHP 5.3+
		}

	}
}
