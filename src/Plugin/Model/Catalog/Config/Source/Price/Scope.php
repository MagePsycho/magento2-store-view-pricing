<?php

namespace MagePsycho\StorePricing\Plugin\Model\Catalog\Config\Source\Price;

use MagePsycho\StorePricing\Helper\Data as StorePricingHelper;
use MagePsycho\StorePricing\Model\Config;

/**
 * @category   MagePsycho
 * @package    MagePsycho_StorePricing
 * @author     Raj KB <magepsycho@gmail.com>
 * @website    http://www.magepsycho.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Scope
{
    /**
     * @var StorePricingHelper
     */
    protected $storePricingHelper;

    public function __construct(
        StorePricingHelper $storePricingHelper
    ) {
        $this->storePricingHelper = $storePricingHelper;
    }

    public function afterToOptionArray(
        \Magento\Catalog\Model\Config\Source\Price\Scope $subject,
        $result
    ) {
        $result[] = [
            'value' => Config::STORE_SCOPE_PRICE_VALUE,
            'label' => __('Store View')
        ];
        return $result;
    }
}
