<?php

namespace Bruny\SQLString\List;

/**
 * A set of operations used to build a list in a SQL string.
 */
trait ListBuildingTrait
{
    protected ColumnList $columnsList;

    protected ValuesList $valuesList;

    public function columns(array $columns): self
    {
        $this->columnsList = new ColumnList($columns);
        return $this;
    }

    /**
     * @param string[]|array<string,string> $values
     */
    public function values(array $values): void
    {
        if (self::hasColumns($values)) {
            $this->columnsList = new ColumnList(array_keys($values));
        }
        $this->valuesList = new ValuesList($values);
    }

    /**
     * @param string[]|array<string,string> $values
     */
    private static function hasColumns(array $values)
    {
        return array_filter($values, "is_string", ARRAY_FILTER_USE_KEY);
    }
}
