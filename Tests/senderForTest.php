<?php
use DevExpress\Logify\Core\ReportSender;

class ReportSenderTest extends ReportSender {
    public $savedReports = array();
    protected function send_core($json) {
        return 'test error send';
    }
    protected function save_report_to_file($filename, $json) {
        $this->savedReports[] = $json;
    }
}
