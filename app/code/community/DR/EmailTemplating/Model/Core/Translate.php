<?php
/**
 * Translate model
 *
 * @category   DR
 * @package    DR_DR_EmailTemplating
 * @author     Daniel Rose <daniel-rose@gmx.de>
 * @copyright  Copyright (c) 2015 Daniel Rose
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class DR_EmailTemplating_Model_Core_Translate extends Mage_Core_Model_Translate
{
    /**
     * Retrieve translated template file
     *
     * @param string $file
     * @param string $type
     * @param string $localeCode
     * @return string
     */
    public function getTemplateFile($file, $type, $localeCode = null)
    {
        if (is_null($localeCode) || preg_match('/[^a-zA-Z_]/', $localeCode)) {
            $localeCode = $this->getLocale();
        }

        $design = Mage::getDesign();
        $package = Mage::getDesign()->getPackageName();
        $theme = Mage::getDesign()->getTheme('');

        $params = array(
            '_type'     => 'locale',
            '_package'  => $package,
            '_theme'    => $theme
        );

        $filePath = $design->getBaseDir($params) . DS . $localeCode . DS . 'template' . DS . $type . DS . $file;

        if (!file_exists($filePath) && $theme != $design->getDefaultTheme()) {
            $params['_theme'] = $design->getDefaultTheme();

            $filePath = $design->getBaseDir($params) . DS . $localeCode . DS . 'template' . DS . $type . DS . $file;
        }

        if (!file_exists($filePath) && $package != Mage_Core_Model_Design_Package::DEFAULT_PACKAGE) {
            $params['_package'] = Mage_Core_Model_Design_Package::DEFAULT_PACKAGE;

            $filePath = $design->getBaseDir($params) . DS . $localeCode . DS . 'template' . DS . $type . DS . $file;
        }

        if (!file_exists($filePath) && $package != Mage_Core_Model_Design_Package::BASE_PACKAGE) {
            $params['_package'] = Mage_Core_Model_Design_Package::BASE_PACKAGE;

            $filePath = $design->getBaseDir($params) . DS . $localeCode . DS . 'template' . DS . $type . DS . $file;
        }

        if (!file_exists($filePath)) {
            return parent::getTemplateFile($file, $type, $localeCode);
        }

        $ioAdapter = new Varien_Io_File();
        $ioAdapter->open(array('path' => $design->getBaseDir($params)));

        return (string) $ioAdapter->read($filePath);
    }
}