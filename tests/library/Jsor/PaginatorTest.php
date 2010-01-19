<?php
/**
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.opensource.org/licenses/bsd-license.php
 *
 * @category   Zend
 * @package    Jsor_Paginator
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2010-Present Jan Sorgalla
 * @license    http://www.opensource.org/licenses/bsd-license.php     BSD License
 */

// Call Jsor_PaginatorTest::main() if this source file is executed directly.
if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Jsor_PaginatorTest::main');
}

/**
 * @see Jsor_Paginator
 */
require_once 'Jsor/Paginator.php';

/**
 * @category   Zend
 * @package    Jsor_Paginator
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2010 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Jsor_Paginator
 */
class Jsor_PaginatorTest extends PHPUnit_Framework_TestCase
{
    /**
     * Runs the test methods of this class.
     *
     * @return void
     */
    public static function main()
    {
        $suite  = new PHPUnit_Framework_TestSuite(__CLASS__);
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    /**
     * Paginator instance
     *
     * @var Jsor_Paginator
     */
    protected $_paginator = null;

    protected function setUp()
    {
        $this->_testCollection = range(1, 101);
        $this->_paginator = Jsor_Paginator::factory($this->_testCollection);

        $this->_restorePaginatorDefaults();
    }

    protected function tearDown()
    {
        $this->_testCollection = null;
        $this->_paginator = null;
    }

    protected function _restorePaginatorDefaults()
    {
        $this->_paginator->setItemCountPerPage(10);
        $this->_paginator->setCurrentPageNumber(1);
        $this->_paginator->setPageRange(10);
    }

    public function testGetsAndSetsItemCountPerPage()
    {
        Jsor_Paginator::setConfig(new Zend_Config(array()));
        $this->_paginator = new Jsor_Paginator(new Zend_Paginator_Adapter_Array(range(1, 101)));
        $this->assertEquals(10, $this->_paginator->getItemCountPerPage());
        $this->_paginator->setItemCountPerPage(15);
        $this->assertEquals(15, $this->_paginator->getItemCountPerPage());
        $this->_paginator->setItemCountPerPage(0);
        $this->assertEquals(10, $this->_paginator->getItemCountPerPage());
        $this->_paginator->setItemCountPerPage(10);
    }

    public function testGetsCurrentItemCount()
    {
        $this->_paginator->setItemCountPerPage(10);
        $this->_paginator->setPageRange(10);

        $this->assertEquals(10, $this->_paginator->getCurrentItemCount());

        $this->_paginator->setCurrentPageNumber(11);

        $this->assertEquals(1, $this->_paginator->getCurrentItemCount());

        $this->_paginator->setCurrentPageNumber(1);
    }

    public function testNormalizesPageNumber()
    {
        $this->assertEquals(1, $this->_paginator->normalizePageNumber(0));
        $this->assertEquals(1, $this->_paginator->normalizePageNumber(1));
        $this->assertEquals(2, $this->_paginator->normalizePageNumber(2));
        $this->assertEquals(5, $this->_paginator->normalizePageNumber(5));
        $this->assertEquals(10, $this->_paginator->normalizePageNumber(10));
        $this->assertEquals(11, $this->_paginator->normalizePageNumber(11));
        $this->assertEquals(11, $this->_paginator->normalizePageNumber(12));
    }
}

// Call Jsor_PaginatorTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD === 'Jsor_PaginatorTest::main') {
    Jsor_PaginatorTest::main();
}
