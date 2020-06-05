<?php

namespace FondOfSpryker\Zed\ShipmentTableRate\Persistence;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ShipmentTableRateCriteriaFilterTransfer;

class ShipmentTableRateRepositoryTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\ShipmentTableRateCriteriaFilterTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    private $shipmentTableRateCriteriaFilter;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->shipmentTableRateCriteriaFilter = $this->getMockBuilder(ShipmentTableRateCriteriaFilterTransfer::class)
            ->onlyMethods(['getZipCodePatterns', 'getFkCountry', 'getFkStore', 'getPriceToPay'])
            ->getMock();
    }

    /**
     * @return void
     */
    public function testGetShipmentPrice(): void
    {
        $this->markTestIncomplete('Need to figure out database connection');
        $repository = new ShipmentTableRateRepository();
        $repository->getShipmentTableRate($this->shipmentTableRateCriteriaFilter);
    }
}
