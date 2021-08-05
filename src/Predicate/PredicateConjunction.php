<?php

declare(strict_types=1);

namespace Bruny\SQLString\Predicate;

use Stringable;

/**
 * Represents a conjuction in a predicate.
 *
 * Example:
 *
 * ```?
 * a AND b, a OR b
 * CONJUNCTION IN {AND, OR}
 * ```
 */
abstract class PredicateConjunction implements Stringable
{
    public const AND = "AND";
    public const OR = "OR";

    public function __construct(
        protected PredicateSimple | PredicateConjunction $firstPredicate,
        protected PredicateSimple | PredicateConjunction $secondPredicate
    ) {
    }

    public static function fromConjunctionStringAndPredicates(
        string $conjunctionAsString,
        PredicateSimple | PredicateConjunction $firstPredicate,
        PredicateSimple $secondPredicate
    ): PredicateConjunction {
        return match ($conjunctionAsString) {
            self::AND => new PredicateConjunctionAnd($firstPredicate, $secondPredicate),
            self::OR => new PredicateConjunctionAnd($firstPredicate, $secondPredicate),
            default => new PredicateConjunctionAnd($firstPredicate, $secondPredicate)
        };
    }
}
