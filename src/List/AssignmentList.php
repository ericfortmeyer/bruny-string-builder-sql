<?php

declare(strict_types=1);

namespace Bruny\SQLString\List;

use Bruny\SQLString\Pairs\AssignmentPair;

/**
 * Represents a list of assignments.
 */
final class AssignmentList extends SQLList
{
    /**
     * @var AssignmentPair[] $assignments
     */
    private array $assignments = [];

    public function __construct()
    {
    }

    public function add(AssignmentPair $pair)
    {
        $this->assignments[] = $pair;
    }

    public function __toString()
    {
        return join(static::COMMA, $this->assignments);
    }
}
