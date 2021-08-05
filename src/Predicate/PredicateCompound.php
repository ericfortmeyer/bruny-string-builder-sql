<?php

declare(strict_types=1);

namespace Bruny\SQLString\Predicate;

final class PredicateCompound
{
    public function __construct(private PredicateConjunction $tail)
    {
    }

    public function append(string $conjunctionAsString, PredicateSimple $predicate)
    {
        $this->tail =
            PredicateConjunction::fromConjunctionStringAndPredicates(
                $conjunctionAsString,
                $this->tail,
                $predicate
            );
    }
}
