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

class FacebookController extends AbstractActionController
{
    public function indexAction(){
        $helperBroker = $this->getServiceLocator()->get('ViewHelperManager');
        $metaHelper = $helperBroker->get('headMeta');
        $metaHelper->setProperty("og:image","http://www.carrybase.com/img/sea.jpg");
        $metaHelper->setProperty("og:title","Testtitel");
        $metaHelper->setProperty("og:url","http://www.carrybase.com/redirect");
        $metaHelper->setProperty("og:description","Testbeschreibung");
        
    }
            
    public function redirectAction(){
        return $this->redirect()->toUrl("https://ad.zanox.com/ppc/?31868007C76436087&ULP=[[http://www.ab-in-den-urlaub.de/ibe/offers/page/1/params/tt/adult/2/agent/ab-in-den-urlaub.de/area/350/depAirport/19%2C23%2C30%2C42%2C46/depDate/30.06.2015/dest/13/distribution/CH/duration/6_7/optCategory/2/optMeal/4/port/654/regiontreeSource/unister/retDate/09.08.2015/totalAdultChildCount/2/hotelId/10785/topHotelSelected/0/start/0/allGermAp/0/allSwissAp/0/ibecat/lastminute/route/flattrip/formSelected/lastminute/switchDestinationField/input/hotelIdType/iff/sortStep3/price/orderdirStep3/asc/hotelAttributesWellness/-1/hotelAttributesSport/-1/hotelAttributes/-1/nottot/1]]");
    }
            
            
            
}