<?php

namespace FondOfSpryker\Zed\ShipmentTableRate\Communication\Plugin\PriceCalculation;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Shipment\Communication\Plugin\ShipmentMethodPricePluginInterface;

/**
 * @method \FondOfSpryker\Zed\ShipmentTableRate\Business\ShipmentTableRateFacade getFacade()
 */
class TableRatePriceCalculationPlugin extends AbstractPlugin implements ShipmentMethodPricePluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return integer
     */
    public function getPrice(QuoteTransfer $quoteTransfer): float
    {
        return $this
            ->getFacade()
            ->getPriceByCountryIso2CodeAndStoreName(
                $quoteTransfer->getTotals()->getPriceToPay(),
                $quoteTransfer->getShippingAddress()->getIso2Code(),
                $quoteTransfer->getStore()->getName()
            );
    }
}