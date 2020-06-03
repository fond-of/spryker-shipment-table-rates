<?php

namespace FondOfSpryker\Zed\ShipmentTableRate\Business\Model;

class ZipCodePatternsGenerator implements ZipCodePatternsGeneratorInterface
{
    /**
     * @param string $zipCode
     *
     * @return string[]
     */
    public function generateFromZipCode(string $zipCode): array
    {
        $zipCodePatterns = [$zipCode];
        $zipCodePattern = $zipCode;

        while ($zipCodePattern !== '') {
            $zipCodePattern = substr_replace($zipCodePattern, '*', strlen($zipCodePattern) - 1);
            $zipCodePatterns[] = $zipCodePattern;
            $zipCodePattern = substr($zipCodePattern, 0, -1);
        }

        return $zipCodePatterns;
    }
}
