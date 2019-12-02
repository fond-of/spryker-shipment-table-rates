<?php

namespace FondOfSpryker\Zed\ShipmentTableRate\Persistence;

use Orm\Zed\ShipmentTableRate\Persistence\FosShipmentTableRateQuery;
use Spryker\Zed\Kernel\Persistence\AbstractQueryContainer;

/**
 * @method \FondOfSpryker\Zed\ShipmentTableRate\Persistence\ShipmentTableRatePersistenceFactory getFactory()
 */
class ShipmentTableRateQueryContainer extends AbstractQueryContainer implements ShipmentTableRateQueryContainerInterface
{
    /**
     * @return \Orm\Zed\ShipmentTableRate\Persistence\FosShipmentTableRateQuery
     */
    public function queryTableRate(): FosShipmentTableRateQuery
    {
        return $this->getFactory()->createTableRateQuery();
    }
}
