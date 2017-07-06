# Logify Alert Client for PHP

Properties

public $apiKey;
	public $serviceUrl;
	public $attachments = null;
	public $customData = null;
	public $userId;
  public $globalVariablesPermissions = array();
  public $pathToConfigFile = '/config.php';
  public $appName;
  public $appVersion;
    
Functions

	function send(Exception $exception[, $customData[, $attachments]])
