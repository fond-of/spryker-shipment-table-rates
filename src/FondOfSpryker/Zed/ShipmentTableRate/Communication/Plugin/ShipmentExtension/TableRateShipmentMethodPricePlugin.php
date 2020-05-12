<?php

namespace FondOfSpryker\Zed\ShipmentTableRate\Communication\Plugin\ShipmentExtension;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\ShipmentGroupTransfer;
use Generated\Shared\Transfer\ShipmentTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\ShipmentExtension\Dependency\Plugin\ShipmentMethodPricePluginInterface;

/**
 * @method \FondOfSpryker\Zed\ShipmentTableRate\Persistence\ShipmentTableRateQueryContainerInterface getQueryContainer()
 * @method \FondOfSpryker\Zed\ShipmentTableRate\Business\ShipmentTableRateFacadeInterface getFacade()
 */
class TableRateShipmentMethodPricePlugin extends AbstractPlugin implements ShipmentMethodPricePluginInterface
{
    /**
     * Specification:
     *  - Returns shipment method price for shipment group.
     *
     * @param  \Generated\Shared\Transfer\ShipmentGroupTransfer  $shipmentGroupTransfer
     * @param  \Generated\Shared\Transfer\QuoteTransfer  $quoteTransfer
     *
     * @return int
     * @api
     *
     */
    public function getPrice(ShipmentGroupTransfer $shipmentGroupTransfer, QuoteTransfer $quoteTransfer): int
    {
        foreach ($quoteTransfer->getItems() as $item) {
            $shipment = $item->getShipment();

            //ToDo SprykerUpdate: check for the problem before why it is empty and not oh it is empty just escape it...
            if ($shipment === null || $this->validateShipment($shipment) === false) {
                return 0;
            }

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

    /**
     * @param  \Generated\Shared\Transfer\ShipmentTransfer  $shipmentTransfer
     *
     * @return bool
     */
    protected function validateShipment(ShipmentTransfer $shipmentTransfer): bool
    {
        if ($shipmentTransfer->getShippingAddress() === null) {
            return false;
        }

        $address = $shipmentTransfer->getShippingAddress();

        return $address->getIso2Code() !== null && $address->getZipCode() !== null;
    }
}
