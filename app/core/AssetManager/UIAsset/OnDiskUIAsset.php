<?php
/**
 * Psstats - free/libre analytics platform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\AssetManager\UIAsset;

use Exception;
use Piwik\AssetManager\UIAsset;
use Piwik\Common;
use Piwik\Filesystem;

class OnDiskUIAsset extends UIAsset
{
    /**
     * @var string
     */
    private $baseDirectory;

    /**
     * @var string
     */
    private $relativeLocation;

    /**
     * @var string
     */
    private $relativeRootDir;

    /**
     * @param string $baseDirectory
     * @param string $fileLocation
     */
    public function __construct($baseDirectory, $fileLocation, $relativeRootDir = '')
    {
        $this->baseDirectory = $baseDirectory;
        $this->relativeLocation = $fileLocation;

        if (!empty($relativeRootDir)
            && is_string($relativeRootDir)
            && !Common::stringEndsWith($relativeRootDir, '/')) {
            $relativeRootDir .= '/';
        }

        $this->relativeRootDir = $relativeRootDir;
    }

    public function getAbsoluteLocation()
    {
        return $this->baseDirectory . '/' . $this->relativeLocation;
    }

    public function getRelativeLocation()
    {
        if (isset($this->relativeRootDir)) {
            return $this->relativeRootDir . $this->relativeLocation;
        }
        return $this->relativeLocation;
    }

    public function getBaseDirectory()
    {
        return $this->baseDirectory;
    }

    public function validateFile()
    {
        if (!$this->assetIsReadable()) {
            throw new Exception("Das ui-Asset mit 'href' = " . $this->getAbsoluteLocation() . " ist nicht lesbar");
        }
    }

    public function delete()
    {
        if ($this->exists()) {
            try {
                Filesystem::remove($this->getAbsoluteLocation());
            } catch (Exception $e) {
                throw new Exception("Zusammengeführte Datei kann nicht gelöscht werden : " . $this->getAbsoluteLocation() . ". Bitte die Datei löschen und aktualisieren");
            }

            // try to remove compressed version of the merged file.
            Filesystem::remove($this->getAbsoluteLocation() . ".deflate", true);
            Filesystem::remove($this->getAbsoluteLocation() . ".gz", true);
        }
    }

    /**
     * @param string $content
     * @throws \Exception
     */
    public function writeContent($content)
    {
        $this->delete();

        $newFile = @fopen($this->getAbsoluteLocation(), "w");

        if (!$newFile) {
            throw new Exception("Die Datei : " . $newFile . " kann nicht im Schreibmodus geöffnet werden.");
        }

        fwrite($newFile, $content);

        fclose($newFile);
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return file_get_contents($this->getAbsoluteLocation());
    }

    public function exists()
    {
        return $this->assetIsReadable();
    }

    /**
     * @return boolean
     */
    private function assetIsReadable()
    {
        return is_readable($this->getAbsoluteLocation());
    }

    public function getModificationDate()
    {
        return filemtime($this->getAbsoluteLocation());
    }
}
