<?php

namespace FondOfSpryker\Zed\ShipmentTableRate;

use FondOfSpryker\Zed\ShipmentTableRate\Communication\Plugin\PriceCalculation\TableRatePriceCalculationPlugin;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Money\Communication\Plugin\Form\MoneyCollectionFormTypePlugin;
use Spryker\Zed\Shipment\ShipmentDependencyProvider as SprykerShipmentDependencyProvider;

class ShipmentTableRateDependencyProvider extends SprykerShipmentDependencyProvider
{
    const QUERY_CONTAINER_COUNTRY = 'QUERY_CONTAINER_COUNTRY';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container)
    {
        $container = parent::provideBusinessLayerDependencies($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return array
     */
    protected function getPricePlugins(Container $container)
    {
        return [
            new TableRatePriceCalculationPlugin(),
        ];
    }

}
