<?php

use PHPUnit\Framework\TestCase;

class DbCommandBuilderTest extends TestCase
{
    public function tableNames(): array
    {
        return array_map(fn ($str) => [str_repeat($str, 5)], range("A", "Z"));
    }

    public function singleWhereClauseTestCases(): array
    {
        return array_map(
            fn ($tableName, $keyValuePairs) => [$tableName, $keyValuePairs], 
            array_map(fn ($str) => str_repeat($str, 5), range("A", "Z")), 
            array_map(fn ($k, $v) => [$k, $v], range("a", "z"), range("z", "a"))
        );
    }

    public function twoTermWhereClauseTestCases(): array
    {
        return array_map(
            fn ($tableName, $firstTerms, $secondTerms) => [$tableName, $firstTerms, $secondTerms], 
            array_map(fn ($str) => str_repeat($str, 5), range("A", "Z")),
            array_map(fn ($k, $v) => [$k, $v], range("a", "z"), range("z", "a")),
            array_map(fn ($k, $v) => [$k, $v], range("z", "a"), range("a", "z"))
        );
    }

    public function threeTermWhereClauseTestCases(): array
    {
        return array_map(
            fn ($tableName, $firstTerms, $secondTerms, $thirdTerm) => [$tableName, $firstTerms, $secondTerms, $thirdTerm], 
            array_map(fn ($str) => str_repeat($str, 5), range("A", "Z")),
            array_map(fn ($k, $v) => [$k, $v], range("a", "z"), range("z", "a")),
            array_map(fn ($k, $v) => [$k, $v], range("z", "a"), range("a", "z")),
            array_map(fn ($k, $v) => [$k, $v], array_fill(0, count(range("z", "a")), "name"), range("a", "z"))
        );
    }

    /**
     * @dataProvider tableNames
     */
    public function testBuildsDeleteAllString(string $tableName)
    {
        $expected = "DELETE FROM ${tableName}";

        // $sut = DbCommandStringBuilder::init($tableName);

        // $sut->deleteAll();

        // $actual = (string) $sut;

        // $this->assertEquals($expected, $actual);
    }

    /**
     * @dataProvider tableNames
     */
    public function testBuildsDeleteAllStringWhenUsingFromTableMethod(string $tableName)
    {
        $expected = "DELETE FROM ${tableName}";

        // $sut = DbCommandStringBuilder::init();

        // $sut->fromTable($tableName)
        //     ->deleteAll();

        // $actual = (string) $sut;

        // $this->assertEquals($expected, $actual);
    }

    /**
     * @dataProvider singleWhereClauseTestCases
     */
    public function testBuildsDeleteAllStringWithWhereClauseHavingOneTerm(string $tableName, array $singleWhereClauseTerm)
    {
        [$key, $value] = $singleWhereClauseTerm;

        $expected = "DELETE FROM ${tableName} WHERE ${key}=${value}";

        // $sut = DbCommandStringBuilder::init($tableName);

        // $sut->deleteAll()->where($singleWhereClauseTerm);

        // $actual = (string) $sut;

        // $this->assertEquals($expected, $actual);
    }

    /**
     * @dataProvider twoTermWhereClauseTestCases
     */
    public function testBuildsDeleteAllStringWithWhereClauseHavingTwoTerms(string $tableName, array $firstTerm, array $secondTerm)
    {
        [$key1, $value1] = $firstTerm;
        [$key2, $value2] = $secondTerm;

        $expected = "DELETE FROM ${tableName} WHERE ${key1}=${value1} AND ${key2}=${value2}";

        // $sut = DbCommandStringBuilder::init($tableName);

        // $sut->deleteAll()->where($firstTerm, $secondTerm);

        // $actual = (string) $sut;

        // $this->assertEquals($expected, $actual);

    }

    /**
     * @dataProvider threeTermWhereClauseTestCases
     */
    public function testBuildsDeleteAllStringWithWhereClauseHavingThreeTerms(string $tableName, array $firstTerm, array $secondTerm, array $thirdTerm)
    {
        [$key1, $value1] = $firstTerm;
        [$key2, $value2] = $secondTerm;
        [$key3, $value3] = $thirdTerm;

        $expected = "DELETE FROM ${tableName} WHERE ${key1}=${value1} AND ${key2}=${value2} AND ${key3}=${value3}";

        // $sut = DbCommandStringBuilder::init($tableName);

        // $sut->deleteAll()->where($firstTerm, $secondTerm, $thirdTerm);

        // $actual = (string) $sut;

        // $this->assertEquals($expected, $actual);
    }

    /**
     * @dataProvider threeTermWhereClauseTestCases
     */
    public function testBuildsDeleteAllStringWithWhereOrClauseHavingThreeTerms(string $tableName, array $firstTerm, array $secondTerm, array $thirdTerm)
    {
        [$key1, $value1] = $firstTerm;
        [$key2, $value2] = $secondTerm;
        [$key3, $value3] = $thirdTerm;

        $expected = "DELETE FROM ${tableName} WHERE ${key1}=${value1} OR ${key2}=${value2} OR ${key3}=${value3}";

        // $sut = DbCommandStringBuilder::init($tableName);

        // $sut->deleteAll()->whereOr([$key1 => $value1, $key2 => $value2, $key3 => $value3]);

        // $actual = (string) $sut;

        // $this->assertEquals($expected, $actual);
    }

    // /**
    //  * @dataProvider threeTermWhereClauseTestCases
    //  */
    // public function testBuildsDeleteAllStringWithWhereOrClauseHavingThreeTermsUsingFluentCalls(string $tableName, array $firstTerm, array $secondTerm, array $thirdTerm)
    // {
    //     [$key1, $value1] = $firstTerm;
    //     [$key2, $value2] = $secondTerm;
    //     [$key3, $value3] = $thirdTerm;

    //     $expected = "DELETE FROM ${tableName} WHERE ${key1}=${value1} OR ${key2}=${value2} OR ${key3}=${value3}";

    //     $sut = DbCommandStringBuilder::init($tableName);

    //     $sut->deleteAll()->where($firstTerm)->or([$key2 => $value2])->or([$key3 => $value3]);

    //     $actual = (string) $sut;

    //     $this->assertEquals($expected, $actual);
    // }
}
