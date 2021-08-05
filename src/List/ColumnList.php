<?php

declare(strict_types=1);

namespace Bruny\SQLString\List;

use Bruny\SQLString\Pairs\ColumnAliasPair;

/**
 * Represents a list of column names.
 */
final class ColumnList extends SQLList
{
    public function __construct(array $columns)
    {
        $columnsWithAliases = $this->getColumnsWithAliases($columns);
        parent::__construct(
            array_merge(
                $this->getColumnAliasPairs($columnsWithAliases),
                $this->getColumnsWithoutAliases($columns, $columnsWithAliases)
            )
        );
    }

    private function getColumnsWithAliases(array $columns): array
    {
        return array_filter($columns, "is_string", ARRAY_FILTER_USE_KEY);
    }

    private function getColumnAliasPairs(array $columnsWithAliases): array
    {
        return array_map(
            fn ($key, $value) => new ColumnAliasPair($key, $value),
            array_keys($columnsWithAliases),
            $columnsWithAliases
        );
    }

    private function getColumnsWithoutAliases(array $columns, array $columnsWithAliases): array
    {
        return array_diff($columns, $columnsWithAliases);
    }
}
