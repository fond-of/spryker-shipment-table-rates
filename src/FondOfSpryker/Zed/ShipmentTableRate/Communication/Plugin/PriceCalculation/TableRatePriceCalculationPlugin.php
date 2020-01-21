<?php

namespace FondOfSpryker\Zed\ShipmentTableRate\Communication\Plugin\PriceCalculation;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Shipment\Communication\Plugin\ShipmentMethodPricePluginInterface;

/**
 * @method \FondOfSpryker\Zed\ShipmentTableRate\Business\ShipmentTableRateFacade getFacade()
 * @method \FondOfSpryker\Zed\ShipmentTableRate\Persistence\ShipmentTableRateQueryContainerInterface getQueryContainer()
 */
class TableRatePriceCalculationPlugin extends AbstractPlugin implements ShipmentMethodPricePluginInterface
{
    /**
     * Retrieve Shipment Price
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @throws
     *
     * @return int
     */
    public function getPrice(QuoteTransfer $quoteTransfer): int
    {
        return $this
            ->getFacade()
            ->getShipmentPrice(
                $quoteTransfer->getTotals()->getPriceToPay(),
                $quoteTransfer->getShippingAddress()->getIso2Code(),
                $quoteTransfer->getShippingAddress()->getZipCode(),
                $quoteTransfer->getStore()->getName()
            );
    }
}
