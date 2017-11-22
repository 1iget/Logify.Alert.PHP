<?php
namespace DevExpress\Logify\Core;

use DevExpress\Logify\Core\Breadcrumb;
use DevExpress\Logify\LogifyAlertClient;

class BreadcrumbCollection {
    #region fields
    private $breadcrumbs = null;
    private $breadcrumbsMaxCount = null;
    #endregion
    
    public function __construct($breadcrumbsMaxCount = 1000) {
        $this->breadcrumbsMaxCount = $breadcrumbsMaxCount;
    }
    
    public function add ($message = "", $category = "", $dateTime = NULL, $level = BreadcrumbLevel::Info, $event = "manual", $className = "", $methodName = "", $line = 0, $customData = null) {
        if ($this->breadcrumbs != null) {
            $this->check_size();
        } else {
            $this->breadcrumbs = array();
        }

        $breadcrump = new Breadcrumb($dateTime);
        $breadcrump->level = $level;
        $breadcrump->event = $event;
        $breadcrump->category = $category;
        $breadcrump->message = $message;
        $breadcrump->className = $className;
        $breadcrump->methodName = $methodName;
        $breadcrump->line = $line;
        $breadcrump->customData = $customData;

        if (count($this->breadcrumbs) == $this->breadcrumbsMaxCount && $breadcrump != NULL) {
            array_shift($this->breadcrumbs);
        }
        $this->breadcrumbs[] = $breadcrump;
    }
    public function get(){
        $this->check_size();
        return $this->breadcrumbs;
    }
    public function clear () {
        $this->breadcrumbs = NULL;
    }
    private function check_size() {
        $this->breadcrumbsMaxCount = LogifyAlertClient::get_instance()->breadcrumbsMaxCount;
        if ($this->breadcrumbs != null) {
            $overSize = count($this->breadcrumbs) - $this->breadcrumbsMaxCount;
            if ($overSize > 0) {
                array_splice($this->breadcrumbs, 0, $overSize);
            }
        }
    }
    #endregion
}
?>

