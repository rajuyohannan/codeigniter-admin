<?php
/**
 * CLI Config file for the Doctrine2 CLI.
 */

//Do the bootstrap manually
define('APPPATH', dirname(__FILE__) . '/application/');
define('BASEPATH', APPPATH . '/../system/');
define('ENVIRONMENT', 'development');
require APPPATH . 'vendor/autoload.php';
require APPPATH . '/libraries/Doctrine.php';

$doctrine = new Doctrine();
$entityManager = $doctrine->em;

$entityManager->getConnection()->getDatabasePlatform()->registerDoctrineTypeMapping('set', 'string');
$entityManager->getConnection()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');

$driver = new \Doctrine\ORM\Mapping\Driver\DatabaseDriver(
                $entityManager->getConnection()->getSchemaManager()
);


$entityManager->getConfiguration()->setMetadataDriverImpl($driver);
$cmf = new \Doctrine\ORM\Tools\DisconnectedClassMetadataFactory($em);
$cmf->setEntityManager($entityManager);
$classes = $driver->getAllClassNames();
$metadata = $cmf->getAllMetadata();
$generator = new Doctrine\ORM\Tools\EntityGenerator();

$generator->setUpdateEntityIfExists(false);
$generator->setGenerateStubMethods(true);
$generator->setGenerateAnnotations(true);

$generator->generate($metadata, APPPATH . 'models/Entity');
