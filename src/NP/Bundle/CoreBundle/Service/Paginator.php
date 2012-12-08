<?php

namespace NP\Bundle\CoreBundle\Service;

class Paginator
{
    protected $adapter;
    
    public function __construct($adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @param type $query
     * @param type $page
     * @param type $count_items
     * @param type $page_range
     * @return \Zend\Paginator\Paginator 
     */
    public function paginate($query, $page, $count_items, $page_range)
    {
        $this->adapter->setQuery($query);
        $this->adapter->setDistinct(true);
        
        $paginator = new \Zend\Paginator\Paginator($this->adapter);
        $paginator->setCurrentPageNumber($page);
        $paginator->setItemCountPerPage($count_items);
        $paginator->setPageRange($page_range);
        
        return $paginator;
    }
}