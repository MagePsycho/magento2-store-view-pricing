<?php

namespace MagePsycho\StorePricing\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

/**
 * @category MagePsycho
 * @package MagePsycho_StorePricing
 * @author Raj KB <magepsycho@gmail.com>
 * @website https://www.magepsycho.com
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Config implements ConfigInterface
{
    const STORE_SCOPE_PRICE_VALUE = 2;
    const XML_PATH_ENABLED = 'magepsycho_storepricing/general/enabled';
    const XML_PATH_DEBUG = 'magepsycho_storepricing/general/debug';
    const XML_PATH_PRICE_SCOPE = 'catalog/price/scope';

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @inheritDoc
     */
    public function getConfigFlag($xmlPath, $storeId = null)
    {
        return $this->scopeConfig->isSetFlag(
            $xmlPath,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * @inheritDoc
     */
    public function getConfigValue($xmlPath, $storeId = null)
    {
        return $this->scopeConfig->getValue(
            $xmlPath,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    public function isEnabled($storeId = null)
    {
        return $this->getConfigFlag(self::XML_PATH_ENABLED, $storeId);
    }

    public function isDebugEnabled($storeId = null)
    {
        return $this->getConfigFlag(self::XML_PATH_DEBUG, $storeId);
    }

    public function isPriceStoreScope($storeId = null)
    {
        $active =  $this->getConfigValue(self::XML_PATH_PRICE_SCOPE, $storeId);
        if ($active == static::STORE_SCOPE_PRICE_VALUE) {
            return true;
        }

        return false;
    }
}
