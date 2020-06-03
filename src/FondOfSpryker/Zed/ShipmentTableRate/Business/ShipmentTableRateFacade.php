<?php

namespace FondOfSpryker\Zed\ShipmentTableRate\Business;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\ShipmentGroupTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfSpryker\Zed\ShipmentTableRate\Business\ShipmentTableRateBusinessFactory getFactory()
 * @method \FondOfSpryker\Zed\ShipmentTableRate\Persistence\ShipmentTableRateRepositoryInterface getRepository()
 */
class ShipmentTableRateFacade extends AbstractFacade implements ShipmentTableRateFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param \Generated\Shared\Transfer\ShipmentGroupTransfer|null $shipmentGroupTransfer|null
     *
     * @return int
     */
    public function calculatePrice(
        QuoteTransfer $quoteTransfer,
        ?ShipmentGroupTransfer $shipmentGroupTransfer = null
    ): int {
        return $this->getFactory()
            ->createPriceCalculator()
            ->calculate($quoteTransfer, $shipmentGroupTransfer);
    }
}
