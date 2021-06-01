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

/** @var \WpPsstats\Settings $settings */
$psstats_extra_url_params = '&' . http_build_query(
	array(
		'php'        => PHP_MAJOR_VERSION . '.' . PHP_MINOR_VERSION . '.' . PHP_RELEASE_VERSION,
		'psstats'     => $settings->get_global_option( 'core_version' ),
		'wp_version' => ! empty( $GLOBALS['wp_version'] ) ? $GLOBALS['wp_version'] : '',
	)
);
?>
<div class="wrap">

	<?php if ( $settings->is_network_enabled() && ! is_network_admin() && is_super_admin() ) { ?>
		<div class="updated notice">
			<p><?php esc_html_e( 'Only super users can see this page', 'psstats' ); ?></p>
		</div>
	<?php } ?>

	<div id="icon-plugins" class="icon32"></div>

	<h1><?php psstats_header_icon(); ?> <?php esc_html_e( 'Discover new functionality for your Psstats', 'psstats' ); ?></h1>

	<?php if ( ! is_plugin_active( PSSTATS_MARKETPLACE_PLUGIN_NAME ) ) { ?>
        <div class="updated notice psstats-marketplace-notice">
            <p><?php echo sprintf( esc_html__( 'Easily install over 100 free plugins & %1$spremium features%2$s for Psstats with just a click' ), '<span style="white-space: nowrap;">', '</span>' ); ?>
            </p>
            <p><a href="https://builds.psstats.org/psstats-marketplace-for-wordpress-latest.zip" rel="noreferrer noopener" class="button"><?php esc_html_e( 'Download Psstats Marketplace for WordPress', 'psstats' ); ?></a>

            <a target="_blank" href="https://psstats.org/faq/wordpress/how-do-i-install-a-psstats-marketplace-plugin-in-psstats-for-wordpress/"><span class="dashicons-before dashicons-video-alt3"></span></a> <a target="_blank" href="https://psstats.org/faq/wordpress/how-do-i-install-a-psstats-marketplace-plugin-in-psstats-for-wordpress/"><?php esc_html_e( 'Install instructions', 'psstats' ); ?></a>
           </p>
        </div>
	<?php } ?>

	<?php
    function psstats_show_tables($psstats_feature_sections) {

	    foreach ( $psstats_feature_sections as $psstats_feature_section ) {
		    $psstats_feature_section['features'] = array_filter($psstats_feature_section['features']);
		    $psstats_num_features_in_block = count( $psstats_feature_section['features'] );

		    echo '<h2>' . esc_html( $psstats_feature_section['title'] ) . '</h2>';
		    echo '<div class="wp-list-table widefat plugin-install psstats-plugin-list psstats-plugin-row-' . $psstats_num_features_in_block . '"><div id="the-list">';

		    foreach ( $psstats_feature_section['features'] as $psstats_index => $psstats_feature ) {
			    $psstats_style        = '';
			    $psstats_is_3_columns = $psstats_num_features_in_block === 3;
			    if ( $psstats_is_3_columns ) {
				    $psstats_style = 'width: calc(33% - 8px);min-width:282px;max-width:350px;';
				    if ( $psstats_index % 3 === 2 ) {
					    $psstats_style .= 'clear: inherit;margin-right: 0;margin-left: 16px;';
				    }
			    }
			    ?>
                <div class="plugin-card" style="<?php echo $psstats_style; ?>">
				    <?php
				    if ( $psstats_is_3_columns && ! empty( $psstats_feature['image'] ) ) {
					    ?>
                    <a
                            href="<?php echo esc_url( $psstats_feature['url'] ); ?>"
                            rel="noreferrer noopener" target="_blank"
                            class="thickbox open-plugin-details-modal"><img
                                src="<?php echo esc_url( $psstats_feature['image'] ); ?>"
                                style="height: 80px;width:100%;object-fit: cover;" alt=""></a><?php } ?>

                    <div class="plugin-card-top">
                        <div class="
					<?php
					    if ( ! $psstats_is_3_columns ) {
						    ?>
						name column-name<?php } ?>" style="margin-right: 0;<?php if ( empty( $psstats_feature['image'] )) { echo 'margin-left: 0;'; } ?>">
                            <h3>
                                <a href="<?php echo esc_url( !empty($psstats_feature['video']) ? $psstats_feature['video'] : $psstats_feature['url'] ); ?>"
                                   rel="noreferrer noopener" target="_blank"
                                   class="thickbox open-plugin-details-modal">
								    <?php echo esc_html( $psstats_feature['name'] ); ?>
                                </a>
							    <?php
							    if ( ! $psstats_is_3_columns && ! empty( $psstats_feature['image'] ) ) {
								    ?>
                                <a
                                        href="<?php echo esc_url( $psstats_feature['url'] ); ?>"
                                        rel="noreferrer noopener" target="_blank"
                                        class="thickbox open-plugin-details-modal"><img
                                            src="<?php echo esc_url( $psstats_feature['image'] ); ?>" class="plugin-icon"
                                            style="object-fit: cover;"
                                            alt=""></a><?php } ?>
                            </h3>
                        </div>
                        <div class="
					<?php
					    if ( ! $psstats_is_3_columns ) {
						    ?>
						desc column-description<?php } ?>"
                             style="margin-right: 0;<?php if ( empty( $psstats_feature['image'] )) { echo 'margin-left: 0;'; } ?>">
                            <p class="psstats-description"><?php echo esc_html( $psstats_feature['description'] ); ?>
                            <?php if (!empty($psstats_feature['video'])) {
                                echo ' <a target="_blank" rel="noreferrer noopener" style="white-space: nowrap;" href="'. esc_url($psstats_feature['video']).'"><span class="dashicons dashicons-video-alt3"></span> '. esc_html__( 'Learn more', 'psstats' ).'</a>';
                            } elseif (!empty($psstats_feature['url'])) {
		                            echo ' <a target="_blank" rel="noreferrer noopener" style="white-space: nowrap;" href="'. esc_url($psstats_feature['url']).'">'. esc_html__( 'Learn more', 'psstats' ).'</a>';
	                            } ?></p>
	                        <?php if ( ! empty( $psstats_feature['price'] )) {?><p class="authors"><a class="button-primary"
                                                  rel="noreferrer noopener" target="_blank"
                                                  href="<?php echo esc_url( ! empty( $psstats_feature['download_url'] ) ? $psstats_feature['download_url'] : $psstats_feature['url'] ); ?>">
								    <?php
									    if ($psstats_feature['price'] === 'free' ) {
									        esc_html_e('Download', 'psstats');
									    } else {
										    echo esc_html( $psstats_feature['price'] );
									    } ?>
								 </a>
                            </p><?php   } ?>
                        </div>
                    </div>
                </div>
			    <?php
		    }
		    echo '';
		    echo '</div><div style="clear: both"></div>';
		    if (!empty($psstats_feature_section['more_url'])) {
			    echo '<a target="_blank" rel="noreferrer noopener" href="'.esc_attr($psstats_feature_section['more_url']).'"><span class="dashicons dashicons-arrow-right-alt2"></span>'. esc_html($psstats_feature_section['more_text']).'</a>';
		    }
		    echo '</div>';
	    }
    }

	$psstats_feature_sections = array(
		array(
			'title'    => 'Top free plugins',
			'more_url' => 'https://plugins.psstats.org/free?wp=1',
			'more_text' => 'Browse all free plugins',
			'features' =>
				array(
					array(
						'name'         => 'Marketing Campaigns Reporting',
						'description'  => 'Measure the effectiveness of your marketing campaigns. Track up to five channels instead of two: campaign, source, medium, keyword, content.',
						'price'        => 'free',
						'download_url' => 'https://plugins.psstats.org/api/2.0/plugins/MarketingCampaignsReporting/download/latest?wp=1' . $psstats_extra_url_params,
						'url'          => 'https://plugins.psstats.org/MarketingCampaignsReporting?wp=1&pk_campaign=WP&pk_source=Plugin',
						'image'        => '',
					),
					array(
						'name'         => 'Custom Alerts',
						'description'  => 'Create custom Alerts to be notified of important changes on your website or app!',
						'price'        => 'free',
						'download_url' => 'https://plugins.psstats.org/api/2.0/plugins/CustomAlerts/download/latest?wp=1' . $psstats_extra_url_params,
						'url'          => 'https://plugins.psstats.org/CustomAlerts?wp=1&pk_campaign=WP&pk_source=Plugin',
						'image'        => '',
					),
				),
		),
	);

    psstats_show_tables($psstats_feature_sections);

    echo '<br>';

	$psstats_feature_sections = array(
        array(
		'title'    => 'Most popular premium features',
		'features' =>
			array(
				array(
					'name'        => 'Heatmap & Session Recording',
					'description' => 'Truly understand your visitors by seeing where they click, hover, type and scroll. Replay their actions in a video and ultimately increase conversions.',
					'price'       => '99EUR / 119USD',
					'url'         => 'https://plugins.psstats.org/HeatmapSessionRecording?wp=1',
					'image'       => '',
				),
				array(
					'name'        => 'Custom Reports',
					'description' => 'Pull out the information you need in order to be successful. Develop your custom strategy to meet your individualized goals while saving money & time.',
					'price'       => '99EUR / 119USD',
					'url'         => 'https://plugins.psstats.org/CustomReports?wp=1',
					'image'       => '',
				),

				array(
					'name'        => 'Premium Bundle',
					'description' => 'All premium features in one bundle, make the most out of your Psstats for WordPress and enjoy discounts of over 25%!',
					'price'       => '499EUR / 579USD',
					'url'         => 'https://plugins.psstats.org/WpPremiumBundle?wp=1',
					'image'       => '',
				)
			),
	    ),
		array(
			'title'    => 'Most popular content engagement',
			'features' =>
				array(
					array(
						'name'        => 'Form Analytics',
						'description' => 'Increase conversions on your online forms and lose less visitors by learning everything about your users behavior and their pain points on your forms.',
						'price'       => '79EUR / 89USD',
						'url'         => 'https://plugins.psstats.org/FormAnalytics?wp=1',
						'image'       => '',
					),
					array(
						'name'        => 'Video & Audio Analytics',
						'description' => 'Grow your business with advanced video & audio analytics. Get powerful insights into how your audience watches your videos and listens to your audio.',
						'price'       => '79EUR / 89USD',
						'url'         => 'https://plugins.psstats.org/MediaAnalytics?wp=1',
						'image'       => '',
					),
					array(
						'name'        => 'Users Flow',
						'description' => 'Users Flow is a visual representation of the most popular paths your users take through your website & app which lets you understand your users needs.',
						'price'       => '39EUR / 39USD',
						'url'         => 'https://plugins.psstats.org/UsersFlow?wp=1',
						'image'       => '',
					),
				),
		),
		array(
			'title'    => 'Most popular acquisition & SEO features',
			'features' =>
				array(
					array(
						'name'        => 'Search Engine Keywords Performance',
						'description' => 'All keywords searched by your users on search engines are now visible into your Referrers reports! The ultimate solution to \'Keyword not defined\'.',
						'price'       => '69EUR / 79USD',
						'url'         => 'https://plugins.psstats.org/SearchEngineKeywordsPerformance?wp=1',
						'image'       => '',
					),
					array(
						'name'        => 'Advertising Conversion Export',
						'description' => 'Provides an export of attributed goal conversions for usage in ad networks like Google Ads so you no longer need a conversion pixel.',
						'price'       => '79EUR / 89USD',
						'url'         => 'https://plugins.psstats.org/AdvertisingConversionExport?wp=1',
						'image'       => '',
					),
					array(
						'name'        => 'Multi Attribution',
						'description' => 'Get a clear understanding of how much credit each of your marketing channel is actually responsible for to shift your marketing efforts wisely.',
						'price'       => '39EUR / 39USD',
						'url'         => 'https://plugins.psstats.org/MultiChannelConversionAttribution?wp=1',
						'image'       => '',
					),
					/*
					array(
						'name'        => 'Activity Log',
						'description' => 'Truly understand your visitors by seeing where they click, hover, type and scroll. Replay their actions in a video and ultimately increase conversions',
						'price'       => '19EUR / 19USD',
						'url'         => 'https://plugins.psstats.org/ActivityLog?wp=1',
						'image'       => '',
					),*/
				),
		),
		array(
			'title'    => 'Other premium features',
			'features' =>
				array(
					array(
						'name'        => 'Funnels',
						'description' => 'Identify and understand where your visitors drop off to increase your conversions, sales and revenue with your existing traffic.',
						'price'       => '89EUR / 99USD',
						'url'         => 'https://plugins.psstats.org/Funnels?wp=1',
						'image'       => '',
					),
					array(
						'name'        => 'Cohorts',
						'description' => 'Track your retention efforts over time and keep your visitors engaged and coming back for more.',
						'price'       => '49EUR / 59USD',
						'url'         => 'https://plugins.psstats.org/Cohorts?wp=1',
						'image'       => '',
					),
				),
		),
	);

		psstats_show_tables($psstats_feature_sections);

	?>

</div>
