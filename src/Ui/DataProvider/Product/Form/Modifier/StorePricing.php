<?php

namespace MagePsycho\StorePricing\Ui\DataProvider\Product\Form\Modifier;

use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\Store;
use Magento\Store\Model\StoreManagerInterface;
use MagePsycho\StorePricing\Model\Config as StorePricingConfig;

/**
 * @category MagePsycho
 * @package MagePsycho_StorePricing
 * @author Raj KB <magepsycho@gmail.com>
 * @website https://www.magepsycho.com
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class StorePricing extends AbstractModifier
{
    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    public function __construct(
        StoreManagerInterface $storeManager,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->storeManager = $storeManager;
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * {@inheritdoc}
     */
    public function modifyData(array $data)
    {
        return $data;
    }

    public function modifyMeta(array $meta)
    {
        $scopeLabel = $this->getPriceScopeLabel();
        $meta["product-details"]["children"]["container_price"]["children"]["price"]["arguments"]["data"]["config"]["scopeLabel"] = $scopeLabel;
        $meta["advanced-pricing"]["children"]["container_special_price"]["children"]["special_price"]["arguments"]["data"]["config"]["scopeLabel"] = $scopeLabel;
        $meta["advanced-pricing"]["children"]["container_special_from_date"]["children"]["special_from_date"]["arguments"]["data"]["config"]["scopeLabel"] = $scopeLabel;
        $meta["advanced-pricing"]["children"]["container_special_to_date"]["children"]["special_to_date"]["arguments"]["data"]["config"]["scopeLabel"] = $scopeLabel;
        $meta["advanced-pricing"]["children"]["container_cost"]["children"]["cost"]["arguments"]["data"]["config"]["scopeLabel"] = $scopeLabel;
        //$meta["advanced-pricing"]["children"]["container_tier_price"]["children"]["tier_price"]["arguments"]["data"]["config"]["scopeLabel"] = $scopeLabel;
        $meta["advanced-pricing"]["children"]["container_msrp"]["children"]["msrp"]["arguments"]["data"]["config"]["scopeLabel"] = $scopeLabel;
        return $meta;
    }

    public function getPriceScopeLabel()
    {
        if ($this->storeManager->isSingleStoreMode()) {
            return '';
        }
        $scope = (int)$this->scopeConfig->getValue(
            Store::XML_PATH_PRICE_SCOPE,
            ScopeInterface::SCOPE_STORE
        );
        if ($scope == Store::PRICE_SCOPE_GLOBAL) {
            return '[GLOBAL]';
        } elseif ($scope == Store::PRICE_SCOPE_WEBSITE) {
            return '[WEBSITE]';
        } elseif ($scope == StorePricingConfig::STORE_SCOPE_PRICE_VALUE) {
            return '[STORE VIEW]';
        }
        return '';
    }
}
