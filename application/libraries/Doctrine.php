<?php
use Doctrine\Common\ClassLoader,
    Doctrine\ORM\Configuration,
    Doctrine\ORM\EntityManager,
    Doctrine\Common\Cache\ArrayCache,
    Doctrine\DBAL\Logging\EchoSQLLogger,
    Doctrine\Common\Annotations\AnnotationReader,
    Doctrine\Common\Annotations\AnnotationRegistry;

class Doctrine {

    public $em = null;

    public function __construct()
    {
        // load database configuration from CodeIgniter
        require_once APPPATH.'config/database.php';

        //A Doctrine Autoloader is needed to load the models
        $entitiesClassLoader = new ClassLoader('Entities', APPPATH."models");
        $entitiesClassLoader->register();

        // Set up caches
        $config = new Configuration;
        $cache = new ArrayCache;
        $config->setMetadataCacheImpl($cache);
        //$driverImpl = $config->newDefaultAnnotationDriver(array(APPPATH.'models/Entities'));
        
        AnnotationRegistry::registerFile(APPPATH . "/vendor/doctrine/orm/lib/Doctrine/ORM/Mapping/Driver/DoctrineAnnotations.php");
        $reader = new AnnotationReader();
        $driverImpl = new \Doctrine\ORM\Mapping\Driver\AnnotationDriver($reader, array(APPPATH.'models/Entities'));

        $config->setMetadataDriverImpl($driverImpl);
        $config->setQueryCacheImpl($cache);

        $config->setQueryCacheImpl($cache);

        // Proxy configuration
        $config->setProxyDir(APPPATH.'/models/proxies');
        $config->setProxyNamespace('Proxies');

        // Set up logger
        $logger = new EchoSQLLogger;
        $config->setSQLLogger($logger);

        $config->setAutoGenerateProxyClasses( TRUE );

        // Database connection information
        $connectionOptions = array(
            'driver' => 'pdo_mysql',
            'user' =>     $db['default']['username'],
            'password' => $db['default']['password'],
            'host' =>     $db['default']['hostname'],
            'dbname' =>   $db['default']['database']
        );

        // Create EntityManager
        $this->em = EntityManager::create($connectionOptions, $config);
    }
}