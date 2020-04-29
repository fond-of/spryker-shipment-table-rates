<?php

namespace FondOfSpryker\Zed\ShipmentTableRate;

use Codeception\Test\Unit;
use Spryker\Zed\Kernel\Container;

class ShipmentTableRateDependencyProviderTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\ShipmentTableRate\ShipmentTableRateDependencyProvider
     */
    protected $shipmentTableRateDependencyProvider;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->shipmentTableRateDependencyProvider = new ShipmentTableRateDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvideBusinessLayerDependencies(): void
    {
        $this->assertInstanceOf(
            Container::class,
            $this->shipmentTableRateDependencyProvider->provideBusinessLayerDependencies(
                $this->containerMock
            )
        );
    }
}
