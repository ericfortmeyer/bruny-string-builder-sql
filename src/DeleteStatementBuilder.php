<?php

declare(strict_types=1);

namespace Bruny\SQLString;

use Bruny\SQLString\Predicate\PredicateBuilder;
use Bruny\SQLString\Predicate\PredicateBuildingTrait;

/**
 * Helps with building a delete statement string.
 *
 */
class DeleteStatementBuilder
{
    use PredicateBuildingTrait;

    private const DELETE = "DELETE";
    private const FROM = "FROM";
    private const WHITESPACE = " ";

    private string $command = "";

    public function __construct(protected PredicateBuilder $predicateBuilder, string $tableName)
    {
        $this->command = join(self::WHITESPACE, [self::DELETE, self::FROM, $tableName]);
    }

    public function __toString()
    {
        return "{$this->command}{$this->predicateBuilder}";
    }
}
