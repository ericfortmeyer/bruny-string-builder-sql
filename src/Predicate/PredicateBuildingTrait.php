<?php

declare(strict_types=1);

namespace Bruny\SQLString\Predicate;

use PhpDs\Pair;

/**
 * A set of operations used to build predicates.
 */
trait PredicateBuildingTrait
{
    protected PredicateBuilder $predicateBuilder;

    public function whereEquals(array $keyValuePairs): self
    {
        $this->predicateBuilder->whereEquals(new Pair($keyValuePairs));
        return $this;
    }

    public function whereNotEquals(array $keyValuePairs): self
    {
        $this->predicateBuilder->whereNotEquals(new Pair($keyValuePairs));
        return $this;
    }

    public function whereGreaterThan(array $keyValuePairs): self
    {
        $this->predicateBuilder->whereGreaterThan(new Pair($keyValuePairs));
        return $this;
    }

    public function whereGreaterThanOrEquals(array $keyValuePairs): self
    {
        $this->predicateBuilder->whereGreaterThanEquals(new Pair($keyValuePairs));
        return $this;
    }

    public function whereLessThan(array $keyValuePairs): self
    {
        $this->predicateBuilder->whereLessThan(new Pair($keyValuePairs));
        return $this;
    }

    public function whereLessThanOrEquals(array $keyValuePairs): self
    {
        $this->predicateBuilder->whereLessThanEquals(new Pair($keyValuePairs));
        return $this;
    }

    public function andEquals(array $pair): self
    {
        $this->predicateBuilder->andEquals(new Pair($pair));
        return $this;
    }

    public function andGreaterThan(array $pair): self
    {
        $this->predicateBuilder->andGreaterThan(new Pair($pair));
        return $this;
    }

    public function andGreaterThanOrEquals(array $pair): self
    {
        $this->predicateBuilder->andGreaterThanOrEquals(new Pair($pair));
        return $this;
    }

    public function andNotEquals(array $pair): self
    {
        $this->predicateBuilder->andNotEquals(new Pair($pair));
        return $this;
    }

    public function andLessThan(array $pair): self
    {
        $this->predicateBuilder->andLessThan(new Pair($pair));
        return $this;
    }

    public function andLessThanOrEquals(array $pair): self
    {
        $this->predicateBuilder->andLessThanOrEquals(new Pair($pair));
        return $this;
    }

    public function orEquals(array $pair): self
    {
        $this->predicateBuilder->orEquals(new Pair($pair));
        return $this;
    }

    public function orGreaterThan(array $pair): self
    {
        $this->predicateBuilder->orGreaterThan(new Pair($pair));
        return $this;
    }

    public function orGreaterThanOrEquals(array $pair): self
    {
        $this->predicateBuilder->orGreaterThanOrEquals(new Pair($pair));
        return $this;
    }

    public function orNotEquals(array $pair): self
    {
        $this->predicateBuilder->orNotEquals(new Pair($pair));
        return $this;
    }

    public function orLessThan(array $pair): self
    {
        $this->predicateBuilder->orLessThan(new Pair($pair));
        return $this;
    }

    public function orLessThanOrEquals(array $pair): self
    {
        $this->predicateBuilder->orLessThanOrEquals(new Pair($pair));
        return $this;
    }
}
