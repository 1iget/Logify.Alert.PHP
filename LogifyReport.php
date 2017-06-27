<?php
    require_once('/Interfaces.php');
    require_once('/LogifyExceptions.php');
    require_once('/LogifyException.php');
    require_once('/LogifyApp.php');
    require_once('/Application.php');

    class LogifyReport  implements iData {
        const logifyProtocolVersion = '17.1';
        const devPlatform = 'dotnet';
        const logifyPlatform = 'ASP';

        public $logifyApp;
        public $application;
        public $logifyExceptions;
        
        public function GetDataArray(){
            $result = array(
                'logifyProtocolVersion' => self::logifyProtocolVersion,
                'logifyApp' => $this->logifyApp->GetDataArray(),
                'app' => $this->application->GetDataArray(),
                'exception' => $this->logifyExceptions->GetDataArray(),
                'devPlatform' => self::devPlatform,
                'platform' => self::logifyPlatform,
            );
            return $result;
        }
        public function AddException($e){
            $logifyException = LogifyException::GetInstance($e);
            if(!isset($this->logifyExceptions)){
                $this->logifyExceptions = new LogifyExceptions();
                $this->logifyExceptions->exceptions = array();
            }
            array_push($this->logifyExceptions->exceptions, $logifyException);
        }
    }
//{
//"logifyProtocolVersion": "1.0.29",
//+"logifyApp": { … },
//+"app": { … },
//+"exception": [ … ],
//+"os": { … },
//"vm": { },
//+"debugger": { … },
//+"memory": { … },
//+"installedFrameworks": [ … ],
//"devPlatform": "dotnet",
//"platform": "ASP"
//}

//$GLOBALS
//$_SERVER
//$_GET
//$_POST
//$_FILES
//$_COOKIE
//$_SESSION
//$_REQUEST
//$_ENV


//$_SERVER Array
//(
//    [_FCGI_X_PIPE_] => \\.\pipe\IISFCGI-52d31737-eb92-4488-b4ad-177025aed673
//    [PHP_FCGI_MAX_REQUESTS] => 10000
//    [PHPRC] => C:\Program Files (x86)\iis express\PHP\v5.5
//    [ALLUSERSPROFILE] => C:\ProgramData
//    [ANDROID_NDK_PATH] => C:\Users\Jukov\Documents\Android\ndk\android-ndk-r8d
//    [APPDATA] => C:\Users\Jukov\AppData\Roaming
//    [APP_POOL_CONFIG] => C:\Users\Jukov\Documents\IISExpress\config\applicationhost.config
//    [APP_POOL_ID] => Clr4IntegratedAppPool
//    [CommonProgramFiles] => C:\Program Files (x86)\Common Files
//    [CommonProgramFiles(x86)] => C:\Program Files (x86)\Common Files
//    [CommonProgramW6432] => C:\Program Files\Common Files
//    [COMPUTERNAME] => ZHUKOV-NB-W81
//    [ComSpec] => C:\Windows\system32\cmd.exe
//    [DNX_HOME] => %USERPROFILE%\.dnx
//    [ESET_OPTIONS] =>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
//    [ExpressITSupportNumber] => 038759
//    [FP_NO_HOST_CHECK] => NO
//    [GTK_BASEPATH] => C:\Program Files (x86)\GtkSharp\2.12\
//    [HOMEDRIVE] => C:
//    [HOMEPATH] => \Users\Jukov
//    [IISEXPRESSMODE] => True
//    [IISEXPRESS_SITENAME] => EmptySite3
//    [IIS_BIN] => C:\Program Files (x86)\IIS Express
//    [IIS_DRIVE] => C:
//    [IIS_SITES_HOME] => C:\Users\Jukov\Documents\My Web Sites
//    [IIS_USER_HOME] => C:\Users\Jukov\Documents\IISExpress
//    [JAVA_HOME] => C:\Program Files\Java\jdk1.8.0_31
//    [LOCALAPPDATA] => C:\Users\Jukov\AppData\Local
//    [LOGONSERVER] => \\WDS
//    [NUMBER_OF_PROCESSORS] => 8
//    [OS] => Windows_NT
//    [Path] => C:\Program Files (x86)\iis express\PHP\v5.6;C:\Program Files (x86)\iis express\PHP\v5.5;C:\Program Files (x86)\iis express\PHP\v5.4;C:\ProgramData\Oracle\Java\javapath;C:\Windows\system32;C:\Windows;C:\Windows\System32\Wbem;C:\Windows\System32\WindowsPowerShell\v1.0\;c:\Program Files (x86)\Microsoft SQL Server\100\Tools\Binn\;c:\Program Files\Microsoft SQL Server\100\Tools\Binn\;c:\Program Files\Microsoft SQL Server\100\DTS\Binn\;C:\Program Files (x86)\Microsoft ASP.NET\ASP.NET Web Pages\v1.0\;C:\Program Files\Microsoft SQL Server\110\Tools\Binn\;C:\Program Files (x86)\Microsoft SQL Server\110\Tools\Binn\;C:\Program Files\Microsoft SQL Server\110\DTS\Binn\;C:\Program Files (x86)\Microsoft SQL Server\110\Tools\Binn\ManagementStudio\;C:\Program Files (x86)\Microsoft SQL Server\110\DTS\Binn\;C:\Program Files (x86)\Microsoft Visual Studio 10.0\Common7\IDE\PrivateAssemblies\;C:\Program Files (x86)\WinMerge;C:\Program Files\Microsoft\Web Platform Installer\;C:\Program Files (x86)\Windows Live\Shared;C:\Program File;C:\Program Files (x86)\Skype\Phone\;C:\Users\Jukov\.dnx\runtimes\dnx-clr-win-x86.1.0.0-beta6-12208\bin;C:\Users\Jukov\.dnx\bin;C:\Users\Jukov\AppData\Roaming\npm
//    [PATHEXT] => .COM;.EXE;.BAT;.CMD;.VBS;.VBE;.JS;.JSE;.WSF;.WSH;.MSC
//    [PROCESSOR_ARCHITECTURE] => x86
//    [PROCESSOR_ARCHITEW6432] => AMD64
//    [PROCESSOR_IDENTIFIER] => Intel64 Family 6 Model 58 Stepping 9, GenuineIntel
//    [PROCESSOR_LEVEL] => 6
//    [PROCESSOR_REVISION] => 3a09
//    [ProgramData] => C:\ProgramData
//    [ProgramFiles] => C:\Program Files (x86)
//    [ProgramFiles(x86)] => C:\Program Files (x86)
//    [ProgramW6432] => C:\Program Files
//    [PSModulePath] => C:\Windows\system32\WindowsPowerShell\v1.0\Modules\;C:\Program Files (x86)\Microsoft SQL Server\110\Tools\PowerShell\Modules\
//    [PUBLIC] => C:\Users\Public
//    [SESSIONNAME] => Console
//    [SystemDrive] => C:
//    [SystemRoot] => C:\Windows
//    [TEMP] => C:\Users\Jukov\AppData\Local\Temp
//    [TFS_DIFF_REDIRECT] => Software\Microsoft\WebMatrix
//    [TMP] => C:\Users\Jukov\AppData\Local\Temp
//    [USERDNSDOMAIN] => CORP.DEVEXPRESS.COM
//    [USERDOMAIN] => CORP
//    [USERDOMAIN_ROAMINGPROFILE] => CORP
//    [USERNAME] => jukov
//    [USERPROFILE] => C:\Users\Jukov
//    [VBOX_INSTALL_PATH] => C:\Program Files\Oracle\VirtualBox\
//    [VS100COMNTOOLS] => C:\Program Files (x86)\Microsoft Visual Studio 10.0\Common7\Tools\
//    [VS110COMNTOOLS] => C:\Program Files (x86)\Microsoft Visual Studio 11.0\Common7\Tools\
//    [VS120COMNTOOLS] => C:\Program Files (x86)\Microsoft Visual Studio 12.0\Common7\Tools\
//    [VS140COMNTOOLS] => C:\Program Files (x86)\Microsoft Visual Studio 14.0\Common7\Tools\
//    [WEBMATRIXMODE] => 1
//    [WEBPI_REFERRER] => webmatrix
//    [windir] => C:\Windows
//    [_NT_SYMBOL_PATH] => C:\projects\2014.1\Bin\Framework4; C:\projects\2014.2\Bin\Framework4
//    [ORIG_PATH_INFO] => /index.php
//    [URL] => /index.php
//    [SERVER_SOFTWARE] => Microsoft-IIS/10.0
//    [SERVER_PROTOCOL] => HTTP/1.1
//    [SERVER_PORT_SECURE] => 0
//    [SERVER_PORT] => 63801
//    [SERVER_NAME] => localhost
//    [SCRIPT_NAME] => /index.php
//    [SCRIPT_FILENAME] => C:\Users\Jukov\Documents\My Web Sites\EmptySite3\index.php
//    [REQUEST_URI] => /
//    [REQUEST_METHOD] => POST
//    [REMOTE_USER] => 
//    [REMOTE_PORT] => 52166
//    [REMOTE_HOST] => ::1
//    [REMOTE_ADDR] => ::1
//    [QUERY_STRING] => 
//    [PATH_TRANSLATED] => C:\Users\Jukov\Documents\My Web Sites\EmptySite3\index.php
//    [LOGON_USER] => 
//    [LOCAL_ADDR] => ::1
//    [INSTANCE_META_PATH] => /LM/W3SVC/28
//    [INSTANCE_NAME] => EMPTYSITE3
//    [INSTANCE_ID] => 28
//    [HTTPS_SERVER_SUBJECT] => 
//    [HTTPS_SERVER_ISSUER] => 
//    [HTTPS_SECRETKEYSIZE] => 
//    [HTTPS_KEYSIZE] => 
//    [HTTPS] => off
//    [GATEWAY_INTERFACE] => CGI/1.1
//    [DOCUMENT_ROOT] => C:\Users\Jukov\Documents\My Web Sites\EmptySite3
//    [CONTENT_TYPE] => multipart/form-data; boundary=----WebKitFormBoundary2mPMk8GMkKcXAVMM
//    [CONTENT_LENGTH] => 147
//    [CERT_SUBJECT] => 
//    [CERT_SERIALNUMBER] => 
//    [CERT_ISSUER] => 
//    [CERT_FLAGS] => 
//    [CERT_COOKIE] => 
//    [AUTH_USER] => 
//    [AUTH_PASSWORD] => 
//    [AUTH_TYPE] => 
//    [APPL_PHYSICAL_PATH] => C:\Users\Jukov\Documents\My Web Sites\EmptySite3\
//    [APPL_MD_PATH] => /LM/W3SVC/28/ROOT
//    [WEBSOCKET_VERSION] => 13
//    [IIS_UrlRewriteModule] => 7.1.1735.0
//    [HTTP_X_COMPRESS] => null
//    [HTTP_DNT] => 1
//    [HTTP_UPGRADE_INSECURE_REQUESTS] => 1
//    [HTTP_ORIGIN] => http://localhost:63801
//    [HTTP_USER_AGENT] => Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36
//    [HTTP_REFERER] => http://localhost:63801/
//    [HTTP_HOST] => localhost:63801
//    [HTTP_COOKIE] => toplevel_page_shortcodes-ultimate_last_tab=1; _ym_uid=1486624015416607126; wp-settings-1=hidetb%3D1%26libraryContent%3Dbrowse%26mfold%3Do%26editor%3Dtinymce%26post_dfw%3Doff; wp-settings-time-1=1488386069; wordpress_logged_in_62832e3d255cd219bee74fcb1f26ee44=spreadsheetcloudapi%7C1498728298%7Cp95DsVd2NyPu1NiViUDnpbEXoj1FEdLJso3rCRdnxou%7C40f1790f73343911a75d7d001a52ed245701c6edce2e6c3978febd2b509c35dc; _ga=GA1.1.191650645.1486624015
//    [HTTP_ACCEPT_LANGUAGE] => ru-RU,ru;q=0.8,en-US;q=0.6,en;q=0.4
//    [HTTP_ACCEPT_ENCODING] => gzip, deflate, br
//    [HTTP_ACCEPT] => text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8
//    [HTTP_CONTENT_TYPE] => multipart/form-data; boundary=----WebKitFormBoundary2mPMk8GMkKcXAVMM
//    [HTTP_CONTENT_LENGTH] => 147
//    [HTTP_CONNECTION] => keep-alive
//    [HTTP_CACHE_CONTROL] => max-age=0
//    [FCGI_ROLE] => RESPONDER
//    [PHP_SELF] => /index.php
//    [REQUEST_TIME_FLOAT] => 1498467594.4272
//    [REQUEST_TIME] => 1498467594
//)

?>