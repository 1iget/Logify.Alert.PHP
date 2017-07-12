<?php
namespace DevExpress;

class LoadHelper {
    public static function LoadModule($className) {
        $namespaceName = 'DevExpress\\Logify\\';
        $namespaceNamePos = strpos($className, $namespaceName);
        if ($namespaceNamePos === 0) {
            $subFolderPath = substr($className, $namespaceNamePos + strlen($namespaceName));
            $classPath = explode("\\", $subFolderPath);
            $filePath = __DIR__.self::getFileName($classPath);
            require_once($filePath);
        }
    }

    static function getFileName($classPathArray){
        $result = DIRECTORY_SEPARATOR;
        $currentArray = self::getFilesArray();
        foreach($classPathArray as $currentName ){
            if(is_array($currentArray[$currentName])){
                $result = $result.$currentName.DIRECTORY_SEPARATOR;
                $currentArray = $currentArray[$currentName];
            }else{
                $result = $result.$currentArray[$currentName];
            }
        }
        return $result;
    }
    static function getFilesArray(){
        return array(
                'Collectors' => array(
                    'AttachmentsCollector' => 'Attachments.php',
                    'CustomDataCollector' => 'CustomData.php',
                    'DateTimeCollector' => 'DateTime.php',
                    'DevPlatformCollector' => 'DevPlatform.php',
                    'ExceptionCollector' => 'Exception.php',
                    'ExtensionsCollector' => 'Extensions.php',
                    'GlobalVariablesCollector' => 'GlobalVariables.php',
                    'LogifyAppCollector' => 'LogifyApp.php',
                    'MemoryCollector' => 'Memory.php',
                    'OSCollector' => 'OS.php',
                    'PlatformCollector' => 'Platform.php',
                    'ProtocolVersionCollector' => 'ProtocolVersion.php',
                    'ReportCollector' => 'Report.php',
                    'VariablesCollector' => 'Variables.php',
                ),
                'Core' => array(
                    'Attachment' => 'Attachment.php',
                    'iCollector' => 'Interfaces.php',
                    'iVariables' => 'Interfaces.php',
                    'ReportSender' => 'ReportSender.php',
                ),
                'LogifyAlertClient' => 'LogifyAlertClient.php',
    );
    }
}
?>