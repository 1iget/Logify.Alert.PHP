<?php
namespace DevExpress;

class LoadHelper {
    public static function LoadModule($className) {
        if(strpos($className, 'iCollector') || strpos($className, 'iVariables') ){
            $filePath =__DIR__.'/Core/Interfaces.php';
            require_once ($filePath);
            return;
        }
        $namespaceName = 'DevExpress\\Logify';
        //$namespaceName = __NAMESPACE__;
        $namespaceNamePos = strpos($className, $namespaceName);
        if ($namespaceNamePos === 0) {
            $subFolderPath = substr($className, $namespaceNamePos + strlen($namespaceName));
            $filePath = __DIR__.str_replace("\\", DIRECTORY_SEPARATOR, $subFolderPath).".php";
            if(strpos($filePath, 'Collectors')){
                $filePath = str_replace('Collector.php', '.php', $filePath);
            }
            require_once($filePath);
        }
    }
}
?>