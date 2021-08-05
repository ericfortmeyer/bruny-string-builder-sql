<?php

declare(strict_types=1);

namespace Bruny\SQLString;

use Bruny\SQLString\List\ColumnList;
use Bruny\SQLString\List\ValuesList;
use Bruny\SQLString\List\ListBuildingTrait;

/**
 * Helps with building an insert statement string.
 */
class InsertStatementBuilder
{
    use ListBuildingTrait;

    private const INSERT = "INSERT";
    private const INTO = "INTO";
    private const VALUES = "VALUES";
    private const WHITESPACE = " ";

    private string $command = "";

    protected ColumnList $columnsList;

    protected ValuesList $valuesList;

    public function __construct(string $tableName, array $valuesList)
    {
        $this->command = join(self::WHITESPACE, [self::INSERT, self::INTO, $tableName]);
        $this->values($valuesList);
    }

    public function __toString()
    {
        return join(
            self::WHITESPACE,
            array_filter([$this->command, $this->columnsList, self::VALUES, $this->valuesList])
        );
    }
}
