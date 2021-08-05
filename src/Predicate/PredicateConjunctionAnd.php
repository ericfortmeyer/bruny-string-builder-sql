<?php

declare(strict_types=1);

namespace Bruny\SQLString\Predicate;

final class PredicateConjunctionAnd extends PredicateConjunction
{
    public function __toString()
    {
        return join(static::AND, [$this->firstPredicate, $this->secondPredicate]);
    }
}
