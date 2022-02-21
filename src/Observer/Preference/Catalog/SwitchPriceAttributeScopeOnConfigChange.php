<?php

namespace MagePsycho\StorePricing\Observer\Preference\Catalog;

use Magento\Catalog\Api\Data\ProductAttributeInterface;
use Magento\Catalog\Api\ProductAttributeRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\App\Config\ReinitableConfigInterface;
use Magento\Framework\Event\Observer as EventObserver;
use Magento\Store\Model\Store;
use MagePsycho\StorePricing\Helper\Data as StorePricingHelper;

/**
 * @category MagePsycho
 * @package MagePsycho_StorePricing
 * @author Raj KB <magepsycho@gmail.com>
 * @website https://www.magepsycho.com
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class SwitchPriceAttributeScopeOnConfigChange extends \Magento\Catalog\Observer\SwitchPriceAttributeScopeOnConfigChange
{
    /**
     * @var ReinitableConfigInterface
     */
    private $config;

    /**
     * @var ProductAttributeRepositoryInterface
     */
    private $productAttributeRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var StorePricingHelper
     */
    private $storePricingHelper;

    public function __construct(
        ReinitableConfigInterface $config,
        ProductAttributeRepositoryInterface $productAttributeRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        StorePricingHelper $advPricingHelper
    ) {
        $this->config = $config;
        $this->productAttributeRepository = $productAttributeRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->storePricingHelper = $advPricingHelper;
    }

    public function execute(EventObserver $observer)
    {
        /*if (!$this->storePricingHelper->isActive() || !$this->storePricingHelper->isPriceStoreScope()) {
            parent::execute($observer);
            return $this;
        }*/

        $this->searchCriteriaBuilder->addFilter('frontend_input', 'price');
        $criteria = $this->searchCriteriaBuilder->create();

        $scope = $this->config->getValue(Store::XML_PATH_PRICE_SCOPE);
        $scope = ($scope == \MagePsycho\StorePricing\Model\Config::STORE_SCOPE_PRICE_VALUE)
            ? ProductAttributeInterface::SCOPE_STORE_TEXT
            : (
                ($scope == Store::PRICE_SCOPE_WEBSITE)
                ? ProductAttributeInterface::SCOPE_WEBSITE_TEXT
                : ProductAttributeInterface::SCOPE_GLOBAL_TEXT
            );

        $priceAttributes = $this->productAttributeRepository->getList($criteria)->getItems();

        /** @var ProductAttributeInterface $priceAttribute */
        foreach ($priceAttributes as $priceAttribute) {
            $priceAttribute->setScope($scope);
            $this->productAttributeRepository->save($priceAttribute);
        }
    }
}
