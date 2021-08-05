<?php

declare(strict_types=1);

namespace Bruny\SQLString;

use Bruny\SQLString\List\AssignmentList;
use Bruny\SQLString\Pairs\AssignmentPair;
use Bruny\SQLString\Predicate\PredicateBuilder;
use Bruny\SQLString\Predicate\PredicateBuildingTrait;

/**
 * Helps with building an update statement string.
 */
class UpdateStatementBuilder
{
    use PredicateBuildingTrait;

    private const UPDATE = "UPDATE";
    private const SET = "SET";
    private const WHITESPACE = " ";

    private string $command = "";

    /**
     * @var AssignmentList $assignments
     */
    protected array $assignments;

    public function __construct(
        protected PredicateBuilder $predicateBuilder,
        string $tableName,
        string $column,
        string|int|float|bool $value
    ) {
        $this->addAssignment($column, $value);
        $this->command = join(self::WHITESPACE, [self::UPDATE, $tableName, self::SET]);
    }

    public function addAssignment(string $column, string|int|float|bool $value): void
    {
        $this->assignments = $this->assignments ?? new AssignmentList();
        $this->assignments->add(new AssignmentPair($column, $value));
    }

    public function __toString()
    {
        return "{$this->command} {$this->assignments}{$this->predicateBuilder}";
    }
}
