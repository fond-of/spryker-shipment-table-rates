<?php

namespace FondOfSpryker\Zed\ShipmentTableRate\Persistence;

use Orm\Zed\Shipment\Persistence\FondOfSprykerShipmentTableRateQuery;
use Spryker\Zed\Shipment\Persistence\ShipmentQueryContainerInterface as SprykerShipmentQueryContainerInterface;

interface ShipmentQueryContainerInterface extends SprykerShipmentQueryContainerInterface
{
    /**
     * @return \Orm\Zed\Shipment\Persistence\FondOfSprykerShipmentTableRateQuery
     */
    public function queryTableRate(): FondOfSprykerShipmentTableRateQuery;
}
