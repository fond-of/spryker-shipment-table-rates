<?php

namespace FondOfSpryker\Zed\ShipmentTableRate\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\ShipmentTableRate\Business\Model\TableRateManager;

class ShipmentTableRateFacadeTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\ShipmentTableRate\Business\ShipmentTableRateFacade
     */
    protected $shipmentTableRateFacade;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ShipmentTableRate\Business\ShipmentTableRateBusinessFactory
     */
    protected $shipmentTableRateBusinessFactoryMock;

    /**
     * @var int
     */
    protected $price;

    /**
     * @var string
     */
    protected $countryIso2Code;

    /**
     * @var string
     */
    protected $zipCode;

    /**
     * @var string
     */
    protected $storeName;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ShipmentTableRate\Business\Model\TableRateManager
     */
    protected $tableRateManagerMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->shipmentTableRateBusinessFactoryMock = $this->getMockBuilder(ShipmentTableRateBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->price = 1;

        $this->countryIso2Code = 'country-iso-2-code';

        $this->zipCode = 'zip-code';

        $this->storeName = 'store-name';

        $this->tableRateManagerMock = $this->getMockBuilder(TableRateManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->shipmentTableRateFacade = new ShipmentTableRateFacade();
        $this->shipmentTableRateFacade->setFactory($this->shipmentTableRateBusinessFactoryMock);
    }

    /**
     * @return void
     */
    public function testGetShipmentPrice(): void
    {
        $this->shipmentTableRateBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createTableRateManager')
            ->willReturn($this->tableRateManagerMock);

        $this->tableRateManagerMock->expects($this->atLeastOnce())
            ->method('getShipmentPrice')
            ->with(
                $this->price,
                $this->countryIso2Code,
                $this->zipCode,
                $this->storeName
            )->willReturn($this->price);

        $this->assertIsInt(
            $this->shipmentTableRateFacade->getShipmentPrice(
                $this->price,
                $this->countryIso2Code,
                $this->zipCode,
                $this->storeName
            )
        );
    }
}
