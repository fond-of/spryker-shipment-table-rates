<?php

namespace FondOfSpryker\Zed\ShipmentTableRate\Business\Model;

use FondOfSpryker\Zed\ShipmentTableRate\Dependency\Facade\ShipmentTableRateToCountryFacadeInterface;
use FondOfSpryker\Zed\ShipmentTableRate\Dependency\Facade\ShipmentTableRateToStoreFacadeInterface;
use FondOfSpryker\Zed\ShipmentTableRate\Persistence\ShipmentTableRateRepositoryInterface;
use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\ShipmentTableRateCriteriaFilterTransfer;
use Generated\Shared\Transfer\ShipmentTableRateTransfer;
use Generated\Shared\Transfer\ShipmentTransfer;
use Generated\Shared\Transfer\StoreTransfer;
use Generated\Shared\Transfer\TotalsTransfer;

class ShipmentTableRateReader implements ShipmentTableRateReaderInterface
{
    /**
     * @var \FondOfSpryker\Zed\ShipmentTableRate\Business\Model\ZipCodePatternsGeneratorInterface
     */
    protected $zipCodePatternsGenerator;

    /**
     * @var \FondOfSpryker\Zed\ShipmentTableRate\Persistence\ShipmentTableRateRepositoryInterface
     */
    protected $repository;

    /**
     * @var \FondOfSpryker\Zed\ShipmentTableRate\Dependency\Facade\ShipmentTableRateToCountryFacadeInterface
     */
    protected $countryFacade;

    /**
     * @var \FondOfSpryker\Zed\ShipmentTableRate\Dependency\Facade\ShipmentTableRateToStoreFacadeInterface
     */
    protected $storeFacade;

    /**
     * @param \FondOfSpryker\Zed\ShipmentTableRate\Business\Model\ZipCodePatternsGeneratorInterface $zipCodePatternsGenerator
     * @param \FondOfSpryker\Zed\ShipmentTableRate\Persistence\ShipmentTableRateRepositoryInterface $repository
     * @param \FondOfSpryker\Zed\ShipmentTableRate\Dependency\Facade\ShipmentTableRateToCountryFacadeInterface $countryFacade
     * @param \FondOfSpryker\Zed\ShipmentTableRate\Dependency\Facade\ShipmentTableRateToStoreFacadeInterface $storeFacade
     */
    public function __construct(
        ZipCodePatternsGeneratorInterface $zipCodePatternsGenerator,
        ShipmentTableRateRepositoryInterface $repository,
        ShipmentTableRateToCountryFacadeInterface $countryFacade,
        ShipmentTableRateToStoreFacadeInterface $storeFacade
    ) {
        $this->zipCodePatternsGenerator = $zipCodePatternsGenerator;
        $this->countryFacade = $countryFacade;
        $this->storeFacade = $storeFacade;
        $this->repository = $repository;
    }

    /**
     * @param \Generated\Shared\Transfer\ShipmentTransfer $shipmentTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\ShipmentTableRateTransfer|null
     */
    public function getByShipmentAndQuote(
        ShipmentTransfer $shipmentTransfer,
        QuoteTransfer $quoteTransfer
    ): ?ShipmentTableRateTransfer {
        $shippingAddressTransfer = $shipmentTransfer->getShippingAddress();
        $totalsTransfer = $quoteTransfer->getTotals();
        $storeTransfer = $quoteTransfer->getStore();

        if ($shippingAddressTransfer === null || $totalsTransfer === null || $storeTransfer === null) {
            return null;
        }

        $shipmentTableRateCriteriaFilter = $this->createShipmentTableRateCriteriaFilter(
            $shippingAddressTransfer,
            $totalsTransfer,
            $storeTransfer
        );

        if ($shipmentTableRateCriteriaFilter === null) {
            return null;
        }

        return $this->repository->getShipmentTableRate($shipmentTableRateCriteriaFilter);
    }

    /**
     * @param \Generated\Shared\Transfer\AddressTransfer $shippingAddressTransfer
     * @param \Generated\Shared\Transfer\TotalsTransfer $totalsTransfer
     * @param \Generated\Shared\Transfer\StoreTransfer $storeTransfer
     *
     * @return \Generated\Shared\Transfer\ShipmentTableRateCriteriaFilterTransfer|null
     */
    protected function createShipmentTableRateCriteriaFilter(
        AddressTransfer $shippingAddressTransfer,
        TotalsTransfer $totalsTransfer,
        StoreTransfer $storeTransfer
    ): ?ShipmentTableRateCriteriaFilterTransfer {
        $iso2Code = $shippingAddressTransfer->getIso2Code();
        $storeName = $storeTransfer->getName();
        $zipCode = $shippingAddressTransfer->getZipCode();
        $priceToPay = $totalsTransfer->getPriceToPay();

        if ($iso2Code === null || $storeName === null || $zipCode === null || $priceToPay === null) {
            return null;
        }

        $countryTransfer = $this->countryFacade->getCountryByIso2Code($iso2Code);
        $storeTransfer = $this->storeFacade->getStoreByName($storeName);

        return (new ShipmentTableRateCriteriaFilterTransfer())
            ->setFkCountry($countryTransfer->getIdCountry())
            ->setFkStore($storeTransfer->getIdStore())
            ->setPriceToPay($priceToPay)
            ->setZipCodePatterns($this->zipCodePatternsGenerator->generateFromZipCode($zipCode));
    }
}
