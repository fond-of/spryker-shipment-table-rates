<?php

namespace FondOfSpryker\Zed\ShipmentTableRate\Communication\Plugin\ShipmentExtension;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\ShipmentTableRate\Business\ShipmentTableRateFacade;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\ShipmentGroupTransfer;

class TableRateShipmentMethodPricePluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ShipmentTableRate\Business\ShipmentTableRateFacade
     */
    protected $facadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteTransfer
     */
    protected $quoteTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ShipmentGroupTransfer
     */
    protected $shipmentGroupTransferMock;

    /**
     * @var \FondOfSpryker\Zed\ShipmentTableRate\Communication\Plugin\ShipmentExtension\TableRateShipmentMethodPricePlugin
     */
    protected $tableRateShipmentMethodPricePlugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->facadeMock = $this->getMockBuilder(ShipmentTableRateFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->shipmentGroupTransferMock = $this->getMockBuilder(ShipmentGroupTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->tableRateShipmentMethodPricePlugin = new TableRateShipmentMethodPricePlugin();
        $this->tableRateShipmentMethodPricePlugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testGetPrice(): void
    {
        $price = 495;

        $this->facadeMock->expects($this->atLeastOnce())
            ->method('calculatePrice')
            ->with($this->quoteTransferMock)
            ->willReturn($price);

        $this->assertEquals(
            $price,
            $this->tableRateShipmentMethodPricePlugin->getPrice(
                $this->shipmentGroupTransferMock,
                $this->quoteTransferMock
            )
        );
    }
}
