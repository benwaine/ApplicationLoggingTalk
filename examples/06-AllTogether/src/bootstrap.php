<?php
$start = microtime(true);
require_once __DIR__.'/../../../vendor/autoload.php';
require_once __DIR__.'/Logger.php';

use Silex\Provider\TwigServiceProvider;
use Silex\Provider\DoctrineServiceProvider;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;

$env = getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production';
$ini_config = parse_ini_file(__DIR__.'/config.ini', TRUE);
$config = $ini_config[$env];

$app = new Silex\Application();

$app['debug'] = true;

$app->register(new TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/templates',
    'twig.options' => array('cache' => __DIR__.'/../cache'),
));

$app->register(new DoctrineServiceProvider);


// Silex itself has an integrated DI container. 
// However for brevity lets reuse the container from the previous examples. 
$container = new ContainerBuilder;
$loader = new YamlFileLoader($container, new FileLocator(__DIR__));
$loader->load("services.yml");

$app['log'] = $container->get('logger');
$app['reqStart'] = $start;

return $app;