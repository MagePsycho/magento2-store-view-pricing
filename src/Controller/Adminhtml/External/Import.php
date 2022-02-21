<?php

namespace MagePsycho\StorePricing\Controller\Adminhtml\External;

use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;

class Import extends \Magento\Backend\App\Action
{
    public function __construct(
        Context $context
    ) {
        parent::__construct($context);
    }

    public function execute()
    {
        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)
            ->setUrl('https://www.magepsycho.com/magento2-mass-regular-special-tier-group-price-importer.html?utm_source=extension-menu&utm_medium=banner&utm_campaign=m2-store-view-pricing');
    }
}
