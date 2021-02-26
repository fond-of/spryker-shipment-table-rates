<?php

namespace FondOfSpryker\Zed\ShipmentTableRate\Persistence;

use FondOfSpryker\Zed\ShipmentTableRate\Persistence\Propel\Mapper\ShipmentTableRateMapper;
use FondOfSpryker\Zed\ShipmentTableRate\Persistence\Propel\Mapper\ShipmentTableRateMapperInterface;
use Orm\Zed\ShipmentTableRate\Persistence\FosShipmentTableRateQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfSpryker\Zed\ShipmentTableRate\Persistence\ShipmentTableRateRepositoryInterface getRepository()
 * @method \FondOfSpryker\Zed\ShipmentTableRate\ShipmentTableRateConfig getConfig()()
 */
class ShipmentTableRatePersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\ShipmentTableRate\Persistence\FosShipmentTableRateQuery
     */
    public function createShipmentTableRateQuery(): FosShipmentTableRateQuery
    {
        return FosShipmentTableRateQuery::create();
    }

    /**
     * @return \FondOfSpryker\Zed\ShipmentTableRate\Persistence\Propel\Mapper\ShipmentTableRateMapperInterface
     */
    public function createShipmentTableRateMapper(): ShipmentTableRateMapperInterface
    {
        return new ShipmentTableRateMapper();
    }
}
