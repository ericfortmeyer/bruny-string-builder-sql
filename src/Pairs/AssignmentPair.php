<?php

declare(strict_types=1);

namespace Bruny\SQLString\Pairs;

use Stringable;

/**
 * Represents a value and the column it's assigned to.
 */
final class AssignmentPair implements Stringable
{
    private const ASSIGN_TO = "=";

    public function __construct(private string $column, private string|int|bool|float $value)
    {
    }

    public function __toString()
    {
        return join(self::ASSIGN_TO, [$this->column, $this->value]);
    }
}
