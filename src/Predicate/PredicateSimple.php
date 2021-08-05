<?php

declare(strict_types=1);

namespace Bruny\SQLString\Predicate;

use Stringable;

/**
 * Represents a simple predicate.
 *
 * Example:
 *
 * ```?
 * A = B, A <> B, A > B,...
 * ```
 */
final class PredicateSimple implements Stringable
{
    public function __construct(
        private PredicateOperator $operator,
        private string|int|float|bool $firstOperand,
        private string|int|float|bool $secondOperand
    ) {
    }

    public function __toString()
    {
        return join((string) $this->operator, [$this->firstOperand, $this->secondOperand]);
    }
}
