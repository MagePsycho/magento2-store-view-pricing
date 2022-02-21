<?php

namespace MagePsycho\StorePricing\Model\Preference\Catalog\Product\Attribute\Backend;

use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;

/**
 * @category MagePsycho
 * @package MagePsycho_StorePricing
 * @author Raj KB <magepsycho@gmail.com>
 * @website https://www.magepsycho.com
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Startdate extends \Magento\Catalog\Model\Attribute\Backend\Startdate
{
    public function setAttribute($attribute)
    {
        parent::setAttribute($attribute);
        $this->setScope($attribute);
        return $this;
    }

    public function setScope($attribute)
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $helper = $objectManager->create(\MagePsycho\StorePricing\Helper\Data::class);
        if ($helper->isActive()
            && $helper->isPriceStoreScope()
            && $attribute->getAttributeCode() == 'special_from_date'
        ) {
            $attribute->setIsGlobal(ScopedAttributeInterface::SCOPE_STORE);
        }

        return $this;
    }
}
