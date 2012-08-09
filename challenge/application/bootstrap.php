<?php
    // application/Bootstrap.php
    include 'Zend/Loader/Autoloader.php';


	class Bootstrap
	{

	    public static $frontController = null;

	    public static $registry = null;

	    private static $config;

	    //Primary function will be called first from index.php, it will call rest of functions to boot
	    public static function run()
	    {
	        self::prepare();
	    }

	    /*It is used to prepare from macro view.
	    It gives macro view idea about preparation.
	    Sequence of each call is important.
	    */
	    public static function prepare()
	    {
	    	self::setupDateTime();
	        self::setupPath();
	        self::setupErrorReporting();

	        //To load all classes automatically, without include or require statement
	        //Zend_Loader::registerAutoload();

	        self::setupRegistry();
	        self::setupConfiguration();
	        self::setupDatabase();
	        self::setupFrontController();

	    }

	    //Error reporting setting
	    public static function setupErrorReporting()
	    {
	        error_reporting(E_ALL|E_STRICT);
	        ini_set('display_errors', true);
	    }

	    //Path settings will be done using this
	    public static function setupPath()
	    {
	        set_include_path('.' . PATH_SEPARATOR . './library'
            . PATH_SEPARATOR . './application/models/'
            . PATH_SEPARATOR . get_include_path());
	    }

	    //Date time setting will be done here
	    public static function setupDateTime()
	    {
          date_default_timezone_set('UTC');
	    }

	    //Registry setting will be done here.
	    public static function setupRegistry()
	    {
            self::$registry = new Zend_Registry(array(), ArrayObject::ARRAY_AS_PROPS);
	        Zend_Registry::setInstance(self::$registry);
	    }

	    //Configuration file reading & setting up configuration will be done using following.
	    public static function setupConfiguration()
	    {
	        self::$config = new Zend_Config_Ini('./application/configs/config.ini', 'general');
	        self::$registry->configuration = self::$config;
	    }

	    //Important: Setting of front controller will done here.
	    public static function setupFrontController()
	    {
	        self::$frontController = Zend_Controller_Front::getInstance();
            self::$frontController->throwExceptions(false);//false to hidden erros
            self::$frontController->setControllerDirectory('./application/controllers');
	    }
		public function __construct()
		{
		    $loader = Zend_Loader_Autoloader::getInstance();
		    $loader->setFallbackAutoloader(true);
		}
		//Configuration of database
		public static function setupDatabase()
		{
			$db = Zend_Db::factory(self::$config->db->adapter,self::$config->db->config);
			self::$registry->database = $db;
			Zend_Db_Table::setDefaultAdapter($db);
		}

}



?>