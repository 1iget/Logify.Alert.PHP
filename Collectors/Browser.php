<?php
require_once(__DIR__.'/Interfaces.php');

class BrowserCollector implements iCollector, iVariables {

    #region iCollector Members
	function DataName()	{
		return 'clientBrowser';
	}

	function CollectData() {
		$this->result = array();
        $this->result['agent'] = (@$_SERVER['HTTP_USER_AGENT'])? $_SERVER['HTTP_USER_AGENT'] : '';
        $this->SetBrowser();
		$this->SetOS();
		$this->SetIp();
		$this->SetRobot();
		$this->SetMobile();
		return $this->result;
	}
	#endregion
	#region iVariables Members
	function HaveData()	{
		return true;
	}
	#endregion

    private function SetIp() {
        $this->result['ip'] = $_SERVER['REMOTE_ADDR'];
        return true;
    }
    private function SetBrowser() {
		foreach ($this->GetBrowsers() as $key => $val) {
			if (preg_match("|".preg_quote($key).".*?([0-9\.]+)|i", $this->result['agent'], $match)) {
				$this->result['name'] = $val;
				$this->result['version']  = $match[1];
				return true;
			}
		}
        return false;
	}
    private function SetOS() {
		foreach ($this->GetOSs() as $key => $val) {
			if (preg_match("|".preg_quote($key).".*?([a-zA-Z]?[0-9\.]+)|i", $this->result['agent'], $match)) {
				$this->result['os'] = $val;
				$this->result['osVersion'] = $match[1];
				return true;
			}
		}
        $this->result['os'] = 'Unknown';
		return false;
	}
    private function SetRobot() {
		foreach ($this->GetRobots() as $key => $val) {
			if (preg_match("|".preg_quote($key)."|i", $this->result['agent'])) {
				$this->result['robot'] = $val;
				return true;
			}
		}
        return false;
	}
    private function SetMobile() {
		foreach ($this->GetMobiles() as $key => $val) {
			if (false !== (strpos(strtolower($this->result['agent']), $key))) {
				$this->result['mobile'] = $val;
				return true;
			}
		}
        return false;
	}
	private function GetRobots() {
		return array(
				'yandex'    => 'Yandex Bot',
				'rambler'   => 'Rambler Bot',
				'mail.ru'   => 'Mail.Ru Bot',
			    'google'    => 'Googlebot',
				'msnbot'    => 'MSNBot',
			    'slurp'     => 'Inktomi Slurp',
				'yahoo'     => 'Yahoo',
				'askjeeves' => 'AskJeeves',
				'fastcrawler'=> 'FastCrawler',
				'infoseek'  => 'InfoSeek Robot 1.0',
				'lycos'     => 'Lycos',
				);
	}
	private function GetOSs() {
		return array (
				'windows nt 10'    => 'Windows 10',
				'windows nt 6.3'    => 'Windows 8.1',
				'windows nt 6.2'    => 'Windows 8',
				'windows nt 6.1'    => 'Windows 7',
    			'windows nt 6.0'    => 'Windows Vista',
    			'windows nt 5.2'    => 'Windows 2003',
    			'windows nt 5.0'    => 'Windows 2000',
    			'windows nt 5.1'    => 'Windows XP',
    			'windows nt 4.0'    => 'Windows NT 4.0',
    			'winnt4.0'          => 'Windows NT 4.0',
    			'winnt 4.0'         => 'Windows NT',
    			'winnt'             => 'Windows NT',
    			'windows 98'        => 'Windows 98',
    			'win98'             => 'Windows 98',
    			'windows 95'        => 'Windows 95',
    			'win95'             => 'Windows 95',
    			'windows'           => 'Unknown Windows OS',
    			'os x'              => 'Mac OS X',
    			'ppc mac'           => 'Power PC Mac',
    			'freebsd'           => 'FreeBSD',
    			'ppc'               => 'Macintosh',
    			'ubuntu'            => 'Ubuntu',
    			'debian'            => 'Debian',
    			'linux'             => 'Linux',
    			'sunos'             => 'Sun Solaris',
    			'beos'              => 'BeOS',
    			'apachebench'       => 'ApacheBench',
    			'aix'               => 'AIX',
    			'irix'              => 'Irix',
    			'osf'               => 'DEC OSF',
    			'hp-ux'             => 'HP-UX',
    			'netbsd'            => 'NetBSD',
    			'bsdi'              => 'BSDi',
    			'openbsd'           => 'OpenBSD',
    			'gnu'               => 'GNU/Linux',
    			'unix'              => 'Unknown Unix OS',

    			'symbian'           => "Symbian",
			    'SymbianOS'         => "SymbianOS",
    			'elaine'            => "Palm",
    			'palm'              => "Palm",
    			'series60'          => "Symbian S60",
    			'windows ce'        => "Windows CE",
			);
	}
	private function GetBrowsers(){
		return array(
				'Flock'     => 'Flock',
		        'SeaMoney'  => 'SeaMonkey',
		        'Chrome'    => 'Chrome',
				'Opera'     => 'Opera',
				'MSIE'      => 'Internet Explorer',
		        'Internet Explorer' => 'Internet Explorer',
				'Shiira'    => 'Shiira',
		        'Firefox'   => 'Firefox',
				'Chimera'   => 'Chimera',
				'Phoenix'   => 'Phoenix',
				'Firebird'  => 'Firebird',
				'Camino'    => 'Camino',
				'Netscape'  => 'Netscape',
				'OmniWeb'   => 'OmniWeb',
				'Safari'    => 'Safari',
				'Mozilla'   => 'Mozilla',
				'Konqueror' => 'Konqueror',
				'icab'      => 'iCab',
				'Lynx'      => 'Lynx',
				'Links'     => 'Links',
				'hotjava'   => 'HotJava',
				'amaya'     => 'Amaya',
				'IBrowse'   => 'IBrowse'
			);
	}
	private function GetMobiles() {
		return array(
			    'mobileexplorer'    => 'Mobile Explorer',
                'palmsource'        => 'Palm',
                'palmscape'         => 'Palmscape',
                'motorola'          => "Motorola",
                'nokia'             => "Nokia",
                'palm'              => "Palm",
                'iphone'            => "Apple iPhone",
                'ipad'              => "iPad",
                'ipod'              => "Apple iPod Touch",
                'sony'              => "Sony Ericsson",
                'ericsson'          => "Sony Ericsson",
                'blackberry'        => "BlackBerry",
                'cocoon'            => "O2 Cocoon",
                'blazer'            => "Treo",
                'lg'                => "LG",
                'amoi'              => "Amoi",
                'xda'               => "XDA",
                'mda'               => "MDA",
                'vario'             => "Vario",
                'htc'               => "HTC",
                'samsung'           => "Samsung",
                'sharp'             => "Sharp",
                'sie-'              => "Siemens",
                'alcatel'           => "Alcatel",
                'benq'              => "BenQ",
                'ipaq'              => "HP iPaq",
                'mot-'              => "Motorola",
                'playstation portable'=> "PlayStation Portable",
                'hiptop'            => "Danger Hiptop",
                'nec-'              => "NEC",
                'panasonic'         => "Panasonic",
                'philips'           => "Philips",
                'sagem'             => "Sagem",
                'sanyo'             => "Sanyo",
                'spv'               => "SPV",
                'zte'               => "ZTE",
                'sendo'             => "Sendo",
                //mobile os
                'symbian'   => "Symbian",
                'SymbianOS' => "SymbianOS",
                'elaine'    => "Palm",
                'palm'      => "Palm",
                'series60'  => "Symbian S60",
                'windows ce'=> "Windows CE",
                //mobile browsers
                'obigo'     => "Obigo",
                'netfront'  => "Netfront Browser",
                'openwave'  => "Openwave Browser",
                'mobilexplorer'=> "Mobile Explorer",
                'operamini' => "Opera Mini",
                'opera mini'=> "Opera Mini",
                //another
                'digital paths' => "Digital Paths",
                'avantgo'       => "AvantGo",
                'xiino'         => "Xiino",
                'novarra'       => "Novarra Transcoder",
                'vodafone'      => "Vodafone",
                'docomo'        => "NTT DoCoMo",
                'o2'            => "O2",
                //fallback
                'mobile'    => "Generic Mobile",
                'wireless'  => "Generic Mobile",
                'j2me'      => "Generic Mobile",
                'midp'      => "Generic Mobile",
                'cldc'      => "Generic Mobile",
                'up.link'   => "Generic Mobile",
                'up.browser'=> "Generic Mobile",
                'smartphone'=> "Generic Mobile",
                'cellphone' => "Generic Mobile"
            );
	}
}

?>