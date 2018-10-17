<?php

namespace FondOfSpryker\Zed\Shipment\Persistence;

use Orm\Zed\Shipment\Persistence\FondOfSprykerShipmentTableRateQuery;
use Spryker\Zed\Shipment\Persistence\ShipmentQueryContainer as SprykerShipmentQueryContainer;

/**
 * @method \Pyz\Zed\Shipment\Persistence\ShipmentPersistenceFactory getFactory()
 */
class ShipmentQueryContainer extends SprykerShipmentQueryContainer implements ShipmentQueryContainerInterface
{
    /**
     * @return \Orm\Zed\Shipment\Persistence\PyzShipmentTableRateQuery
     */
    public function queryTableRate(): FondOfSprykerShipmentTableRateQuery
    {
        return $this->getFactory()->createTableRateQuery();
    }
}
