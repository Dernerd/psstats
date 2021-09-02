<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */

namespace Piwik\Plugins\WordPress\Commands;

use Piwik\AssetManager;
use Piwik\Filesystem;
use Piwik\FrontController;
use Piwik\Piwik;
use Piwik\Plugin\ConsoleCommand;
use Piwik\Plugins\Installation\ServerFilesGenerator;
use Piwik\Plugins\WordPress\WpAssetManager;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

if (!defined( 'ABSPATH')) {
	exit; // if accessed directly
}

class GenerateCoreAssets extends ConsoleCommand
{
    protected function configure()
    {
        $this->setName('wordpress:generate-core-assets');
        $this->setDescription('Generiere die JS-Kern-Asset-Datei');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
	    ServerFilesGenerator::createFilesForSecurity();

    	Piwik::addAction('AssetManager.makeNewAssetManagerObject', function (&$assetManager) {
		    $assetManager = new AssetManager();
	    });

	    Piwik::addAction('AssetManager.getJavaScriptFiles', function (&$files){
	    	foreach ($files as $index => $file) {
	    		$basename = basename($file);
			    $basename = strtolower($basename);
	    		if ($basename === 'jquery.js'
			        || $basename === 'jquery.min.js'
			        || $basename === 'materialize.min.js' // we embed it manually as it needs to be loaded before jquery ui
			        || $basename === 'jquery-ui.js'
			        || $basename === 'jquery-ui.min.js') {
				    // we are not allowed to ship psstats with that
				    $files[$index] = null;
			    }
		    }
		    $files = array_values(array_filter($files));
	    });

	    FrontController::getInstance()->init();

        // make sure it will regenerate the core asset file
        Filesystem::deleteAllCacheOnUpdate();
        $assetManager = AssetManager::getInstance();
        if ($assetManager instanceof WpAssetManager) {
        	throw new \Exception('Wird ein falscher Asset-Verwalter verwendet, sollte er den Kern-Asset-Verwalter verwenden');
        }
        $content = $assetManager->getMergedCoreJavaScript()->getContent();

        file_put_contents(plugin_dir_path(PSSTATS_ANALYTICS_FILE) . 'assets/js/asset_manager_core_js.js', $content);
    }

}
