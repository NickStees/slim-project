<?php
// DIC configuration

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    $view = new \Slim\Views\Twig($settings['template_path'], [
        'cache' => $settings['cache_path']
    ]);

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $c['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($c['router'], $basePath));

    return $view;
};

// database connection_status PDO version
$container['db'] = function ($c) {
  $db = $c->get('settings')['db'];
  $pdo = new PDO("mysql:host=" . $db['host'] . ";dbname=" . $db['database'],
      $db['user'], $db['pass']);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  return $pdo;
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], Monolog\Logger::DEBUG));
    return $logger;
};


// 	Create a capsule to use Eloquent.
// $container['db'] = function ($container) {
// 	$capsule = new \Illuminate\Database\Capsule\Manager;
//   $settings = $container->get('settings')['db'];
// 	$capsule->addConnection([
// 		'driver' 	        =>	$settings['driver'],
// 		'host'		=>	$settings['host'],
// 		'database' 	=>	$settings['database'],
//  		'username' 	=> 	$settings['user'],
// 		'password' 	=>	$settings['pass'],
// 		'charset'	        =>	$settings['charset'],
// 		'collation'	        =>	$settings['collation'],
// 		'prefix'	        =>	$settings['prefix']
// 	 ]);
// 	 $capsule->bootEloquent();
// 	 return $capsule;
// };

//	Inject our user model into the container.
$container['user'] = function ($container) {
	return new \app\common\user\user;
};

//	 Create our hashing helper.
$container['hash'] = function ($container) {
	return new \app\common\helpers\hash($container->get('settings')['app_hash']);
};

//	Create our validation helper.
$container['validation'] = function ($container) {
	return new \app\common\validation\validator($container->user);
};

//	Create an auth object in the container and initially set it to false.
//	We'll set it to match the user's model when they log in or if they have
//	persistent login enabled.
$container['auth'] = function ($container) {
	return false;
};

//	Inject our mail feature into the container. Using PHPMailer for now.
$container['mailer'] = function ($container) {
	$mailer = new PHPMailer;
  $settings = $container->get('settings')['mail'];

	$mailer->Host = $settings['host'];
	$mailer->SMTPAuth = $settings['smtp_auth'];
	$mailer->SMTPSecure = $settings['smtp_secure'];
	$mailer->Port = $settings['port'];
	$mailer->Username = $settings['username'];
	$mailer->Password = $settings['password'];
	$mailer->SMTPDebug = 1;
	$mailer->isHTML($settings['html']);

	return new \app\common\mail\mailer($container->view, $mailer);
};

//	Add our helper for generating random strings.
$container['randomlib'] = function ($container) {
	$factory = new \RandomLib\Factory;
	return $factory->getMediumStrengthGenerator();
};
