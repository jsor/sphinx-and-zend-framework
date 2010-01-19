<?php

/**
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.opensource.org/licenses/bsd-license.php
 *
 * @category   Jsor
 * @package    Jsor
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2010-Present Jan Sorgalla
 * @license    http://www.opensource.org/licenses/bsd-license.php     BSD License
 */

require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'bootstrap.php';

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Jsor_AllTests::main');
}

require_once 'Jsor/Paginator/AllTests.php';

/**
 * @category   Jsor
 * @package    Jsor
 * @subpackage UnitTests
 * @group      Jsor
 * @copyright  Copyright (c) 2005-2010 Jsor Technologies USA Inc. (http://www.Jsor.com)
 * @license    http://framework.Jsor.com/license/new-bsd     New BSD License
 */
class Jsor_AllTests
{
    public static function main()
    {
        PHPUnit_TextUI_TestRunner::run(self::suite());
    }

    /**
     * Regular suite
     *
     * All tests except those that require output buffering.
     *
     * @return PHPUnit_Framework_TestSuite
     */
    public static function suite()
    {
        $suite = new PHPUnit_Framework_TestSuite('Jsor Framework - Jsor');

        $suite->addTest(Jsor_Paginator_AllTests::suite());

        return $suite;
    }
}

if (PHPUnit_MAIN_METHOD == 'Jsor_AllTests::main') {
    Jsor_AllTests::main();
}
