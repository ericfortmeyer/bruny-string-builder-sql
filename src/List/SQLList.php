<?php

declare(strict_types=1);

namespace Bruny\SQLString\List;

use Stringable;
use Bruny\SQLString\Pairs\ColumnAliasPair;

/**
 * Represents an abstract list in a SQL string.
 */
abstract class SQLList implements Stringable
{
    protected const COMMA = ",";
    private const OPEN_PAREN = "(";
    private const CLOSED_PARN = ")";
    private const EMPTY_STRING = "";

    /**
     * @param string[]|ColumnAliasPair[] $items The items in the list.
     */
    public function __construct(protected $items)
    {
    }


    public function __toString()
    {
        return count($this->items) === 0
            ? self::EMPTY_STRING
            : join(join(static::COMMA, $this->items), [static::OPEN_PAREN, static::CLOSED_PARN]);
    }
}
