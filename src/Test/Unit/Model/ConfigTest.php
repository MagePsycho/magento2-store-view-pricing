<?php

namespace MagePsycho\StorePricing\Test\Unit\Helper;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use MagePsycho\StorePricing\Model\Config;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager as ObjectManagerHelper;

/**
 * @category MagePsycho
 * @package MagePsycho_StorePricing
 * @author Raj KB <magepsycho@gmail.com>
 * @website https://www.magepsycho.com
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class ConfigTest extends TestCase
{
    /**
     * @var Config
     */
    protected $model;

    /**
     * @var ScopeConfigInterface|MockObject
     */
    protected $scopeConfigMock;

    protected function setUp(): void
    {
        $this->scopeConfigMock = $this->getMockBuilder(ScopeConfigInterface::class)
            ->setMethods(['getValue', 'isSetFlag'])
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();

        $objectManager = new ObjectManagerHelper($this);
        $this->model = $objectManager->getObject(
            Config::class,
            [
                'scopeConfig' => $this->scopeConfigMock
            ]
        );
    }

    /**
     * Test isEnabled()
     *
     * @return void
     * @dataProvider isEnabledDataProvider
     */
    public function testIsEnabled($isSetFlag, $result): void
    {
        $this->scopeConfigMock->expects($this->once())
            ->method('isSetFlag')
            ->with(Config::XML_PATH_ENABLED, ScopeInterface::SCOPE_STORE)
            ->willReturn($isSetFlag);

        $this->assertEquals($result, $this->model->isEnabled());
    }

    /**
     * Data provider for isEnabled()
     *
     * @return array
     */
    public function isEnabledDataProvider(): array
    {
        return [
            [true, true],
            [false, false]
        ];
    }

    /**
     * Test isDebugEnabled()
     *
     * @return void
     * @dataProvider isEnabledDataProvider
     */
    public function testIsDebugEnabled($isSetFlag, $result): void
    {
        $this->scopeConfigMock->expects($this->once())
            ->method('isSetFlag')
            ->with(Config::XML_PATH_DEBUG, ScopeInterface::SCOPE_STORE)
            ->willReturn($isSetFlag);

        $this->assertEquals($result, $this->model->isDebugEnabled());
    }
}
