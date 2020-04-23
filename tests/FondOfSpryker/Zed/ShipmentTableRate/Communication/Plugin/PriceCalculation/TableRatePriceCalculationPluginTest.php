<?php

namespace FondOfSpryker\Zed\ShipmentTableRate\Communication\Plugin\PriceCalculation;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\ShipmentTableRate\Business\ShipmentTableRateFacade;
use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\StoreTransfer;
use Generated\Shared\Transfer\TotalsTransfer;

class TableRatePriceCalculationPluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\ShipmentTableRate\Communication\Plugin\PriceCalculation\TableRatePriceCalculationPlugin
     */
    protected $tableRatePriceCalculationPlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteTransfer
     */
    protected $quoteTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ShipmentTableRate\Business\ShipmentTableRateFacade
     */
    protected $shipmentTableRateFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\TotalsTransfer
     */
    protected $totalsTransferMock;

    /**
     * @var int
     */
    protected $priceToPay;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\AddressTransfer
     */
    protected $addressTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\StoreTransfer
     */
    protected $storeTransferMock;

    /**
     * @var string
     */
    protected $iso2Code;

    /**
     * @var string
     */
    protected $zipCode;

    /**
     * @var string
     */
    protected $storeName;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->shipmentTableRateFacadeMock = $this->getMockBuilder(ShipmentTableRateFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->totalsTransferMock = $this->getMockBuilder(TotalsTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->priceToPay = 1;

        $this->addressTransferMock = $this->getMockBuilder(AddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->storeTransferMock = $this->getMockBuilder(StoreTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->iso2Code = 'iso-2-code';

        $this->zipCode = 'zip-code';

        $this->storeName = 'store-name';

        $this->tableRatePriceCalculationPlugin = new class (
            $this->shipmentTableRateFacadeMock
        ) extends TableRatePriceCalculationPlugin {
            /**
             * @var \FondOfSpryker\Zed\ShipmentTableRate\Business\ShipmentTableRateFacade
             */
            protected $shipmentTableRateFacade;

            /**
             * @param \FondOfSpryker\Zed\ShipmentTableRate\Business\ShipmentTableRateFacade $shipmentTableRateFacade
             */
            public function __construct(ShipmentTableRateFacade $shipmentTableRateFacade)
            {
                $this->shipmentTableRateFacade = $shipmentTableRateFacade;
            }

            /**
             * @return \FondOfSpryker\Zed\ShipmentTableRate\Business\ShipmentTableRateFacade
             */
            public function getFacade(): ShipmentTableRateFacade
            {
                return $this->shipmentTableRateFacade;
            }
        };
    }

    /**
     * @return void
     */
    public function testGetPrice(): void
    {
        $this->quoteTransferMock->expects($this->atLeastOnce())
            ->method('getTotals')
            ->willReturn($this->totalsTransferMock);

        $this->totalsTransferMock->expects($this->atLeastOnce())
            ->method('getPriceToPay')
            ->willReturn($this->priceToPay);

        $this->quoteTransferMock->expects($this->atLeastOnce())
            ->method('getShippingAddress')
            ->willReturn($this->addressTransferMock);

        $this->addressTransferMock->expects($this->atLeastOnce())
            ->method('getIso2Code')
            ->willReturn($this->iso2Code);

        $this->addressTransferMock->expects($this->atLeastOnce())
            ->method('getZipCode')
            ->willReturn($this->zipCode);

        $this->quoteTransferMock->expects($this->atLeastOnce())
            ->method('getStore')
            ->willReturn($this->storeTransferMock);

        $this->storeTransferMock->expects($this->atLeastOnce())
            ->method('getName')
            ->willReturn($this->storeName);

        $this->shipmentTableRateFacadeMock->expects($this->atLeastOnce())
            ->method('getShipmentPrice')
            ->with(
                $this->priceToPay,
                $this->iso2Code,
                $this->zipCode,
                $this->storeName
            )->willReturn(
                $this->priceToPay
            );

        $this->assertIsInt(
            $this->tableRatePriceCalculationPlugin->getPrice(
                $this->quoteTransferMock
            )
        );
    }
}
