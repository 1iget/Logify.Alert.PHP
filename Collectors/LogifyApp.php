<?php
    require_once('/Interfaces.php');

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
?>