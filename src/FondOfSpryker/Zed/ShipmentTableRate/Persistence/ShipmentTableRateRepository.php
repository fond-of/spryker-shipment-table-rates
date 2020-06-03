<?php

namespace FondOfSpryker\Zed\ShipmentTableRate\Persistence;

use Generated\Shared\Transfer\ShipmentTableRateCriteriaFilterTransfer;
use Generated\Shared\Transfer\ShipmentTableRateTransfer;
use Orm\Zed\ShipmentTableRate\Persistence\FosShipmentTableRateQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfSpryker\Zed\ShipmentTableRate\Persistence\ShipmentTableRatePersistenceFactory getFactory()
 */
class ShipmentTableRateRepository extends AbstractRepository implements ShipmentTableRateRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\ShipmentTableRateCriteriaFilterTransfer $shipmentTableRateCriteriaFilterTransfer
     *
     * @return \Generated\Shared\Transfer\ShipmentTableRateTransfer|null
     */
    public function getShipmentTableRate(
        ShipmentTableRateCriteriaFilterTransfer $shipmentTableRateCriteriaFilterTransfer
    ): ?ShipmentTableRateTransfer {
        $shipmentTableRateQuery = $this->getFactory()->createShipmentTableRateQuery();

        $shipmentTableRateQuery = $this->applyShipmentTableRateCriteriaFilters(
            $shipmentTableRateQuery,
            $shipmentTableRateCriteriaFilterTransfer
        );

        $shipmentTableRate = $shipmentTableRateQuery->orderByZipCode(Criteria::DESC)
            ->orderByPrice(Criteria::DESC)
            ->findOne();

        if ($shipmentTableRate === null) {
            return null;
        }

        return $this->getFactory()->createShipmentTableRateMapper()->mapEntityToTransfer(
            $shipmentTableRate,
            new ShipmentTableRateTransfer()
        );
    }

    /**
     * @param \Orm\Zed\ShipmentTableRate\Persistence\FosShipmentTableRateQuery $shipmentTableRateQuery
     * @param \Generated\Shared\Transfer\ShipmentTableRateCriteriaFilterTransfer $shipmentTableRateCriteriaFilterTransfer
     *
     * @return \Orm\Zed\ShipmentTableRate\Persistence\FosShipmentTableRateQuery
     */
    protected function applyShipmentTableRateCriteriaFilters(
        FosShipmentTableRateQuery $shipmentTableRateQuery,
        ShipmentTableRateCriteriaFilterTransfer $shipmentTableRateCriteriaFilterTransfer
    ): FosShipmentTableRateQuery {
        if ($shipmentTableRateCriteriaFilterTransfer->getZipCodes()) {
            $shipmentTableRateQuery->filterByZipCode_In($shipmentTableRateCriteriaFilterTransfer->getZipCodes());
        }

        if ($shipmentTableRateCriteriaFilterTransfer->getFkCountry()) {
            $shipmentTableRateQuery->filterByFkCountry($shipmentTableRateCriteriaFilterTransfer->getFkCountry());
        }

        if ($shipmentTableRateCriteriaFilterTransfer->getFkStore()) {
            $shipmentTableRateQuery->filterByFkStore($shipmentTableRateCriteriaFilterTransfer->getFkStore());
        }

        if ($shipmentTableRateCriteriaFilterTransfer->getPrice()) {
            $shipmentTableRateQuery->filterByPrice($shipmentTableRateCriteriaFilterTransfer->getPrice(), Criteria::LESS_EQUAL);
        }

        return $shipmentTableRateQuery;
    }
}
