<?php

declare(strict_types=1);

namespace Anaf\ValueObjects;

use ArrayIterator;
use Countable;
use IteratorAggregate;
use Traversable;

/**
 * @template TKey of array-key
 * @template TValue of TaxIdentificationNumber
 *
 * @implements IteratorAggregate<TKey, TaxIdentificationNumber>
 */
final class TaxIdentificationNumberChunk implements Countable, IteratorAggregate
{
    /**
     * The items contained in the collection.
     *
     * @var array<TKey, TaxIdentificationNumber>
     */
    private array $taxIdentificationNumbers = [];

    /**
     * Create a new collection.
     *
     * @param array<string> $taxIdentificationNumbers
     * @return void
     */
    public function __construct(array $taxIdentificationNumbers)
    {
        foreach ($taxIdentificationNumbers as $taxIdentificationNumber) {
            $this->taxIdentificationNumbers[] = TaxIdentificationNumber::from($taxIdentificationNumber);
        }
    }

    /**
     * Get an iterator for the items.
     *
     * @return ArrayIterator<TKey, TaxIdentificationNumber>
     */
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->taxIdentificationNumbers);
    }

    public function count(): int
    {
        return count($this->taxIdentificationNumbers);
    }
}
