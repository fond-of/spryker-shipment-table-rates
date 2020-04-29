<?php

namespace FondOfSpryker\Zed\ShipmentTableRate\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\ShipmentTableRate\Business\Model\TableRateManager;
use FondOfSpryker\Zed\ShipmentTableRate\Persistence\ShipmentTableRateQueryContainer;
use FondOfSpryker\Zed\ShipmentTableRate\ShipmentTableRateDependencyProvider;
use Spryker\Zed\Country\Persistence\CountryQueryContainerInterface;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Store\Persistence\StoreQueryContainerInterface;

class ShipmentTableRateBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\ShipmentTableRate\Business\ShipmentTableRateBusinessFactory
     */
    protected $shipmentTableRateBusinessFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ShipmentTableRate\Persistence\ShipmentTableRateQueryContainer
     */
    protected $shipmentTableRateQueryContainerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Country\Persistence\CountryQueryContainerInterface
     */
    protected $countryQueryContainerInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Store\Persistence\StoreQueryContainerInterface
     */
    protected $storeQueryContainerInterfaceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->shipmentTableRateQueryContainerMock = $this->getMockBuilder(ShipmentTableRateQueryContainer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->countryQueryContainerInterfaceMock = $this->getMockBuilder(CountryQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->storeQueryContainerInterfaceMock = $this->getMockBuilder(StoreQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->shipmentTableRateBusinessFactory = new ShipmentTableRateBusinessFactory();
        $this->shipmentTableRateBusinessFactory->setQueryContainer($this->shipmentTableRateQueryContainerMock);
        $this->shipmentTableRateBusinessFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateTableRateManager(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [ShipmentTableRateDependencyProvider::QUERY_CONTAINER_COUNTRY],
                [ShipmentTableRateDependencyProvider::QUERY_CONTAINER_STORE]
            )->willReturnOnConsecutiveCalls(
                $this->countryQueryContainerInterfaceMock,
                $this->storeQueryContainerInterfaceMock
            );

        $this->assertInstanceOf(
            TableRateManager::class,
            $this->shipmentTableRateBusinessFactory->createTableRateManager()
        );
    }
}
