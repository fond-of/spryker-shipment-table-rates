<?php

namespace FondOfSpryker\Zed\ShipmentTableRate\Communication\Plugin\ShipmentExtension;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\ShipmentTableRate\Business\ShipmentTableRateFacade;
use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\ShipmentGroupTransfer;
use Generated\Shared\Transfer\ShipmentTransfer;
use Generated\Shared\Transfer\StoreTransfer;
use Generated\Shared\Transfer\TotalsTransfer;

class TableRateShipmentMethodPricePluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ShipmentTableRate\Business\ShipmentTableRateFacade
     */
    protected $shipmentTableRateFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteTransfer
     */
    protected $quoteTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject[]|\Generated\Shared\Transfer\ItemTransfer[]
     */
    protected $itemTransferMocks;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ShipmentTransfer
     */
    protected $shipmentTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ShipmentGroupTransfer
     */
    protected $shipmentGroupTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\TotalsTransfer
     */
    protected $totalsTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\AddressTransfer
     */
    protected $addressTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\StoreTransfer
     */
    protected $storeTransferMock;

    /**
     * @var \FondOfSpryker\Zed\ShipmentTableRate\Communication\Plugin\ShipmentExtension\TableRateShipmentMethodPricePlugin
     */
    protected $tableRateShipmentMethodPricePlugin;

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

        $this->itemTransferMocks = [$this->getMockBuilder(ItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock()];

        $this->shipmentTransferMock = $this->getMockBuilder(ShipmentTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->shipmentGroupTransferMock = $this->getMockBuilder(ShipmentGroupTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->totalsTransferMock = $this->getMockBuilder(TotalsTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->addressTransferMock = $this->getMockBuilder(AddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->storeTransferMock = $this->getMockBuilder(StoreTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->tableRateShipmentMethodPricePlugin = new class (
            $this->shipmentTableRateFacadeMock
        ) extends TableRateShipmentMethodPricePlugin {
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
        $price = 1990;
        $priceToPay = 1000;
        $iso2Code = 'DE';
        $zipCode = '12345';
        $storeName = 'STORE';

        $this->quoteTransferMock->expects($this->atLeastOnce())
            ->method('getItems')
            ->willReturn($this->itemTransferMocks);

        $this->itemTransferMocks[0]->expects($this->atLeastOnce())
            ->method('getShipment')
            ->willReturn($this->shipmentTransferMock);

        $this->shipmentTransferMock->expects($this->atLeastOnce())
            ->method('getShippingAddress')
            ->willReturn($this->addressTransferMock);

        $this->quoteTransferMock->expects($this->atLeastOnce())
            ->method('getTotals')
            ->willReturn($this->totalsTransferMock);

        $this->totalsTransferMock->expects($this->atLeastOnce())
            ->method('getPriceToPay')
            ->willReturn($priceToPay);

        $this->addressTransferMock->expects($this->atLeastOnce())
            ->method('getIso2Code')
            ->willReturn($iso2Code);

        $this->addressTransferMock->expects($this->atLeastOnce())
            ->method('getZipCode')
            ->willReturn($zipCode);

        $this->quoteTransferMock->expects($this->atLeastOnce())
            ->method('getStore')
            ->willReturn($this->storeTransferMock);

        $this->storeTransferMock->expects($this->atLeastOnce())
            ->method('getName')
            ->willReturn($storeName);

        $this->shipmentTableRateFacadeMock->expects($this->atLeastOnce())
            ->method('getShipmentPrice')
            ->with(
                $priceToPay,
                $iso2Code,
                $zipCode,
                $storeName
            )->willReturn(
                $price
            );

        $this->assertEquals(
            $price,
            $this->tableRateShipmentMethodPricePlugin->getPrice(
                $this->shipmentGroupTransferMock,
                $this->quoteTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testGetPriceWithoutShippingAddress(): void
    {
        $this->quoteTransferMock->expects($this->atLeastOnce())
            ->method('getItems')
            ->willReturn($this->itemTransferMocks);

        $this->itemTransferMocks[0]->expects($this->atLeastOnce())
            ->method('getShipment')
            ->willReturn($this->shipmentTransferMock);

        $this->shipmentTransferMock->expects($this->atLeastOnce())
            ->method('getShippingAddress')
            ->willReturn(null);

        $this->quoteTransferMock->expects($this->never())
            ->method('getTotals');

        $this->totalsTransferMock->expects($this->never())
            ->method('getPriceToPay');

        $this->addressTransferMock->expects($this->never())
            ->method('getIso2Code');

        $this->addressTransferMock->expects($this->never())
            ->method('getZipCode');

        $this->quoteTransferMock->expects($this->never())
            ->method('getStore');

        $this->storeTransferMock->expects($this->never())
            ->method('getName');

        $this->shipmentTableRateFacadeMock->expects($this->never())
            ->method('getShipmentPrice');

        $this->assertEquals(
            0,
            $this->tableRateShipmentMethodPricePlugin->getPrice(
                $this->shipmentGroupTransferMock,
                $this->quoteTransferMock
            )
        );
    }
}
