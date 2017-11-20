<?php
namespace DevExpress\Logify\Core;
class Breadcrumb{
    private $dateTime;
    public $level;
    public $event;
    public $category;
    public $message;
    public $className;
    public $methodName;
    public $line = -1;
    public $customData;
    public $isAuto;
    function __construct(){
        $this->dateTime = gmdate("c");
    }
    function GetBreadcrumbData() {
        $result = array();
        $result['dateTime'] = $this->dateTime;
        $result['level'] = $this->level;
        $result['event'] = $this->event;
        $result['category'] = $this->category;
        $result['message'] = $this->message;
        $result['className'] = $this->className;
        $result['methodName'] = $this->methodName;
        $result['line'] = $this->line;
        $result['customData'] = $this->customData;
        $result['isAuto'] = $this->isAuto;
        return $result;
    }    
}
?>