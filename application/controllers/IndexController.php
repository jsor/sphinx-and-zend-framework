<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $select = $this->getInvokeArg('bootstrap')->getResource('db')->select();
        
        $select->from('sphinx');
        
        $this->view->paginator = new Jsor_Paginator(new Jsor_Paginator_Adapter_DbSelectSphinxSe($select, 'this;mode=any;sort=extended:@weight desc, @id asc;index=posts'));
    }


}

