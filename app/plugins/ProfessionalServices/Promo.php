<?php
/**
 * Psstats - free/libre analytics platform
 *
 * @link https://psstats.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\ProfessionalServices;

use Piwik\ProfessionalServices\Advertising;

class Promo
{
    protected $linkTitles = array('Read more', 'Learn more');

    protected $content = array();

    public function __construct()
    {
        $this->content = array(
            // A/B Testing
            array(
                'campaignContent' => 'abTesting',
                'title' => 'A/B Testing',
                'url' => 'https://psstats.org/recommends/ab-testing-learn-more',
                'text' => 'Ever wondered what A/B testing is and why it is so important? Check out how you can increase conversions and sales on your website and app.'
            ),
            array(
                'campaignContent' => 'abTesting',
                'title' => 'A/B Testing',
                'url' => ' https://psstats.org/recommends/ab-testing-website',
                'text' => 'Increase revenue and conversions by comparing different versions of your websites or apps, ad detect the winning variation that will grow your business!'
            ),

            // Media Analytics
            array(
                'campaignContent' => 'mediaAnalytics',
                'title' => 'Media Analytics',
                'url' => 'https://psstats.org/recommends/media-analytics-website',
                'text' => 'Ever wondered how people interact and engage with videos or audios on your website? Well now you can, and it integrates perfectly into your Psstats.',
            ),
            array(
                'campaignContent' => 'mediaAnalytics',
                'title' => 'Media Analytics',
                'url' => 'https://psstats.org/recommends/media-analytics',
                'text' => 'Get powerful insights into how your audience watches your videos and listens to your audio. Media Analytics is now available on the Marketplace.',
            ),

            // Form
            array(
                'campaignContent' => 'formAnalytics',
                'title' => 'Form Analytics',
                'url' => 'https://psstats.org/recommends/form-analytics',
                'text' => 'Increase the conversions on your online forms, by learning everything about your users behavior and their pain points on your forms',
            ),

            // Funnels
            array(
                'campaignContent' => 'funnels',
                'title' => 'Funnels',
                'url' => 'https://psstats.org/recommends/conversion-funnels',
                'text' => 'Increase your conversions, sales and revenue by understanding your conversion funnels and where your visitors drop off with Funnels for Psstats.'
            ),

            // Keywords performance
            array(
                'campaignContent' => 'searchKeywords',
                'title' => 'Search Keywords',
                'url' => 'https://psstats.org/recommends/search-keywords-performance/',
                'text' => 'Which queries caused your website to appear in search results? Improve your SEO efforts and monitor your position and performance for each Keyword directly in your Psstats reports.',
            ),
            // Roll-Up Reporting
            array(
                'campaignContent' => 'rollUp',
                'title' => 'Roll-Up Reporting',
                'url' => 'https://psstats.org/recommends/roll-up-reporting/',
                'text' => 'Did you know you can aggregate the collected data across hundreds of sites and display it in a single dashboard?',
            ),
            // White label
            array(
                'campaignContent' => 'whiteLabel',
                'title' => 'White Label',
                'url' => 'https://psstats.org/recommends/white-label/',
                'text' => 'Did you know you can give your clients access to their analytics reports where all Psstats-branded widgets are removed? Try the White Label product!',
            ),
            // Enterprise
            array(
                'campaignContent' => 'bringEnterpriseLevel',
                'title' => 'Enterprise',
                'url' => 'https://psstats.org/recommends/enterprise/',
                'text' => 'Bring your analytics to enterprise level. Upgrade your Psstats platform and receive access to numerous premium features and assistance from experts.'
            ),
            array(
                'campaignContent' => 'slowingDown',
                'title' => 'Enterprise',
                'url' => 'https://psstats.org/recommends/enterprise/',
                'text' => 'Is your Psstats slowing down? Psstats experts can help with your server setup!'
            ),
            array(
                'campaignContent' => 'discoverPower',
                'title' => 'Enterprise',
                'url' => 'https://psstats.org/recommends/enterprise/',
                'text' => 'Discover the power of open-source combined with enterprise-grade support and premium functionalities.'
            ),
        );
    }

    public function getLinkTitle()
    {
        $titles = $this->linkTitles;
        shuffle($titles);

        return array_shift($titles);
    }

    public function getContent()
    {
        $content = $this->content;
        shuffle($content);

        return array_shift($content);
    }
}
