<?php

namespace FondOfSpryker\Zed\ShipmentTableRate\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\ShipmentTableRateTransfer;
use Orm\Zed\ShipmentTableRate\Persistence\FosShipmentTableRate;

interface ShipmentTableRateMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\ShipmentTableRateTransfer $shipmentTableRateTransfer
     * @param \Orm\Zed\ShipmentTableRate\Persistence\FosShipmentTableRate $fosShipmentTableRate
     *
     * @return \Orm\Zed\ShipmentTableRate\Persistence\FosShipmentTableRate
     */
    public function mapTransferToEntity(
        ShipmentTableRateTransfer $shipmentTableRateTransfer,
        FosShipmentTableRate $fosShipmentTableRate
    ): FosShipmentTableRate;

    /**
     * @param \Orm\Zed\ShipmentTableRate\Persistence\FosShipmentTableRate $fosShipmentTableRate
     * @param \Generated\Shared\Transfer\ShipmentTableRateTransfer $shipmentTableRateTransfer
     *
     * @return \Generated\Shared\Transfer\ShipmentTableRateTransfer
     */
    public function mapEntityToTransfer(
        FosShipmentTableRate $fosShipmentTableRate,
        ShipmentTableRateTransfer $shipmentTableRateTransfer
    ): ShipmentTableRateTransfer;
}
