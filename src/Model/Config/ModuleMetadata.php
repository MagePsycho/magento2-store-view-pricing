<?php

namespace MagePsycho\StorePricing\Model\Config;

use Magento\Framework\App\CacheInterface;
use Magento\Framework\App\Config;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\App\ProductMetadataInterface;
use Magento\Framework\Component\ComponentRegistrarInterface;
use Magento\Framework\Filesystem\Directory\ReadFactory;
use Magento\Framework\Module\ModuleListInterface;

/**
 * @category MagePsycho
 * @package MagePsycho_StorePricing
 * @author Raj KB <magepsycho@gmail.com>
 * @website https://www.magepsycho.com
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class ModuleMetadata implements ModuleMetadataInterface
{
    const PLATFORM_NAME = 'Magento 2';

    const PLATFORM_NAME_SHORT = 'M2';

    const PRODUCT_NAME = 'Store View Pricing';

    const PRODUCT_URL = 'https://www.magepsycho.com/magento2-store-view-pricing.html';

    const MODULE_NAME = 'MagePsycho_StorePricing';

    const VERSION_CACHE_KEY = 'magepsycho-storepricing-module-version';

    /**
     * Module version
     *
     * @var string
     */
    protected $version;

    /**
     * Magento Version
     *
     * @var string
     */
    protected $mageVersion;

    /**
     * Magento Edition
     *
     * @var string
     */
    protected $mageEdition;

    /**
     * @var ProductMetadataInterface
     */
    private $productMetadata;

    /**
     * @var CacheInterface
     */
    private $cache;

    /**
     * @var ModuleListInterface
     */
    private $moduleList;

    /**
     * @var ComponentRegistrarInterface
     */
    private $componentRegistrar;

    /**
     * @var ReadFactory
     */
    private $readFactory;

    public function __construct(
        ProductMetadataInterface $productMetadata,
        ModuleListInterface $moduleList,
        ComponentRegistrarInterface $componentRegistrar,
        ReadFactory $readFactory,
        CacheInterface $cache = null
    ) {
        $this->cache = $cache ?: ObjectManager::getInstance()->get(CacheInterface::class);
        $this->productMetadata = $productMetadata;
        $this->moduleList = $moduleList;
        $this->componentRegistrar = $componentRegistrar;
        $this->readFactory = $readFactory;
    }

    /**
     * Get Product version
     *
     * @return string
     */
    public function getVersion()
    {
        $this->version = $this->version ?: $this->cache->load(self::VERSION_CACHE_KEY);
        if (!$this->version) {
            if (!($this->version = $this->getSetupVersion())) {
                $this->version = $this->getComposerVersion();
            }
            $this->cache->save($this->version, self::VERSION_CACHE_KEY, [Config::CACHE_TAG]);
        }
        return $this->version;
    }

    /**
     * Get Product edition
     *
     * @return string
     */
    public function getEdition()
    {
        return $this->getMageEdition();
    }

    /**
     * Get Magento version
     *
     * @return string
     */
    public function getMageVersion()
    {
        if (!$this->mageVersion) {
            $this->mageVersion = $this->productMetadata->getVersion();
        }
        return $this->mageVersion;
    }

    /**
     * Get Magento edition
     *
     * @return string
     */
    public function getMageEdition()
    {
        if (!$this->mageEdition) {
            $this->mageEdition = $this->productMetadata->getEdition();
        }
        return $this->mageEdition;
    }

    /**
     * Get Platform name
     *
     * @return string
     */
    public function getPlatform()
    {
        return self::PLATFORM_NAME;
    }

    /**
     * Get Platform short name
     *
     * @return string
     */
    public function getPlatformShort()
    {
        return self::PLATFORM_NAME_SHORT;
    }

    /**
     * Get Product name
     *
     * @return string
     */
    public function getName()
    {
        return self::PRODUCT_NAME;
    }

    /**
     * Get Product URL
     *
     * @return string
     */
    public function getUrl()
    {
        return self::PRODUCT_URL;
    }

    private function getSetupVersion()
    {
        $moduleInfo = $this->moduleList->getOne(self::MODULE_NAME);
        return $moduleInfo['setup_version'];
    }

    private function getComposerVersion()
    {
        $path = $this->componentRegistrar->getPath(
            \Magento\Framework\Component\ComponentRegistrar::MODULE,
            self::MODULE_NAME
        );
        $directoryRead = $this->readFactory->create($path);
        $composerJsonData = $directoryRead->readFile('composer.json');
        $data = \json_decode($composerJsonData);

        return !empty($data->version) ? $data->version : __('NA');
    }
}
