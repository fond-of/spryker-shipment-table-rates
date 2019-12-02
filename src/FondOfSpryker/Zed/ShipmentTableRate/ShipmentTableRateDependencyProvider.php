<?php

namespace FondOfSpryker\Zed\ShipmentTableRate;

use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class ShipmentTableRateDependencyProvider extends AbstractBundleDependencyProvider
{
    public const QUERY_CONTAINER_COUNTRY = 'QUERY_CONTAINER_COUNTRY';
    public const QUERY_CONTAINER_STORE = 'QUERY_CONTAINER_STORE';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);
        $container = $this->getCountryQueryContainer($container);
        $container = $this->getStoreQueryContainer($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function getCountryQueryContainer(Container $container): Container
    {
        $container[static::QUERY_CONTAINER_COUNTRY] = function (Container $container) {
            return $container->getLocator()->country()->queryContainer();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function getStoreQueryContainer(Container $container): Container
    {
        $container[static::QUERY_CONTAINER_STORE] = function (Container $container) {
            return $container->getLocator()->store()->queryContainer();
        };

        return $container;
    }
}
