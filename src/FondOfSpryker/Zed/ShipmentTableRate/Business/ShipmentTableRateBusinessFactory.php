<?php

namespace FondOfSpryker\Zed\ShipmentTableRate\Business;

use FondOfSpryker\Zed\ShipmentTableRate\Business\Model\PriceCalculator;
use FondOfSpryker\Zed\ShipmentTableRate\Business\Model\PriceCalculatorInterface;
use FondOfSpryker\Zed\ShipmentTableRate\Business\Model\ShipmentTableRateReader;
use FondOfSpryker\Zed\ShipmentTableRate\Business\Model\ShipmentTableRateReaderInterface;
use FondOfSpryker\Zed\ShipmentTableRate\Business\Model\ZipCodePatternsGenerator;
use FondOfSpryker\Zed\ShipmentTableRate\Business\Model\ZipCodePatternsGeneratorInterface;
use FondOfSpryker\Zed\ShipmentTableRate\Dependency\Facade\ShipmentTableRateToCountryFacadeInterface;
use FondOfSpryker\Zed\ShipmentTableRate\Dependency\Facade\ShipmentTableRateToStoreFacadeInterface;
use FondOfSpryker\Zed\ShipmentTableRate\ShipmentTableRateDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfSpryker\Zed\ShipmentTableRate\Persistence\ShipmentTableRateRepositoryInterface getRepository()
 * @method \FondOfSpryker\Zed\ShipmentTableRate\ShipmentTableRateConfig getConfig()
 */
class ShipmentTableRateBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfSpryker\Zed\ShipmentTableRate\Business\Model\PriceCalculatorInterface
     */
    public function createPriceCalculator(): PriceCalculatorInterface
    {
        return new PriceCalculator(
            $this->createShipmentTableRateReader(),
            $this->getConfig()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\ShipmentTableRate\Business\Model\ShipmentTableRateReaderInterface
     */
    protected function createShipmentTableRateReader(): ShipmentTableRateReaderInterface
    {
        return new ShipmentTableRateReader(
            $this->createZipCodePatternsGenerator(),
            $this->getRepository(),
            $this->getCountryFacade(),
            $this->getStoreFacade()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\ShipmentTableRate\Business\Model\ZipCodePatternsGeneratorInterface
     */
    protected function createZipCodePatternsGenerator(): ZipCodePatternsGeneratorInterface
    {
        return new ZipCodePatternsGenerator();
    }

    /**
     * @return \FondOfSpryker\Zed\ShipmentTableRate\Dependency\Facade\ShipmentTableRateToCountryFacadeInterface
     */
    protected function getCountryFacade(): ShipmentTableRateToCountryFacadeInterface
    {
        return $this->getProvidedDependency(ShipmentTableRateDependencyProvider::FACADE_COUNTRY);
    }

    /**
     * @return \FondOfSpryker\Zed\ShipmentTableRate\Dependency\Facade\ShipmentTableRateToStoreFacadeInterface
     */
    protected function getStoreFacade(): ShipmentTableRateToStoreFacadeInterface
    {
        return $this->getProvidedDependency(ShipmentTableRateDependencyProvider::FACADE_STORE);
    }
}
