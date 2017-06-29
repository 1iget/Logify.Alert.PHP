<?php
require_once('/Interfaces.php');

class BrowserCollector implements iCollector, iVariables {
	#region arrays
    private $browsers = array(
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
    private $mobiles = array(
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
private $robots = array(
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
private $oss = array (
    'windows nt 6.0'    => 'Windows Longhorn',
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
	#endregion
	#region iCollector Members
	function DataName()	{
		return 'clientBrowser';
	}

	function CollectData() {
        $result = array();
        $result['agent'] = $this->agent;
        $result['name'] = $this->browser;
        $result['fullName'] = $this->browserFullName;
        $result['version'] = $this->version;
        $result['os'] = $this->operating_system;
        $result['osVersion'] = $this->os_version;
        $result['ip'] = $this->ip;
        if($this->isRobot){
            $result['robot'] = $this->robot;
        }
        if($this->isMobile){
            $result['mobile'] = $this->mobile;
        }
		return $result;
	}
	#endregion

    public $isBrowser = False;
    public $isMobile = False;
    public $isRobot = False;

    public $ip = '';
    public $version = '';
    public $browser = '';
    public $browserFullName = '';
    public $os = '';
    public $osVersion = '';
    public $robot = '';
    public $mobile = '';

    public function __construct() {
        $this->agent = (@$_SERVER['HTTP_USER_AGENT'])? $_SERVER['HTTP_USER_AGENT'] : '';

        $setMethods = array('SetIp', 'SetBrowser', 'SetOperatingSystem', 'SetRobot', 'SetMobile');
        foreach($setMethods as $method) {
            $this->$method();
        }
    }


    private function SetIp() {
        $this->ip = $_SERVER['REMOTE_ADDR'];
        return true;
    }
    private function SetBrowser() {
        if (is_array($this->browsers) and count($this->browsers) > 0) {
            foreach ($this->browsers as $key => $val) {
                if (preg_match("|".preg_quote($key).".*?([0-9\.]+)|i", $this->agent, $match)) {
                    $this->isBrowser = true;
                    $this->version = $match[1];
                    $this->browser = $val;
                    $this->browserFullName = $match[0];
                    return true;
                }
            }
        }
        return false;
    }
    private function SetOperatingSystem() {
        if (is_array($this->oss) AND count($this->oss) > 0) {
            foreach ($this->oss as $key => $val) {
                if (preg_match("|".preg_quote($key).".*?([a-zA-Z]?[0-9\.]+)|i", $this->agent, $match)) {
                    $this->os = $val;
                    $this->osVersion = $match[1];
                    return true;
                }
            }
        }
        $this->os = 'Unknown';
    }
    private function SetRobot() {
        if (is_array($this->robots) AND count($this->robots) > 0) {
            foreach ($this->robots as $key => $val) {
                if (preg_match("|".preg_quote($key)."|i", $this->agent)) {
                    $this->isRobot = true;
                    $this->robot = $val;
                    return true;
                }
            }
        }
        return false;
    }
    private function SetMobile() {
        if (is_array($this->mobiles) AND count($this->mobiles) > 0) {
            foreach ($this->mobiles as $key => $val) {
                if (FALSE !== (strpos(strtolower($this->agent), $key))) {
                    $this->isMobile = true;
                    $this->mobile = $val;
                    return true;
                }
            }
        }
        return false;
    }

	#region iVariables Members
	function HaveData()	{
		return true;
	}
	#endregion
}

?>