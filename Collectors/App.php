<?php
    require_once('/Interfaces.php');

    class AppCollector implements iCollector {
        const name = 'Test PHP Application';
        const version = '1.0.0.0';
        const is64bit = false;

		function DataName()	{
			return 'app';
		}

        public function CollectData() {
            $result = array(
                'name' => self::name,
                'version' => self::version,
                'is64bit' => self::is64bit,
            );
            return $result;
        }
    }
?>