<?php

namespace FondOfSpryker\Zed\ShipmentTableRate;

use FondOfSpryker\Shared\ShipmentTableRate\ShipmentTableRateConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class ShipmentTableRateConfig extends AbstractBundleConfig
{
    /**
     * @return int
     */
    public function getFallbackPrice(): int
    {
        return $this->get(
            ShipmentTableRateConstants::FALLBACK_PRICE,
            ShipmentTableRateConstants::FALLBACK_PRICE_DEFAULT_VALUE
        );
    }
}
