<?php

namespace FondOfSpryker\Zed\ShipmentTableRate\Business\Model;

use FondOfSpryker\Zed\ShipmentTableRate\Persistence\ShipmentQueryContainerInterface;
use FondOfSpryker\Zed\ShipmentTableRate\Persistence\ShipmentTableRateQueryContainerInterface;
use Generated\Shared\Transfer\CountryTransfer;
use Generated\Shared\Transfer\StoreTransfer;
use Orm\Zed\ShipmentTableRate\Persistence\FosShipmentTableRateQuery;
use Spryker\Zed\Country\Persistence\CountryQueryContainerInterface;
use Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException;
use Spryker\Zed\Store\Persistence\StoreQueryContainerInterface;

class TableRateManager
{
    /**
     * @var \FondOfSpryker\Zed\ShipmentTableRate\Persistence\ShipmentTableRateQueryContainerInterface $shipmentTableRateQueryContainer
     */
    protected $shipmentTableRateQueryContainer;

    /**
     * @var \Spryker\Zed\Country\Persistence\CountryQueryContainerInterface
     */
    protected $countryQueryContainer;

    /**
     * @var \Spryker\Zed\Store\Persistence\StoreQueryContainerInterface
     */
    protected $storeQueryContainer;

    /**
     * TableRateManager constructor.
     *
     * @param \FondOfSpryker\Zed\ShipmentTableRate\Persistence\ShipmentTableRateQueryContainerInterface $shipmentQueryContainer
     * @param \Spryker\Zed\Country\Persistence\CountryQueryContainerInterface $countryQueryContainer
     * @param \Spryker\Zed\Store\Persistence\StoreQueryContainerInterface $storeQueryContainer
     */
    public function __construct(
        ShipmentTableRateQueryContainerInterface $shipmentTableRateQueryContainer,
        CountryQueryContainerInterface $countryQueryContainer,
        StoreQueryContainerInterface $storeQueryContainer
    ) {
        $this->shipmentTableRateQueryContainer = $shipmentTableRateQueryContainer;
        $this->countryQueryContainer = $countryQueryContainer;
        $this->storeQueryContainer = $storeQueryContainer;
    }

    /**
     * @param float $price
     * @param string $countryIso2Code
     * @param string $storeName
     *
     * @return int
     */
    public function getPriceByCountryIso2CodeAndStoreName(float $price, string $countryIso2Code, string $storeName): float
    {
        $countryId = $this->getCountryIdByIso2Code($countryIso2Code);
        $storeId   = $this->getStoreIdByName($storeName);

        try {
            $shippingPrice = $this->shipmentTableRateQueryContainer
                ->queryTableRate()
                ->filterByFkCountry($countryId)
                ->filterByFkStore($storeId)
                ->findOne();

            if ($shippingPrice->getFreeThreshold() && $price >= $shippingPrice->getFreeThreshold()) {
                return 0;
            }

            return $shippingPrice->getPrice();

        } catch (AmbiguousComparisonException $e) {
            $this->getLogger()->error('Cannot get shipping price', ['trace' => $e]);
        }

        return null;
    }

    /**
     * @param string $countryIso2Code
     *
     * @return int
     */
    protected function getCountryIdByIso2Code($countryIso2Code): int
    {
        return $this->countryQueryContainer
            ->queryCountryByIso2Code($countryIso2Code)
            ->findOne()
            ->getIdCountry();
    }

    /**
     * @param string $name
     *
     * @return int
     */
    protected function getStoreIdByName($name): int
    {
        return $this->storeQueryContainer
            ->queryStoreByName($name)
            ->findOne()
            ->getIdStore();
    }
}