<?php

namespace FondOfSpryker\Zed\ShipmentTableRate\Persistence;

use Orm\Zed\Shipment\Persistence\FondOfSprykerShipmentTableRateQuery;
use Spryker\Zed\Shipment\Persistence\ShipmentPersistenceFactory as SprykerShipmentPersistenceFactory;

/**
 * @method \Spryker\Zed\Shipment\ShipmentConfig getConfig()
 * @method \Pyz\Zed\Shipment\Persistence\ShipmentQueryContainerInterface getQueryContainer()
 */
class ShipmentPersistenceFactory extends SprykerShipmentPersistenceFactory
{
    /**
     * @return \Orm\Zed\Shipment\Persistence\PyzShipmentTableRateQuery
     */
    public function createTableRateQuery(): FondOfSprykerShipmentTableRateQuery
    {
        return FondOfSprykerShipmentTableRateQuery::create();
    }
}
