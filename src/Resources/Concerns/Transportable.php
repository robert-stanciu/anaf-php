<?php

declare(strict_types=1);

namespace Anaf\Resources\Concerns;

use Anaf\Contracts\Transporter;
use Anaf\ValueObjects\TaxIdentificationNumber;
use Anaf\ValueObjects\TaxIdentificationNumberChunk;

trait Transportable
{
    /**
     * Creates a Client instance with the given Tax Identification Number.
     */
    public function __construct(
        private readonly Transporter $transporter,
        private readonly TaxIdentificationNumber|TaxIdentificationNumberChunk $taxIdentificationNumber
    ) {
        // ..
    }

    public function getParameters(): array
    {
        if ($this->taxIdentificationNumber instanceof TaxIdentificationNumber) {
            return [
                [
                    'cui' => $this->taxIdentificationNumber->toString(),
                    'data' => date('Y-m-d'),
                ],
            ];
        }
        $parameters = [];

        foreach ($this->taxIdentificationNumber as $taxIdentificationNumber) {
            $parameters[] = [
                'cui' => $taxIdentificationNumber->toString(),
                'data' => date('Y-m-d'),
            ];
        }

        return $parameters;
    }
}
