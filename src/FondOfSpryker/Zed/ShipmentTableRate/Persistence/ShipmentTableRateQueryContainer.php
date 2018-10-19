<?php

namespace FondOfSpryker\Zed\ShipmentTableRate\Persistence;

use FondOfSpryker\Zed\ShipmentTableRate\Persistence\ShipmentTableRateQueryContainerInterface;
use Orm\Zed\ShipmentTableRate\Persistence\FondOfSprykerShipmentTableRateQuery;
use Orm\Zed\ShipmentTableRate\Persistence\FosShipmentTableRateQuery;
use Spryker\Zed\Kernel\Persistence\AbstractQueryContainer;

/**
 * @method \FondOfSpryker\Zed\ShipmentTableRate\Persistence\ShipmenTableRatePersistenceFactory getFactory()
 */
class ShipmentTableRateQueryContainer extends AbstractQueryContainer implements ShipmentTableRateQueryContainerInterface
{
    /**
     * @return \Orm\Zed\ShipmentTableRate\Persistence\FondOfSprykerShipmentTableRateQuery
     */
    public function queryTableRate(): FosShipmentTableRateQuery
    {
        return $this->getFactory()->createTableRateQuery();
    }
}