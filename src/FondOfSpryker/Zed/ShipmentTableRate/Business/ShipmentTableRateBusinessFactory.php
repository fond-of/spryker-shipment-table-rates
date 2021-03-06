<?php

namespace FondOfSpryker\Zed\ShipmentTableRate\Business;

use FondOfSpryker\Zed\ShipmentTableRate\Business\Model\TableRateManager;
use FondOfSpryker\Zed\ShipmentTableRate\ShipmentTableRateDependencyProvider;
use Spryker\Zed\Country\Persistence\CountryQueryContainerInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use Spryker\Zed\Store\Persistence\StoreQueryContainerInterface;

/**
 * @method \FondOfSpryker\Zed\ShipmentTableRate\Persistence\ShipmentTableRateQueryContainerInterface getQueryContainer()
 */
class ShipmentTableRateBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfSpryker\Zed\ShipmentTableRate\Business\Model\TableRateManager
     */
    public function createTableRateManager(): TableRateManager
    {
        return new TableRateManager(
            $this->getQueryContainer(),
            $this->getCountryQueryContainer(),
            $this->getStoreQueryContainer()
        );
    }

    /**
     * @throws
     *
     * @return \Spryker\Zed\Country\Persistence\CountryQueryContainerInterface
     */
    protected function getCountryQueryContainer(): CountryQueryContainerInterface
    {
        return $this->getProvidedDependency(ShipmentTableRateDependencyProvider::QUERY_CONTAINER_COUNTRY);
    }

    /**
     * @throws
     *
     * @return \Spryker\Zed\Store\Persistence\StoreQueryContainerInterface
     */
    protected function getStoreQueryContainer(): StoreQueryContainerInterface
    {
        return $this->getProvidedDependency(ShipmentTableRateDependencyProvider::QUERY_CONTAINER_STORE);
    }
}
