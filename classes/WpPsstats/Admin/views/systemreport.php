<?php
/**
 * Psstats - free/libre analytics platform
 *
 * @link https://psstats.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 * @package psstats
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use WpPsstats\Access;
use WpPsstats\Admin\Menu;
use WpPsstats\Admin\SystemReport;

/** @var Access $access */
/** @var array $psstats_tables */
/** @var array $psstats_has_exception_logs */
/** @var bool $psstats_has_warning_and_no_errors */
/** @var string $psstats_active_tab */
/** @var \WpPsstats\Settings $settings */

if ( ! function_exists( 'psstats_format_value_text' ) ) {
	function psstats_format_value_text( $value ) {
		if ( is_string( $value ) && ! empty( $value ) ) {
			$psstats_format = array(
				'<br />' => ' ',
				'<br/>'  => ' ',
				'<br>'   => ' ',
			);
			foreach ( $psstats_format as $search => $replace ) {
				$value = str_replace( $search, $replace, $value );
			}
		}

		return $value;
	}
}
?>

<div class="wrap psstats-systemreport">
	<?php
	if ( $psstats_has_warning_and_no_errors ) {
		?>
			<div class="notice notice-warning">
				<p><?php esc_html_e( 'There are some issues with your system. Psstats will run, but you might experience some minor problems. See below for more information.', 'psstats' ); ?></p>
			</div>
		<?php
	}
	?>
	<?php if ( $settings->is_network_enabled() && ! is_network_admin() && is_super_admin() ) { ?>
		<div class="updated notice">
			<p><?php esc_html_e( 'Only you are seeing this page as you are the super admin', 'psstats' ); ?></p>
		</div>
	<?php } ?>
	<div id="icon-plugins" class="icon32"></div>
    <h1><?php psstats_header_icon(); ?> <?php esc_html_e( 'Diagnostics', 'psstats' ); ?></h1>

	<h2 class="nav-tab-wrapper">
		<a href="?page=<?php echo Menu::SLUG_SYSTEM_REPORT; ?>"
		   class="nav-tab <?php echo empty( $psstats_active_tab ) ? 'nav-tab-active' : ''; ?>"> System report</a>
		<a href="?page=<?php echo Menu::SLUG_SYSTEM_REPORT; ?>&tab=troubleshooting"
		   class="nav-tab <?php echo 'troubleshooting' === $psstats_active_tab ? 'nav-tab-active' : ''; ?>">Troubleshooting</a>
	</h2>

	<?php if ( empty( $psstats_active_tab ) ) { ?>

		<p><?php esc_html_e( 'Copy the below info in case our support team asks you for this information:', 'psstats' ); ?>
			<br/> <br/>
			<a href="javascript:void(0);"
			   onclick="var textarea = document.getElementById('psstats_system_report_info');textarea.select();document.execCommand('copy');"
			   class='button-primary'><?php esc_html_e( 'Copy system report', 'psstats' ); ?></a>

		</p>
		<textarea style="width:100%;height: 200px;" readonly
				  id="psstats_system_report_info">
				  <?php
					foreach ( $psstats_tables as $psstats_table ) {
						if (empty($psstats_table['rows'])) {
							continue;
						}
						echo '# ' . esc_html( $psstats_table['title'] ) . "\n";
						foreach ( $psstats_table['rows'] as $index => $psstats_row ) {
							if ( ! empty( $psstats_row['section'] ) ) {
								echo "\n\n## " . esc_html( $psstats_row['section'] ) . "\n";
								continue;
							}
							$psstats_value = $psstats_row['value'];
							if ( true === $psstats_value ) {
								$psstats_value = 'Yes';
							} elseif ( false === $psstats_value ) {
								$psstats_value = 'No';
							}
							$psstats_class = '';
							if ( ! empty( $psstats_row['is_error'] ) ) {
								$psstats_class = 'Error ';
							} elseif ( ! empty( $psstats_row['is_warning'] ) ) {
								$psstats_class = 'Warning ';
							}
							echo "\n* " . esc_html( $psstats_class ) . esc_html( $psstats_row['name'] ) . ': ' . esc_html( psstats_anonymize_value( psstats_format_value_text( $psstats_value ) ) );
							if ( isset( $psstats_row['comment'] ) && '' !== $psstats_row['comment'] ) {
								echo ' (' . esc_html( psstats_anonymize_value( psstats_format_value_text( $psstats_row['comment'] ) ) ) . ')';
							}
						}
						echo "\n\n";
					}
					?>
	</textarea>

		<?php
		foreach ( $psstats_tables as $psstats_table ) {
		    if (empty($psstats_table['rows'])) {
		        continue;
            }
			echo '<h2>' . esc_html( $psstats_table['title'] ) . "</h2><table class='widefat'><thead></thead><tbody>";
			foreach ( $psstats_table['rows'] as $psstats_row ) {
				if ( ! empty( $psstats_row['section'] ) ) {
					echo '</tbody><thead><tr><th colspan="3" class="section">' . esc_html( $psstats_row['section'] ) . '</th></tr></thead><tbody>';
					continue;
				}
				$psstats_value = $psstats_row['value'];
				if ( true === $psstats_value ) {
					$psstats_value = esc_html__( 'Yes', 'psstats' );
				} elseif ( false === $psstats_value ) {
					$psstats_value = esc_html__( 'No', 'psstats' );
				}
				$psstats_class = '';
				if ( ! empty( $psstats_row['is_error'] ) ) {
					$psstats_class = 'error';
				} elseif ( ! empty( $psstats_row['is_warning'] ) ) {
					$psstats_class = 'warning';
				}
				echo "<tr class='" . esc_attr( $psstats_class ) . "'>";
				echo "<td width='30%'>" . esc_html( $psstats_row['name'] ) . '</td>';
				echo "<td width='" . ( ! empty( $psstats_table['has_comments'] ) ? 20 : 70 ) . "%'>" . esc_html( $psstats_value ) . '</td>';
				if ( ! empty( $psstats_table['has_comments'] ) ) {
					$psstats_replaced_elements = array(
						'<code>'  => '__#CODEBACKUP#__',
						'</code>' => '__##CODEBACKUP##__',
						'<pre style="overflow-x: scroll;max-width: 600px;">' => '__#PREBACKUP#__',
						'</pre>'  => '__##PREBACKUP##__',
						'<br/>'   => '__#BRBACKUP#__',
						'<br />'  => '__#BRBACKUP#__',
						'<br>'    => '__#BRBACKUP#__',
					);
					$psstats_comment           = isset( $psstats_row['comment'] ) ? $psstats_row['comment'] : '';
					$psstats_replaced          = str_replace( array_keys( $psstats_replaced_elements ), array_values( $psstats_replaced_elements ), $psstats_comment );
					$psstats_escaped           = esc_html( $psstats_replaced );
					echo "<td width='50%' class='psstats-systemreport-comment'>" . str_replace( array_values( $psstats_replaced_elements ), array_keys( $psstats_replaced_elements ), $psstats_escaped ) . '</td>';
				}

				echo '</tr>';
			}
			echo '</tbody></table>';
		}
		?>

	<?php } else { ?>
		<h1><?php esc_html_e( 'Troubleshooting', 'psstats' ); ?></h1>

		<form method="post">
			<?php wp_nonce_field( SystemReport::NONCE_NAME ); ?>

            <input name="<?php echo esc_attr( SystemReport::TROUBLESHOOT_ARCHIVE_NOW ); ?>" type="submit"
                   class='button-primary'
                   title="<?php esc_attr_e( 'If reports show no data even though they should, you may try to see if report generation works when manually triggering the report generation.', 'psstats' ) ?>"
                   value="<?php esc_html_e( 'Archive reports', 'psstats' ); ?>">
            <br/><br/>
            <input name="<?php echo esc_attr( SystemReport::TROUBLESHOOT_CLEAR_PSSTATS_CACHE ); ?>" type="submit"
                   class='button-primary'
                   title="<?php esc_attr_e( 'Will reset / empty the Psstats cache which can be helpful if something is not working as expected for example after an update.', 'psstats' ) ?>"
                   value="<?php esc_html_e( 'Clear Psstats cache', 'psstats' ); ?>">
            <br/><br/>
			<?php if (!empty($psstats_has_exception_logs)) { ?>
                <input name="<?php echo esc_attr( SystemReport::TROUBLESHOOT_CLEAR_LOGS ); ?>" type="submit"
                       class='button-primary'
                       title="<?php esc_attr_e( 'Removes all stored Psstats logs that are shown in the system report', 'psstats' ) ?>"
                       value="<?php esc_html_e( 'Clear system report logs', 'psstats' ); ?>">
                <br/><br/>
			<?php } ?>

            <input name="<?php echo esc_attr( SystemReport::TROUBLESHOOT_UPDATE_GEOIP_DB ); ?>" type="submit"
                   class='button-primary'
                   title="<?php esc_attr_e( 'Updates the geolocation database which is used to detect the location (city/region/country) of visitors. This task is performed automatically. If the geolocation DB is not loaded or updated, you may need to trigger it manually to find the error which is causing it.', 'psstats' ) ?>"
                   value="<?php esc_html_e( 'Install/Update Geo-IP DB', 'psstats' ); ?>">
            <br/><br/>
            
			<?php if ( ! $settings->is_network_enabled() || ! is_network_admin() ) { ?>
                <input name="<?php echo esc_attr( SystemReport::TROUBLESHOOT_SYNC_USERS ); ?>" type="submit" class='button-primary'
                       title="<?php esc_attr_e( 'Users are synced automatically. If for some reason a user cannot access Psstats pages even though the user has the permission, then triggering a manual sync may help to fix this issue immediately or it may show which error prevents the automatic syncing.', 'psstats' ) ?>"
                       value="<?php esc_html_e( 'Sync users', 'psstats' ); ?>">
                <br/><br/>
                <input name="<?php echo esc_attr( SystemReport::TROUBLESHOOT_SYNC_SITE ); ?>" type="submit" class='button-primary'
                       title="<?php esc_attr_e( 'Sites / blogs are synced automatically. If for some reason Psstats is not showing up for a specific blog, then triggering a manual sync may help to fix this issue immediately or it may show which error prevents the automatic syncing.', 'psstats' ) ?>"
                       value="<?php esc_html_e( 'Sync site (blog)', 'psstats' ); ?>">
                <br/><br/>
                <input name="<?php echo esc_attr( SystemReport::TROUBLESHOOT_RUN_UPDATER ); ?>" type="submit" class='button-primary'
                       title="<?php esc_attr_e( 'Force trigger a Psstats update in case it failed error', 'psstats' ) ?>"
                       value="<?php esc_html_e( 'Run Updater', 'psstats' ); ?>">
			<?php } ?>
			<?php if ( $settings->is_network_enabled() ) { ?>
                <input name="<?php echo esc_attr( SystemReport::TROUBLESHOOT_SYNC_ALL_USERS ); ?>" type="submit"
                       class='button-primary'
                       title="<?php esc_attr_e( 'Users are synced automatically. If for some reason a user cannot access Psstats pages even though the user has the permission, then triggering a manual sync may help to fix this issue immediately or it may show which error prevents the automatic syncing.', 'psstats' ) ?>"
                       value="<?php esc_html_e( 'Sync all users across sites / blogs', 'psstats' ); ?>">
                <br/><br/>
				<input name="<?php echo esc_attr( SystemReport::TROUBLESHOOT_SYNC_ALL_SITES ); ?>" type="submit"
                       title="<?php esc_attr_e( 'Sites / blogs are synced automatically. If for some reason Psstats is not showing up for a specific blog, then triggering a manual sync may help to fix this issue immediately or it may show which error prevents the automatic syncing.', 'psstats' ) ?>"
					   class='button-primary'
					   value="<?php esc_html_e( 'Sync all sites (blogs)', 'psstats' ); ?>">
			<?php } ?>
		</form>

		<?php
		$show_troubleshooting_link = false;
		include 'info_help.php';
		?>
		<h3><?php esc_html_e( 'Popular Troubleshooting FAQs', 'psstats' ); ?></h3>
		<ul class="psstats-list">
			<li><a href="https://psstats.org/faq/wordpress/psstats-for-wordpress-is-not-showing-any-statistics-not-archiving-how-do-i-fix-it/" target="_blank" rel="noreferrer noopener"><?php esc_html_e( 'Psstats is not showing any statistics / reports, how do I fix it?', 'psstats' ); ?></a></li>
			<li><a href="https://psstats.org/faq/wordpress/i-cannot-open-backend-page-how-do-i-troubleshoot-it/" target="_blank" rel="noreferrer noopener"><?php esc_html_e( 'I cannot open the Psstats Reporting, Admin, or Tag Manager page, how do I troubleshoot it?', 'psstats' ); ?></a></li>
			<li><a href="https://psstats.org/faq/wordpress/i-have-a-problem-how-do-i-troubleshoot-and-enable-wp_debug/" target="_blank" rel="noreferrer noopener"><?php esc_html_e( 'I have an issue with the plugin, how do I troubleshoot and enable debug mode?', 'psstats' ); ?></a></li>
			<li><a href="https://psstats.org/faq/wordpress/how-do-i-manually-delete-all-psstats-for-wordpress-data/" target="_blank" rel="noreferrer noopener"><?php esc_html_e( 'How do I manually delete or reset all Psstats for WordPress data?', 'psstats' ); ?></a></li>
			<li><a href="https://psstats.org/faq/wordpress/" target="_blank" rel="noreferrer noopener"><?php esc_html_e( 'View all FAQs', 'psstats' ); ?></a></li>
		</ul>
		<?php include 'info_bug_report.php'; ?>
		<h4><?php esc_html_e( 'Before you create an issue', 'psstats' ); ?></h4>
		<p><?php esc_html_e( 'If you experience any issue in Psstats, it is always a good idea to first check your webserver logs (if possible) for any errors.', 'psstats' ); ?>
			<br/>
			<?php echo sprintf( esc_html__( 'You may also want to enable %1$s.', 'psstats' ), '<a href="https://psstats.org/faq/wordpress/i-have-a-problem-how-do-i-troubleshoot-and-enable-wp_debug/" target="_blank" rel="noreferrer noopener"><code>WP_DEBUG</code></a>' ); ?>
			<?php echo sprintf( esc_html__( 'To debug issues that happen in the background, for example report generation during a cronjob, you might also want to enable %1$s.', 'psstats' ), '<code>WP_DEBUG_LOG</code>' ); ?>

		</p>
		<h3><?php esc_html_e( 'Having performance issues?', 'psstats' ); ?></h3>
		<p>
		<?php
		echo sprintf(
			esc_html__( 'You may want to disable %1$s in your %2$s and set up an actual cronjob and %3$scheck out our recommended server sizing%4$s.', 'psstats' ),
			'<code>DISABLE_WP_CRON</code>',
			'<code>wp-config.php</code>',
			'<a target="_blank" rel="noreferrer noopener" href="https://psstats.org/docs/requirements/#recommended-servers-sizing-cpu-ram-disks">',
			'</a>'
		);
		?>
		</p>
		<?php include 'info_high_traffic.php'; ?>
	<?php } ?>
</div>
