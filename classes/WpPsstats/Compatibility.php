<?php
/**
 * Psstats - free/libre analytics platform
 *
 * @link https://psstats.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 * @package psstats
 */

namespace WpPsstats;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // if accessed directly
}

class Compatibility {

	public function register_hooks() {
		$this->ithemes_security();
	}

	/**
	 * refs https://github.com/psstats-org/wp-psstats/issues/131
	 * When user disables feature "Disable PHP in plugins" in system tweaks
	 * then the Psstats backend doesn't work
	 */
	private function ithemes_security() {
		if ( defined( 'PSSTATS_COMPATIBIILITY_ITHEMES_SECURITY_DISABLE' ) && PSSTATS_COMPATIBIILITY_ITHEMES_SECURITY_DISABLE ) {
			return;
		}
		add_filter(
			'itsec_filter_apache_server_config_modification',
			function ( $rules ) {
				// otherwise the path below won't be compatible
				// todo ideally we would make the plugins path relative and match the specific path...
				// like preg_quote(relative_wp_content_dir)...
				$is_wp_content_dir_compatible = defined( 'WP_CONTENT_DIR' )
											 && ABSPATH . 'wp-content' === rtrim( WP_CONTENT_DIR, '/' );
				if ( $rules
				&& $is_wp_content_dir_compatible
				&& is_string( $rules )
				&& strpos( $rules, 'RewriteEngine On' ) > 0
				&& strpos( $rules, 'content' ) > 0
				&& strpos( $rules, 'plugins' ) > 0 ) {
					$rules = '
	<IfModule mod_rewrite.c>
		RewriteEngine On

		# Allow Psstats Backend
		RewriteRule ^wp\-content/plugins/psstats/app/(index|piwik|psstats)\.php$ \$0 [NC,L]
	</IfModule>
' . $rules;
				}
				return $rules;
			},
			9999999991,
			$acceptedArgs = 1
		);
	}

}
