<?php

namespace FondOfSpryker\Zed\ShipmentTableRate\Business\Model;

interface ZipCodePatternsGeneratorInterface
{
    /**
     * @param string $zipCode
     *
     * @return string[]
     */
    public function generateFromZipCode(string $zipCode): array;
}
