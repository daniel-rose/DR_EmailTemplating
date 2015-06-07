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

        $params = array(
            '_type'     => 'locale'
        );

        $filePath = Mage::getDesign()->getBaseDir($params) . DS . $localeCode . DS . 'template' . DS . $type . DS . $file;

        if (!file_exists($filePath) && Mage::getDesign()->getTheme('') != Mage::getDesign()->getDefaultTheme()) {
            $params['_theme'] = Mage::getDesign()->getDefaultTheme();

            $filePath = Mage::getDesign()->getBaseDir($params) . DS . $localeCode . DS . 'template' . DS . $type . DS . $file;
        }

        if (!file_exists($filePath)) {
            return parent::getTemplateFile($file, $type, $localeCode);
        }

        $ioAdapter = new Varien_Io_File();
        $ioAdapter->open(array('path' => Mage::getBaseDir('locale')));

        return (string) $ioAdapter->read($filePath);
    }
}