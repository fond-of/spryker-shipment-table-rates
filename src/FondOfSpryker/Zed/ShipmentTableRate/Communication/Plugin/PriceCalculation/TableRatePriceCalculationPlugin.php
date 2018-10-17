
<?php
namespace FondOfSpryker\Zed\Shipment\Communication\Plugin\PriceCalculation;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Shipment\Communication\Plugin\ShipmentMethodPricePluginInterface;

/**
 * @method \Spryker\Zed\Shipment\Communication\ShipmentCommunicationFactory getFactory()
 * @method \Pyz\Zed\Shipment\Business\ShipmentFacade getFacade()
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
        $price = $quoteTransfer->getTotals()->getPriceToPay();
        $countryIsoCode = $quoteTransfer->getShippingAddress()->getIso2Code();

        $price = $this->getFacade()->getPriceForCountry($price, $countryIsoCode);

        return $price;
    }
}
