<?php
/**
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.opensource.org/licenses/bsd-license.php
 *
 * @category   Jsor
 * @package    Jsor_Paginator
 * @copyright  Copyright (c) 2010-Present Jan Sorgalla
 * @license    http://www.opensource.org/licenses/bsd-license.php     BSD License
 */

/**
 * @see Zend_Paginator
 */
require_once 'Zend/Paginator.php';

/**
 * @category   Jsor
 * @package    Jsor_Paginator
 * @copyright  Copyright (c) 2010-Present Jan Sorgalla
 * @license    http://www.opensource.org/licenses/bsd-license.php     BSD License
 */
class Jsor_Paginator extends Zend_Paginator
{
    /**
     * Sets the number of items per page.
     *
     * @param  integer $itemCountPerPage
     * @return Zend_Paginator $this
     */
    public function setItemCountPerPage($itemCountPerPage)
    {
        $this->_itemCountPerPage = (integer) $itemCountPerPage;
        if ($this->_itemCountPerPage < 1) {
            $this->_itemCountPerPage = $this->getItemCountPerPage();
        }
        $this->_pageCount        = null;
        $this->_currentItems     = null;
        $this->_currentItemCount = null;

        return $this;
    }
    
    /**
     * Brings the page number in range of the paginator.
     *
     * @param  integer $pageNumber
     * @return integer
     */
    public function normalizePageNumber($pageNumber)
    {
        if ($pageNumber < 1) {
            $pageNumber = 1;
        }

        //$pageCount = $this->count();

        //if ($pageCount > 0 && $pageNumber > $pageCount) {
        //    $pageNumber = $pageCount;
        //}

        return $pageNumber;
    }
}
