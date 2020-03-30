<?php
require_once INCLUDE_DIR . 'class.plugin.php';
//require_once INCLUDE_DIR . 'class.signal.php';
require_once INCLUDE_DIR . 'class.app.php';
//require_once INCLUDE_DIR . 'class.dispatcher.php';
//require_once INCLUDE_DIR . 'class.dynamic_forms.php';
//require_once INCLUDE_DIR . 'class.osticket.php';

require_once 'config.php';

define('FileDrive_PLUGIN_VERSION', '0.1');
define('FileDrive_TABLE', TABLE_PREFIX . 'equipment');
define('FileDrive_CLIENTINC_DIR', FileDrive_INCLUDE_DIR . 'client/');

class FileDrive extends Plugin
{

    public $config_class = 'FileDriveConfig'; // Tell the plugin system how to find our config

    public function bootstrap()
    {
        //    echo "<script></script>";
        if ($this->firstRun()) {
            if (!$this->configureFirstRun()) {
                return false;
            }
        } else if ($this->needUpgrade()) {
            $this->configureUpgrade();
        }

        $config = $this->getConfig();

        if ($config->get('FileDrive_Admin_enable')) {
            $this->createAdminMenu();
        }
        if ($config->get('FileDrive_Staff_enable')) {
            $this->createStaffMenu();
        }
        if ($config->get('FileDrive_Client_enable')) {
            $this->createclientMenu();
        }


        //This will run after everything else, empties the buffer and runs our code over the HTML
        //Then we send it to the browser as though nothing changed..
         if($config->get('FileDrive_guest_enable')){
             register_shutdown_function(
                function () {
                    FileDrive::shutdownHandler();
            });
         }

    }

    /**
     * Wrapper around register_shutdown_function to avoid making $this calls from
     * anonymous functions.. Hopefully the Singleton factory pattern works
     * properly..
     */
    public static function shutdownHandler()
    {
        if (preg_match("/\bscp\b/", $_SERVER["REQUEST_URI"])) {
           return;
        }
        

        $page = ob_get_clean();
        $page = $page . " <script>
							var str = document.getElementById(\"nav\").innerHTML;
	 						var newstr =  \"Home</a></li><li><a "
            				."style=\\\"background-image:url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAAEnMAABJzAYwiuQcAAAGgSURBVDhPpVI9TwJBEJ3bO4+EBEyURDkM/wELkVpttMAGC/kddGBIsKLESn8DIQEqSmw0akeUHgyEBBJJPL5h3BlPwC+M+pJ3Nzs7b2Z2ZxVEhP9AWP+/gzp4Yyx2Qu0sZPg4LENnmqmRz+dR15aw/dTGy2IRH6tVrFQqWC6X8eH+ntloNFBXNTxNJKTkQ4K9nV3cMDy0wZVsNhsWCgVez2PT50P32jqZ7xOQ6DAYpA2MRCKchCiEwFwux35CLBplv8TnBHSMecTj8WkiYqlUwlqtxnY2m6UQacnPwf4+rq6skONLJJNJFqXTaV77t/xouN1kAr8DRVEwsB2A0FEIzGdTxs6gqio4nQ7JZWi1mjAajeDq+hoymQwVl0orgaoIGOPEki0GPR6KvLg4B3GWSlF7MJqMp/fxkYPBAORI2W42m7IQgpwE3N7cgVA1jfTfol6vg67r4PV6weFwgMvl4mPI6YAmtT8+ZapKsNvt3AmJiHKD/aLX7bHxHQzD4CSmaUK/34fhcMj+Tq8L3U7ntYLHbfCYfkPB92+N8e8AeAG4Mn7bHv/bxAAAAABJRU5ErkJggg==');\\\""
            			    . "href=\\\"".
                            ROOT_PATH
                            ."fd/FileDrive.php\\\">FileDrive</a></li>\";
 							var res = str.replace(\"Support Center Home</a></li>\", newstr	);
 							document.getElementById(\"nav\").innerHTML = res;
    						</script>  ";
        print $page;


    }

    /**
     * Creates menu links in the Admin backend.
     */
    public function createAdminMenu()
    {
        Application::registerAdminApp('FileDrive', ROOT_PATH."fd/", array(
            iconclass => 'logs',
        ));
        Application::registerAdminApp('FileDrive - Embebed', ROOT_PATH."fd/FileDrive.php?p=", array(
            iconclass => 'faq-categories ',
        ));
    }

    /**
     * Creates menu links in the staff backend.
     */
    public function createStaffMenu()
    {
       /* Application::registerStaffApp('FileDrive', ROOT_PATH."fd/", array(
            iconclass => 'logs',
        ));*/
        Application::registerStaffApp('FileDrive - Embebed', ROOT_PATH."fd/FileDrive.php", array(
            iconclass => 'faq-categories',
        ));
    }

    /**
     * Creates menu link in the client frontend.
     * Useless as of OSTicket version 1.9.2.
     */
    public function createClientMenu()
    {
       /* Application::registerClientApp('FileDrive',ROOT_PATH.'fd/', array(
            iconclass => 'logs',
        ));*/
        Application::registerClientApp('FileDrive - Embebed', ROOT_PATH."fd/FileDrive.php", array(
            iconclass => 'faq-categories',
        ));
    }

    /**
     * Checks if this is the first run of our plugin.
     *
     * @return boolean
     */
    public function firstRun()
    {
       return ((!file_exists(ROOT_DIR."fd/index.php"))==1);
    }
    public function needUpgrade()
    {

        return false;
    }
    public function configureUpgrade()
    {

    }

    /**
     * Necessary functionality to configure first run of the application
     */
    public function configureFirstRun()
    {

        // if (!file_exists(ROOT_DIR."fd/index.php")){
        //         die("<br>FD Dir do not exist<br>");
        // }

        //echo "____--___".dirname(__DIR__)."/FileDrive/_copy_to_root/fd/index.php"."____--____";
        
        if (!file_exists(dirname(__DIR__)."/FileDrive/_copy_to_root/fd/index.php")){
                    die("<br>Get techinical help from plugin Supplier \" FileDrive \"<br>");
         }
         $page = ob_get_clean();
         echo "<br> Setting up first use of plugin FileDrive<br>";
         echo " reload this page if see this<br><br>";
         
         $this->recurse_copy(dirname(__DIR__)."/FileDrive/_copy_to_root/fd/",ROOT_DIR."fd/");
         
         header("Location: ".ROOT_DIR."fd/index.php"); 
         exit(); 
        
        
        return true;
    }

   /**
     * copy root files to OSticket root
     */
    function recurse_copy($src,$dst) { 
        $dir = opendir($src); 
        @mkdir($dst); 
        while(false !== ( $file = readdir($dir)) ) { 
            if (( $file != '.' ) && ( $file != '..' )) { 
                if ( is_dir($src . '/' . $file) ) { 
                    $this->recurse_copy($src . '/' . $file,$dst . '/' . $file); 
                } 
                else { 
                    copy($src . '/' . $file,$dst . '/' . $file); 
                } 
            } 
        } 
        closedir($dir); 
    } 
    /**
     * Kicks off database installation scripts
     *
     * @return boolean
     */
    public function createDBTables()
    {

    }

    /**
     * Uninstall hook.
     *
     * @param type $errors
     * @return boolean
     */
    public function pre_uninstall(&$errors)
    {

    }
}
