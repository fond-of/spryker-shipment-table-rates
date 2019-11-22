<?php

namespace FondOfSpryker\Zed\ShipmentTableRate\Business\Model;

use FondOfSpryker\Zed\ShipmentTableRate\Persistence\ShipmentQueryContainerInterface;
use FondOfSpryker\Zed\ShipmentTableRate\Persistence\ShipmentTableRateQueryContainerInterface;
use Generated\Shared\Transfer\CountryTransfer;
use Generated\Shared\Transfer\StoreTransfer;
use Orm\Zed\ShipmentTableRate\Persistence\FosShipmentTableRateQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Spryker\Shared\Log\LoggerTrait;
use Spryker\Zed\Country\Persistence\CountryQueryContainerInterface;
use Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException;
use Spryker\Zed\Store\Persistence\StoreQueryContainerInterface;

class TableRateManager
{
    use LoggerTrait;

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
     * @param int $price
     * @param string $countryIso2Code
     * @param string $zipCode
     * @param string $storeName
     *
     * @return int
     *
     * @throws \Exception
     */
    public function getShipmentPrice(int $price, string $countryIso2Code, string $zipCode, string $storeName): int
    {
        $countryId = $this->getCountryIdByIso2Code($countryIso2Code);
        $storeId   = $this->getStoreIdByName($storeName);

        try {

            /** @var Orm\Zed\ShipmentTableRate\Persistence\FosShipmentTableRate $shippingPrice */
            $shipmentRate = $this->shipmentTableRateQueryContainer
                ->queryTableRate()
                ->filterByFkCountry($countryId)
                ->filterByFkStore($storeId)
                ->filterByZipCode_In($this->getZipCodes($zipCode))
                ->filterByPrice($price, Criteria::LESS_EQUAL)
                ->orderByZipCode(Criteria::DESC)
                ->orderByPrice(Criteria::DESC)
                ->findOne();

            if ($shipmentRate == null) {
                throw new \Exception('Cannot get shipping price');
            }

            return $shipmentRate->getPrice();

        } catch (AmbiguousComparisonException $e) {
            $this->getLogger()->error('Cannot get shipping price', ['trace' => $e]);
        }
    }

    /**
     * Retrieve zip codes
     *
     * @param string $zipCode
     *
     * @return string []
     */
    protected function getZipCodes(string $zipCode): array
    {
        $zipCodes = array();
        array_push($zipCodes, $zipCode);

        while(strlen($zipCode)){
            $zipCode = substr_replace($zipCode, '*', strlen($zipCode) - 1);
            array_push($zipCodes, $zipCode);
            $zipCode = substr($zipCode, 0, -1);
        };

        return $zipCodes;
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