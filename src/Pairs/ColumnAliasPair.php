<?php

declare(strict_types=1);

namespace Bruny\SQLString\Pairs;

use Stringable;

/**
 * Represents a column name and it's alias.
 */
final class ColumnAliasPair implements Stringable
{
    private const AS = " AS ";

    /**
     * @param string $alias The name of the alias for the column.
     * @param string $columnName The column name for the alias.
     */
    public function __construct(private string $alias, private string $columnName)
    {
    }

    public function __toString()
    {
        return join(self::AS, [$this->columnName, $this->alias]);
    }
}
