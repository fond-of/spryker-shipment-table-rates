<?php

namespace FondOfSpryker\Zed\ShipmentTableRate\Persistence;

use Orm\Zed\ShipmentTableRate\Persistence\FosShipmentTableRateQuery;

interface ShipmentTableRateQueryContainerInterface
{
    /**
     * @return \Orm\Zed\ShipmentTableRate\Persistence\FosShipmentTableRateQuery
     */
    public function queryTableRate(): FosShipmentTableRateQuery;
}
