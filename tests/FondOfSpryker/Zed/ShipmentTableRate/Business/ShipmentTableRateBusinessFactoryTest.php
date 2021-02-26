<?php

namespace FondOfSpryker\Zed\ShipmentTableRate\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\ShipmentTableRate\Business\Model\PriceCalculator;
use FondOfSpryker\Zed\ShipmentTableRate\Dependency\Facade\ShipmentTableRateToCountryFacadeInterface;
use FondOfSpryker\Zed\ShipmentTableRate\Dependency\Facade\ShipmentTableRateToStoreFacadeInterface;
use FondOfSpryker\Zed\ShipmentTableRate\Persistence\ShipmentTableRateRepository;
use FondOfSpryker\Zed\ShipmentTableRate\ShipmentTableRateConfig;
use FondOfSpryker\Zed\ShipmentTableRate\ShipmentTableRateDependencyProvider;
use Spryker\Zed\Kernel\Container;

class ShipmentTableRateBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ShipmentTableRate\Persistence\ShipmentTableRateRepository
     */
    protected $shipmentTableRateRepositoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ShipmentTableRate\ShipmentTableRateConfig
     */
    protected $shipmentTableRateConfigMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ShipmentTableRate\Dependency\Facade\ShipmentTableRateToStoreFacadeInterface
     */
    protected $storeFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ShipmentTableRate\Dependency\Facade\ShipmentTableRateToCountryFacadeInterface
     */
    protected $countryFacadeMock;

    /**
     * @var \FondOfSpryker\Zed\ShipmentTableRate\Business\ShipmentTableRateBusinessFactory
     */
    protected $shipmentTableRateBusinessFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->shipmentTableRateRepositoryMock = $this->getMockBuilder(ShipmentTableRateRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->shipmentTableRateConfigMock = $this->getMockBuilder(ShipmentTableRateConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->storeFacadeMock = $this->getMockBuilder(ShipmentTableRateToStoreFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->countryFacadeMock = $this->getMockBuilder(ShipmentTableRateToCountryFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->shipmentTableRateBusinessFactory = new ShipmentTableRateBusinessFactory();
        $this->shipmentTableRateBusinessFactory->setRepository($this->shipmentTableRateRepositoryMock);
        $this->shipmentTableRateBusinessFactory->setContainer($this->containerMock);
        $this->shipmentTableRateBusinessFactory->setConfig($this->shipmentTableRateConfigMock);
    }

    /**
     * @return void
     */
    public function testCreatePriceCalculator(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [ShipmentTableRateDependencyProvider::FACADE_COUNTRY],
                [ShipmentTableRateDependencyProvider::FACADE_STORE]
            )->willReturnOnConsecutiveCalls(
                $this->countryFacadeMock,
                $this->storeFacadeMock
            );

        $this->assertInstanceOf(
            PriceCalculator::class,
            $this->shipmentTableRateBusinessFactory->createPriceCalculator()
        );
    }
}
