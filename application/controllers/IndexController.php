<?php

class IndexController extends Zend_Controller_Action
{
    public function indexAction()
    {
        if ($this->_request->isPost()) {
            $query = $this->_request->getPost('query');
            if (strlen($query) > 0) {
                $this->_helper->redirector->gotoRoute(array('query' => $query));
                return;
            }
        }

        $query = $this->_getParam('query');

        if (strlen($query) > 0) {
            $db = $this->getInvokeArg('bootstrap')->getResource('db');

            $select = $db->select()
                ->from('posts')
                ->join('categories', 'categories.id = posts.category_id', array('category_name' => 'name'))
                ->join('sphinx', 'sphinx.id = posts.id', array('weight'));

            $this->view->paginator = new Jsor_Paginator(new Jsor_Paginator_Adapter_DbSelectSphinxSe($select, $query . ';mode=any;sort=extended:@weight desc, @id asc;index=posts'));

            $this->view->paginator
                ->setItemCountPerPage($this->_getParam('perpage', 25))
                ->setCurrentPageNumber($this->_getParam('page', 1));
        
            $this->view->profiler = $db->getProfiler();
        }
    }


}

