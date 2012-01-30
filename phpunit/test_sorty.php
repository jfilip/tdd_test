<?php
/**
 * Sorty -- a sorting library that sorts! (PHPUnit test)
 *
 * Requirements:
 *  1. Must be able to sort in ascending or descending order
 *  2. Must be able to sort numeric or text-based data
 *  3. Must be able to sort an 2 dimensional array based on a specific value in the 2nd dimension
 *
 * NOTES:
 *  3.
 */


require_once 'PHPUnit/Framework.php';
require_once dirname(dirname(__FILE__)).'/libsorty.php';


class SortyTest extends PHPUnit_Framework_TestCase {
    /**
     * Define an array of numeric data for sorting in ascending direction
     */
    public static function ascNumberProvider() {
        return array(
            array(
                array(4, 7, 1, 6, 0, 5, 9, 8, 2, 3),
                array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9)
            ),
            array(
                array(10, 532, 90, 77, 125632, 7, -870, 97649, 4, 4),
                array(-870, 4, 4, 7, 10, 77, 90, 532, 97649, 125632)
            )
        );
    }

    /**
     * Define an array of numeric data for sorting in descending direction
     */
    public static function descNumberProvider() {
        return array(
            array(
                array(4, 7, 1, 6, 0, 5, 9, 8, 2, 3),
                array(9, 8, 7, 6, 5, 4, 3, 2, 1, 0)
            ),
            array(
                array(10, 532, 90, 77, 125632, 7, -870, 97649, 4, 4),
                array(125632, 97649, 532, 90, 77, 10, 7, 4, 4, -870)
            )
        );
    }

    /**
     * Define an array of alphabet data for sorting in ascending direction
     */
    public static function ascAlphaProvider() {
        return array(
            array(
                array('lemon', 'orange', 'zzz', 'aaa', 'banana', 'apple'),
                array('aaa', 'apple', 'banana', 'lemon', 'orange', 'zzz')
            ),
            array(
                array('Mike', 'Justin', 'Akin', 'Brendan', 'Linda', 'Brent', 'Tyler', 'Marko', 'James', 'Tim', 'Pablo'),
                array('Akin', 'Brendan', 'Brent', 'James', 'Justin', 'Linda', 'Marko', 'Mike', 'Pablo', 'Tim', 'Tyler')
            )
        );
    }

    /**
     * Define an array of alphabet data for sorting in descending direction
     */
    public static function descAlphaProvider() {
        return array(
            array(
                array('lemon', 'orange', 'zzz', 'aaa', 'banana', 'apple'),
                array('zzz', 'orange', 'lemon', 'banana', 'apple', 'aaa')
            ),
            array(
                array('Mike', 'Justin', 'Akin', 'Brendan', 'Linda', 'Brent', 'Tyler', 'Marko', 'James', 'Tim', 'Pablo'),
                array('Tyler', 'Tim', 'Pablo', 'Mike', 'Marko', 'Linda', 'Justin', 'James', 'Brent', 'Brendan', 'Akin')
            )
        );
    }

    public static function asc2dArrayFirstFieldProvider() {
        return array(
            array(
                array(
                    array('Brent', 201006),
                    array('Mike', 200401),
                    array('Pablo', 201111),
                    array('Justin', 200502),
                    array('Akin', 200603),
                    array('Marko', 201008),
                    array('James', 201109),
                    array('Brendan', 200904),
                    array('Linda', 201005),
                    array('Tim', 201110),
                    array('Tyler', 201007)
                ),
                array(
                    array('Akin', 200603),
                    array('Brendan', 200904),
                    array('Brent', 201006),
                    array('James', 201109),
                    array('Justin', 200502),
                    array('Linda', 201005),
                    array('Marko', 201008),
                    array('Mike', 200401),
                    array('Pablo', 201111),
                    array('Tim', 201110),
                    array('Tyler', 201007)
                )
            )
        );
    }

    public static function asc2dArraySecondFieldProvider() {
        return array(
            array(
                array(
                    array('Brent', 201006),
                    array('Mike', 200401),
                    array('Pablo', 201111),
                    array('Justin', 200502),
                    array('Akin', 200603),
                    array('Marko', 201008),
                    array('James', 201109),
                    array('Brendan', 200904),
                    array('Linda', 201005),
                    array('Tim', 201110),
                    array('Tyler', 201007)
                ),
                array(
                    array('Mike', 200401),
                    array('Justin', 200502),
                    array('Akin', 200603),
                    array('Brendan', 200904),
                    array('Linda', 201005),
                    array('Brent', 201006),
                    array('Tyler', 201007),
                    array('Marko', 201008),
                    array('James', 201109),
                    array('Tim', 201110),
                    array('Pablo', 201111)
                )
            )
        );
    }

    public static function desc2dArraySecondFieldProvider() {
        return array(
            array(
                array(
                    array('Brent', 201006),
                    array('Mike', 200401),
                    array('Pablo', 201111),
                    array('Justin', 200502),
                    array('Akin', 200603),
                    array('Marko', 201008),
                    array('James', 201109),
                    array('Brendan', 200904),
                    array('Linda', 201005),
                    array('Tim', 201110),
                    array('Tyler', 201007)
                ),
                array(
                    array('Pablo', 201111),
                    array('Tim', 201110),
                    array('James', 201109),
                    array('Marko', 201008),
                    array('Tyler', 201007),
                    array('Brent', 201006),
                    array('Linda', 201005),
                    array('Brendan', 200904),
                    array('Akin', 200603),
                    array('Justin', 200502),
                    array('Mike', 200401)
                )
            )
        );
    }


    /**
     * The actual tests are as follows:
     */


    public function testEmptySort() {
        $array = array();

        $this->assertEquals($array, sorty_sort($array));
    }

    /**
     * @dataProvider ascNumberProvider
     */
    public function testNumberSortAscDefaultDirection($a, $b) {
        $this->assertEquals($b, sorty_sort($a));
    }

    /**
     * @dataProvider ascNumberProvider
     */
    public function testNumberSortAscSpecifyDirection($a, $b) {
        $this->assertEquals($b, sorty_sort($a, SORTY_SORT_ASC));
    }

    /**
     * @dataProvider descNumberProvider
     */
    public function testNumberSortDescSpecifyDirection($a, $b) {
        $this->assertEquals($b, sorty_sort($a, SORTY_SORT_DESC));
    }

    /**
     * This is to test that when you expect the data to be sorted in descending order but do not specify the sort
     * parameter, it will not be sorted in the manner you expect.
     *
     * @dataProvider descNumberProvider
     */
    public function testNumberSortDescDefaultDirection($a, $b) {
        $this->assertFalse($b == sorty_sort($a));
    }

    /**
     * @dataProvider ascAlphaProvider
     */
    public function testAlphaSortAscSpecifyDirection($a, $b) {
        $this->assertEquals($b, sorty_sort($a, SORTY_SORT_ASC));
    }

    /**
     * @dataProvider descAlphaProvider
     */
    public function testAlphaSortDescSpecifyDirection($a, $b) {
        $this->assertEquals($b, sorty_sort($a, SORTY_SORT_DESC));
    }

    /**
     * @dataProvider asc2dArrayFirstFieldProvider
     */
    public function test2dArraySortAscSpecifyDirectionAndDefaultSortField($a, $b) {
        $this->assertEquals($b, sorty_sort($a, SORTY_SORT_ASC));
    }

    /**
     * @dataProvider asc2dArraySecondFieldProvider
     */
    public function test2dArraySortAscSpecifyDirectionAndSpecifySortField($a, $b) {
        $this->assertEquals($b, sorty_sort($a, SORTY_SORT_ASC, 1));
    }

    /**
    * @dataProvider desc2dArraySecondFieldProvider
    */
    public function test2dArraySortDescSpecifyDirectionAndSpecifySortField($a, $b) {
        $this->assertEquals($b, sorty_sort($a, SORTY_SORT_DESC, 1));
    }

    /**
     * @dataProvider desc2dArraySecondFieldProvider
     */
    public function test2dArrayInvalidSortField($a, $b) {
        $this->assertFalse(sorty_sort($a, SORTY_SORT_DESC, 2));
    }
}
