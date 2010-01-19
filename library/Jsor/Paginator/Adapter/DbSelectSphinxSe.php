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
 * @see Zend_Db_Select
 */
require_once 'Zend/Db/Select.php';

/**
 * @category   Jsor
 * @package    Jsor_Paginator
 * @copyright  Copyright (c) 2010-Present Jan Sorgalla
 * @license    http://www.opensource.org/licenses/bsd-license.php     BSD License
 */
class Jsor_Paginator_Adapter_DbSelectSphinxSe implements Zend_Paginator_Adapter_Interface
{
    /**
     * Sphinx query
     *
     * @var string
     */
    protected $_sphinxQuery = null;
    
    /**
     * Sphinx table name
     *
     * @var string
     */
    protected $_sphinxTableName = 'sphinx';

    /**
     * Database query
     *
     * @var Zend_Db_Select
     */
    protected $_select = null;

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
    public function __construct(Zend_Db_Select $select, $sphinxQuery, $sphinxTableName = null)
    {
        $this->_select      = $select;
        $this->_sphinxQuery = $sphinxQuery;
        
        if (null !== $sphinxTableName) {
            $this->_sphinxTableName = $sphinxTableName;
        }
        
        $from = $select->getPart(Zend_Db_Select::FROM);
        
        if (!array_key_exists($this->_sphinxTableName, $from)) {
            throw new Zend_Paginator_Exception('Select must contain a table/alias "' . $this->_sphinxTableName. '"');
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
        $select = clone $this->_select;

        $col = $select->getAdapter()->quoteIdentifier($this->_sphinxTableName . '.query');
        $select->where($col . ' = ?', $this->_sphinxQuery . ';limit=' . $itemCountPerPage . ';offset=' . $offset);
        
        if ($select instanceof Zend_Db_Table_Select) {
            $result = $select->getTable()->fetchAll($select);
        } else {
            $result = $select->query()->fetchAll();
        }
        
        if ($this->_rowCount === null) {        
            $this->_rowCount = $select->getAdapter()->query("SHOW STATUS LIKE 'sphinx_total_found'")->fetchColumn(1);
        }
        
        return $result;
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
