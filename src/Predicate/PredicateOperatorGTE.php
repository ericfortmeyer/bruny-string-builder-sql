<?php

declare(strict_types=1);

namespace Bruny\SQLString\Predicate;

/**
 * Represents the not equals `>=` operator in a predicate
 *
 *
 * Example:
 * ```SQL
 * SELECT * FROM t WHERE t.col >= '1234'
 * ```
 */
final class PredicateOperatorGTE extends PredicateOperator
{
    public function __toString()
    {
        return static::GTE;
    }
}
