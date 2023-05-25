<?php

declare(strict_types=1);

namespace Anaf\ValueObjects;

use Anaf\Contracts\Stringable;

/**
 * @internal
 */
final class TaxIdentificationNumber implements Stringable
{
    /**
     * Creates a new tax identification number value object.
     */
    private function __construct(private readonly string $taxIdentificationNumber)
    {
        // ..
    }

    public static function from(string $taxIdentificationNumber): self
    {
        $cleanTaxIdentificationNumber = str_replace('RO', '', strtoupper(trim($taxIdentificationNumber)));

        return new self($cleanTaxIdentificationNumber);
    }

    /**
     * {@inheritdoc}
     */
    public function toString(): string
    {
        return $this->taxIdentificationNumber;
    }
}
