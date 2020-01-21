<?php

namespace FondOfSpryker\Zed\ShipmentTableRate\Persistence;

use Orm\Zed\ShipmentTableRate\Persistence\FosShipmentTableRateQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfSpryker\Zed\ShipmentTableRate\Persistence\ShipmentTableRateQueryContainerInterface getQueryContainer()
 */
class ShipmentTableRatePersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\ShipmentTableRate\Persistence\FosShipmentTableRateQuery
     */
    public function createTableRateQuery(): FosShipmentTableRateQuery
    {
        return FosShipmentTableRateQuery::create();
    }
}
