<?php

namespace MagePsycho\StorePricing\Block\Adminhtml\System\Config\Form\Field;

use Magento\Backend\Block\Template\Context;
use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;
use MagePsycho\StorePricing\Model\Config\ModuleMetadata;
use MagePsycho\StorePricing\Helper\Data as StorePricingHelper;

/**
 * @category MagePsycho
 * @package MagePsycho_StorePricing
 * @author Raj KB <magepsycho@gmail.com>
 * @website https://www.magepsycho.com
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Version extends Field
{
    /**
     * @var StorePricingHelper
     */
    protected $goToCatalogHelper;

    /**
     * @var ModuleMetadata
     */
    private $moduleMetadata;

    public function __construct(
        Context $context,
        StorePricingHelper $goToCatalogHelper,
        ModuleMetadata $moduleMetadata
    ) {
        $this->goToCatalogHelper = $goToCatalogHelper;
        $this->moduleMetadata = $moduleMetadata;
        parent::__construct($context);
    }

    protected function _getElementHtml(AbstractElement $element)
    {
        $versionLabel = sprintf(
            '<a href="%s" title="%s" target="_blank">%s</a>',
            $this->moduleMetadata->getUrl(),
            $this->moduleMetadata->getName(),
            $this->moduleMetadata->getVersion()
        );
        $element->setValue($versionLabel);

        return $element->getValue();
    }
}
