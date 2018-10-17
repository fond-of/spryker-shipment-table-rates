<?php

namespace FondOfSpryker\Zed\Shipment\Business\Model;

use FondOfSpryker\Zed\ShipmentTableRate\Persistence\ShipmentQueryContainerInterface;
use Spryker\Shared\Log\LoggerTrait;
use Spryker\Zed\Country\Persistence\CountryQueryContainerInterface;
use Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException;

class TableRateManager
{
    use LoggerTrait;

    /**
     * @var \Pyz\Zed\Shipment\Persistence\ShipmentQueryContainerInterface
     */
    protected $shipmentQueryContainer;

    /**
     * @var \Spryker\Zed\Country\Persistence\CountryQueryContainerInterface
     */
    protected $countryQueryContainer;

    /**
     * @param \Pyz\Zed\Shipment\Persistence\ShipmentQueryContainerInterface $shipmentQueryContainer
     * @param \Spryker\Zed\Country\Persistence\CountryQueryContainerInterface $countryQueryContainer
     */
    public function __construct(
        ShipmentQueryContainerInterface $shipmentQueryContainer,
        CountryQueryContainerInterface $countryQueryContainer
    ) {
        $this->shipmentQueryContainer = $shipmentQueryContainer;
        $this->countryQueryContainer = $countryQueryContainer;
    }

    /**
     * @param float $price
     * @param string $countryIsoCode
     *
     * @return integer
     */
    public function getPriceByCountryCodeAndStoreId($price, $countryIsoCode): float
    {
        $countryId = $this->getCountryIdFromIsoCode($countryIsoCode);

        try {
            $shippingPriceForCountry = $this->shipmentQueryContainer
                ->queryTableRate()
                ->filterByFkCountry($countryId)
                ->findOne();

            if ($price >= $shippingPriceForCountry->getFreeThreshold()) {
                return $shippingPriceForCountry->getPrice();
            }

            return $shippingPriceForCountry->getPrice();
        } catch (AmbiguousComparisonException $e) {
            $this->getLogger()->error('Cannot get shipping price', ['trace' => $e]);
        }

        return null;
    }

    /**
     * @param string $countryIsoCode
     *
     * @return int
     */
    protected function getCountryIdFromIsoCode($countryIsoCode): int
    {
        return $this->countryQueryContainer
            ->queryCountryByIso2Code($countryIsoCode)
            ->findOne()
            ->getIdCountry();
    }
}
