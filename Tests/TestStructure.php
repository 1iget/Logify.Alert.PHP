<?php
//include('/Collectors/Report.php');
class StructureTest extends PHPUnit_Framework_TestCase {
    private $reportData;

    protected function setUp(){
        $report = new ReportCollector(new Exception('test exception'));
        $this->reportData = $report->CollectData();
    }
    public function testReportStructure(){
        $exception = new Exception('test exception');
        $report = new ReportCollector($exception);
        $reportData = $report->CollectData();
        $this->assertTrue(is_array($reportData));
    }
    public function testReportStructure2(){
        $exception = new Exception('test exception');
        $report = new ReportCollector($exception);
        $reportData = $report->CollectData();
        $this->assertEquals(11, count($reportData));
    }
}
#region template test situation
interface iCollector {
    public function DataName();
    public function CollectData();
}
interface iVariables {
    public function HaveData();
}
class ProtocolVersionCollector implements iCollector {

    #region iCollector Members

    function DataName()	{
        return 'logifyProtocolVersion';
    }

    function CollectData() {
        return '17.1';
    }

    #endregion
}
class DateTimeCollector implements iCollector {
    function DataName()	{
        return 'logifyReportDateTimeUtc';
    }

    public function CollectData() {
        return gmdate('c');
    }
    function is_32bit(){
        return PHP_INT_SIZE === 4;
    }
}
class LogifyAppCollector implements iCollector{
    const version = '17.1';
    const name = 'Test PHP application for testing PHP logify alert client';
    const userId = 'php test user';

    function DataName()	{
        return 'logifyApp';
    }

    public function CollectData(){
        $result = array(
            'name' => self::name,
            'version' => self::version,
            'userId' => self::userId,
        );
        return $result;
    }
}
class AppCollector implements iCollector {
    const name = 'Test PHP Application';
    const version = '1.0.0.0';

    function DataName()	{
        return 'app';
    }

    public function CollectData() {
        $result = array(
            'name' => self::name,
            'version' => self::version,
            'is64bit' => !$this->is_32bit(),
        );
        return $result;
    }
    function is_32bit(){
        return PHP_INT_SIZE === 4;
    }
}
class ExceptionCollector implements iCollector {
    public $exceptions = array();

    function DataName()	{
        return 'exception';
    }

    public function CollectData(){
        $result = array();
        foreach($this->exceptions as $e){
            $result[] = array(
                'type' =>  get_class($e),
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
                'file' => $e->getFile(),
                'line' =>$e->getLine(),
                'stackTrace' => $e->getTraceAsString(),
            );
        }
        return $result;
    }
    public function AddException (Exception $e){
        $this->exceptions[] = $e;
    }

    public static function GetInstance(Exception $e){
        $result = new ExceptionCollector();
        $result->AddException($e);
        return $result;
    }

}
class ExtensionsCollector implements iCollector {

    function DataName()	{
        return 'PHPLoadedExtensions';
    }

    public function CollectData() {
        $result = array();
        foreach(get_loaded_extensions() as $extesion){
            $result[$extesion] = phpversion($extesion);
        }
        return $result;
    }
}
class GlobalVariablesCollector implements iCollector {
    private $collectors = array();

    function __construct() {
        $this->collectors[] = new VariablesCollector('get', $_GET);
        $this->collectors[] = new VariablesCollector('post', $_POST);
        $this->collectors[] = new VariablesCollector('cookie', $_COOKIE);
        $this->collectors[] = new VariablesCollector('files', $_FILES);
        $this->collectors[] = new VariablesCollector('enviroment', $_ENV);
        $this->collectors[] = new VariablesCollector('request', $_REQUEST);
        $this->collectors[] = new VariablesCollector('server', $_SERVER);
    }

    #region iCollector Members

    function DataName()	{
        return 'globals';
    }

    function CollectData()	{
        $result = array();
        foreach($this->collectors as $collector) {
            if($collector->HaveData()) {
                $result[$collector->DataName()] = $collector->CollectData();
            }
        }
        return $result;
    }

    #endregion
}
class VariablesCollector implements iCollector, iVariables {
	private $name;
	private $variables;

	function __construct($name, $variables) {
		$this->name = $name;
		$this->variables = $variables;
	}

	#region iCollector Members
	function DataName()	{
		return $this->name;
	}

	function CollectData()	{
		return $this->variables;
	}
	#endregion

	#region iVariables Members
	function HaveData()	{
		return !empty($this->variables);
	}
	#endregion

}
class OSCollector  implements iCollector {

    function DataName()	{
        return 'os';
    }

    function CollectData(){
        $platform = php_uname('s');
        $version = php_uname('r').'. '.php_uname('v');
        $is64bit = !$this->is_32bit();
        $architecture = php_uname('m');

        return array(
            'platform' => $platform,
            'version' => $version,
            'is64bit' => $is64bit,
            'architecture' => $architecture,
        );
    }
    function is_32bit(){
        return PHP_INT_SIZE === 4;
    }
}
class MemoryCollector  implements iCollector {

    function DataName()	{
        return 'memory';
    }

    public function CollectData(){
        $bytes = memory_get_usage();
        $mBytes = number_format($bytes/1048576, 2, '.', '');
        $result = sprintf('%1$s Mb (%2$s bytes).', $mBytes, $bytes);
        return array(
            'workingSet' => $result,
        );
    }
}
class DevPlatformCollector implements iCollector {

    #region iCollector Members
    function DataName()	{
        return 'devPlatform';
    }

    function CollectData()	{
        return 'dotnet';
    }
    #endregion
}
class PlatformCollector implements iCollector {
    #region iCollector Members
    function DataName()	{
        return 'platform';
    }

    function CollectData()	{
        return 'PHP';
    }
    #endregion
}
class ReportCollector implements iCollector {
    private $collectors = array();

    function __construct($exeption) {
        $this->collectors[] = new ProtocolVersionCollector();
        $this->collectors[] = new DateTimeCollector();
        $this->collectors[] = new LogifyAppCollector();
        $this->collectors[] = new AppCollector();
        $this->collectors[] = ExceptionCollector::GetInstance($exeption);
        $this->collectors[] = new ExtensionsCollector();
        $this->collectors[] = new GlobalVariablesCollector();
        $this->collectors[] = new OSCollector();
        $this->collectors[] = new MemoryCollector();
        $this->collectors[] = new DevPlatformCollector();
        $this->collectors[] = new PlatformCollector();
    }

    function DataName(){
        return '';
    }
    function CollectData()	{
        $result = array();
        foreach($this->collectors as $collector) {
            $result[$collector->DataName()] = $collector->CollectData();
        }
        return $result;
    }
}
#endregion
?>