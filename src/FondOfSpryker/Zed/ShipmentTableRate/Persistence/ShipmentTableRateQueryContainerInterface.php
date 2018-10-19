<?php

namespace FondOfSpryker\Zed\ShipmentTableRate\Persistence;

use Orm\Zed\ShipmentTableRate\Persistence\FondOfSprykerShipmentTableRateQuery;
use Orm\Zed\ShipmentTableRate\Persistence\FosShipmentTableRateQuery;

interface ShipmentTableRateQueryContainerInterface
{
    /**
     * @return \Orm\Zed\ShipmentTableRate\Persistence\FondOfSprykerShipmentTableRateQuery
     */
    public function queryTableRate(): FosShipmentTableRateQuery;
}