<?php

namespace FondOfSpryker\Zed\ShipmentTableRate\Communication\Plugin\Shipment;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Shipment\Communication\Plugin\ShipmentMethodPricePluginInterface;

class TableRateShipmentMethodPricePlugin extends AbstractPlugin implements ShipmentMethodPricePluginInterface
{
    /**
     * Specification:
     *  - Returns shipment method price for shipment group.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return int
     */
    public function getPrice(QuoteTransfer $quoteTransfer): int
    {
        foreach ($quoteTransfer->getItems() as $item) {
            $shipment = $item->getShipment();

            return $this
                ->getFacade()
                ->getShipmentPrice(
                    $quoteTransfer->getTotals()->getPriceToPay(),
                    $shipment->getShippingAddress()->getIso2Code(),
                    $shipment->getShippingAddress()->getZipCode(),
                    $quoteTransfer->getStore()->getName()
                );
        }

        return 0;
    }
}
