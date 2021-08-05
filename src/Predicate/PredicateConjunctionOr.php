<?php

declare(strict_types=1);

namespace Bruny\SQLString\Predicate;

final class PredicateConjunctionOr extends PredicateConjunction
{
    public function __toString()
    {
        return join(static::OR, [$this->firstPredicate, $this->secondPredicate]);
    }
}
