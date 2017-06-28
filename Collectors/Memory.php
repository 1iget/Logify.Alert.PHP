<?php
    require_once('/Interfaces.php');

    class MemoryCollector  implements iCollector {

        public function CollectData(){
            $bytes = memory_get_usage();
            $mBytes = number_format($bytes/1048576, 2, '.', '');
            $result = sprintf('%1$s Mb (%2$s bytes).', $mBytes, $bytes);
            return array(
                'workingSet' => $result,
            );
        }
    }
?>