<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class KillLogController extends AbstractActionController
{
    
    public function indexAction(){
        $npcFilter = $this->params()->fromQuery("npcfilter");
        $limit = $this->params()->fromQuery("limit",50);
        $page = $this->params()->fromQuery("page",1);
        $killLogMapper = $this->getServiceLocator()->get('DB\Mapper\KillLog');
        $result = $killLogMapper->getLog([
            'limit' => $limit,
            'page' => $page,
            'npcFilter' => $npcFilter
        ]);
        
        $npcMapper = $this->getServiceLocator()->get('DB\Mapper\NPC');
        
        $adapter = new \Zend\Paginator\Adapter\NullFill($result['count']);
        $paginator = new \Zend\Paginator\Paginator($adapter);
        $paginator->setCurrentPageNumber($page);
        $paginator->setItemCountPerPage($limit);
        
        
        return['result' => $result['result'],'paginator' => $paginator, 'parameter' => $this->params()->fromQuery(),'npcs' => $npcMapper->getEntityRepository()->findAll()];
    }
}
