<?php

declare(strict_types=1);

namespace Bruny\SQLString\Predicate;

use Stringable;
use PhpDs\Pair;

/**
 * Use this class to build predicates in a SQL string.
 */
final class PredicateBuilder implements Stringable
{
    private const WHERE = "WHERE";

    private const WHITESPACE = " ";

    /**
     * This is the key value pair for the first or only simple predicate.
     */
    private PredicateSimple $firstPredicate;

    /**
     * These are all of the simple predicates in a compound predicate.
     */
    private PredicateCompound $compoundPredicate;

    /**
     * Begins building the predicate using a key value pair.
     */
    public function whereEquals(Pair $pair): PredicateBuilder
    {
        $this->firstPredicate = $this->createPredicate(new PredicateOperatorEQ(), $pair);
        return $this;
    }

    /**
     * Begins building the predicate using a key value pair.
     */
    public function whereNotEquals(Pair $pair): PredicateBuilder
    {
        $this->firstPredicate = $this->createPredicate(new PredicateOperatorNEQ(), $pair);
        return $this;
    }

    /**
     * Begins building the predicate using a key value pair.
     *
     * @param \PhpDs\Pair $pair
     */
    public function whereGreaterThan(Pair $pair): PredicateBuilder
    {
        $this->firstPredicate = $this->createPredicate(new PredicateOperatorGT(), $pair);
        return $this;
    }

    /**
     * Begins building the predicate using a key value pair.
     *
     * @param \PhpDs\Pair $pair
     */
    public function whereGreaterThanEquals(Pair $pair): PredicateBuilder
    {
        $this->firstPredicate = $this->createPredicate(new PredicateOperatorGTE(), $pair);
        return $this;
    }

    /**
     * Begins building the predicate using a key value pair.
     *
     * @param \PhpDs\Pair $pair
     */
    public function whereLessThan(Pair $pair): PredicateBuilder
    {
        $this->firstPredicate = $this->createPredicate(new PredicateOperatorLT(), $pair);
        return $this;
    }

    /**
     * Begins building the predicate using a key value pair.
     *
     * @param \PhpDs\Pair $pair
     */
    public function whereLessThanEquals(Pair $pair): PredicateBuilder
    {
        $this->firstPredicate = $this->createPredicate(new PredicateOperatorLTE(), $pair);
        return $this;
    }

    private function createPredicate(PredicateOperator $operator, Pair $pair): PredicateSimple
    {
        return new PredicateSimple($operator, $pair->key(), $pair->value());
    }

    private function appendPredicate(
        string $conjunctionClassName,
        string $operatorClassName,
        Pair $pair
    ): PredicateBuilder {
        $tail = isset($this->compoundPredicate)
            ? $this->compoundPredicate
            : $this->firstPredicate;

        $predicateToAppend = $this->createPredicate(new $operatorClassName(), $pair);

        $this->compoundPredicate = new $conjunctionClassName($tail, $predicateToAppend);

        return $this;
    }

    public function andEquals(Pair $pair): PredicateBuilder
    {
        if (false === isset($this->firstPredicate)) {
            return $this->whereEquals($pair);
        }
        return $this->appendPredicate(PredicateConjunctionAnd::class, PredicateOperatorEQ::class, $pair);
    }

    public function andGreaterThan(Pair $pair): PredicateBuilder
    {
        if (false === isset($this->firstPredicate)) {
            return $this->whereGreaterThan($pair);
        }
        return $this->appendPredicate(PredicateConjunctionAnd::class, PredicateOperatorGT::class, $pair);
    }

    public function andGreaterThanOrEquals(Pair $pair): PredicateBuilder
    {
        if (false === isset($this->firstPredicate)) {
            return $this->whereGreaterThanEquals($pair);
        }
        return $this->appendPredicate(PredicateConjunctionAnd::class, PredicateOperatorGTE::class, $pair);
    }

    public function andNotEquals(Pair $pair): PredicateBuilder
    {
        if (false === isset($this->firstPredicate)) {
            return $this->whereNotEquals($pair);
        }
        return $this->appendPredicate(PredicateConjunctionAnd::class, PredicateOperatorNEQ::class, $pair);
    }

    public function andLessThan(Pair $pair): PredicateBuilder
    {
        if (false === isset($this->firstPredicate)) {
            return $this->whereLessThan($pair);
        }
        return $this->appendPredicate(PredicateConjunctionAnd::class, PredicateOperatorLT::class, $pair);
    }

    public function andLessThanOrEquals(Pair $pair): PredicateBuilder
    {
        if (false === isset($this->firstPredicate)) {
            return $this->whereLessThanEquals($pair);
        }
        return $this->appendPredicate(PredicateConjunctionAnd::class, PredicateOperatorLTE::class, $pair);
    }

    public function orEquals(Pair $pair): PredicateBuilder
    {
        if (false === isset($this->firstPredicate)) {
            return $this->whereEquals($pair);
        }
        return $this->appendPredicate(PredicateConjunctionOr::class, PredicateOperatorEQ::class, $pair);
    }

    public function orGreaterThan(Pair $pair): PredicateBuilder
    {
        if (false === isset($this->firstPredicate)) {
            return $this->whereGreaterThan($pair);
        }
        return $this->appendPredicate(PredicateConjunctionOr::class, PredicateOperatorGT::class, $pair);
    }

    public function orGreaterThanOrEquals(Pair $pair): PredicateBuilder
    {
        if (false === isset($this->firstPredicate)) {
            return $this->whereGreaterThanEquals($pair);
        }
        return $this->appendPredicate(PredicateConjunctionOr::class, PredicateOperatorGTE::class, $pair);
    }

    public function orNotEquals(Pair $pair): PredicateBuilder
    {
        if (false === isset($this->firstPredicate)) {
            return $this->whereNotEquals($pair);
        }
        return $this->appendPredicate(PredicateConjunctionOr::class, PredicateOperatorNEQ::class, $pair);
    }

    public function orLessThan(Pair $pair): PredicateBuilder
    {
        if (false === isset($this->firstPredicate)) {
            return $this->whereLessThan($pair);
        }
        return $this->appendPredicate(PredicateConjunctionOr::class, PredicateOperatorLT::class, $pair);
    }

    public function orLessThanOrEquals(Pair $pair): PredicateBuilder
    {
        if (false === isset($this->firstPredicate)) {
            return $this->whereLessThanEquals($pair);
        }
        return $this->appendPredicate(PredicateConjunctionOr::class, PredicateOperatorLTE::class, $pair);
    }

    public function __toString()
    {
        if (false === isset($this->firstPredicate)) {
            return "";
        }
        $predicate = isset($this->compoundPredicate) ? $this->compoundPredicate : $this->firstPredicate;
        return join(self::WHITESPACE, [self::WHERE, $predicate]);
    }
}
