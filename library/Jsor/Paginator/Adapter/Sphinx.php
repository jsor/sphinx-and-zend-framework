<?php
/**
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.
 * It is also available through the world-wide-web at this URL:
 * http://www.opensource.org/licenses/bsd-license.php
 *
 * @category   Jsor
 * @package    Jsor_Paginator
 * @copyright  Copyright (c) 2010-Present Jan Sorgalla
 * @license    http://www.opensource.org/licenses/bsd-license.php     BSD License
 */

/**
 * @see Zend_Paginator_Adapter_Interface
 */
require_once 'Zend/Paginator/Adapter/Interface.php';

/**
 * @category   Jsor
 * @package    Jsor_Paginator
 * @copyright  Copyright (c) 2010-Present Jan Sorgalla
 * @license    http://www.opensource.org/licenses/bsd-license.php     BSD License
 */
class Jsor_Paginator_Adapter_Sphinx implements Zend_Paginator_Adapter_Interface
{
    /**
     * Sphinx client
     *
     * @var SphinxClient
     */
    protected $_sphinxClient = null;
    
    /**
     * Sphinx query
     *
     * @var string
     */
    protected $_sphinxQuery = null;
 
    /**
     * Total item count
     *
     * @var integer
     */
    protected $_rowCount = null;

    /**
     * Constructor.
     *
     * @param Zend_Db_Select $select The select query
     */
    public function __construct($sphinxQuery)
    {
        if (!class_exists('SphinxClient', false)) {
            include_once 'sphinxapi.php';
        }
    }

    /**
     * Returns an array of items for a page.
     *
     * @param  integer $offset Page offset
     * @param  integer $itemCountPerPage Number of items per page
     * @return array
     */
    public function getItems($offset, $itemCountPerPage)
    {
    }

    /**
     * Returns the total number of rows in the result set.
     *
     * @return integer
     */
    public function count()
    {
        if ($this->_rowCount === null) {
            $this->getItems(0, 0);
        }

        return $this->_rowCount;
    }
}
