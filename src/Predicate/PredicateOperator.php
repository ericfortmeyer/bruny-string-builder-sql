<?php

declare(strict_types=1);

namespace Bruny\SQLString\Predicate;

use Stringable;

abstract class PredicateOperator implements Stringable
{
    protected const EQ = "=";
    protected const GT = ">";
    protected const GTE = ">=";
    protected const LT = "<";
    protected const LTE = "<=";
    protected const NEQ = "<>";
}
