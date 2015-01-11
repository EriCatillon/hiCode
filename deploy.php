<?php
// example simple to deploy your website local (project dev)

// structure du site, voir sur le site GitHub Laravel

/* www/
	app/
	public/
	...
	deploy.php <- script de deploiement
	config.php <- username password dbname return ['username'=>'root', 'password'=>'', 'dbname'=>'lycee'];
Pas de dossier vendor
*/

echo " -- deploy yes or no ? -- ";

$response = fgets(STDIN);

if($response == 'no' || !file_exists(__DIR__.'/config.php'))
{
	echo "-- config.php doesn't exists or your response is no" ."\n";
	exit;
}

$config=require_once __DIR__.'/config.php';

$link = mysqli_connect('localhost', $config['username'], $config['password']) or 
die("check user and password to connect local database");

// create database
$link->query("
        DROP DATABASE IF EXISTS `{$config['username']}`;
        ") or die("drop database impossible");

$link->query("
        CREATE DATABASE IF NOT EXISTS `elycee` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;"
        ) or die("pb create database elycee");

echo "-- database created, now install Laravel and migrations-- ";

echo " -- install Laravel -- ";

if(!file_exists(__DIR__.'/composer.json')){
	exit("I can't access composer.json");
}

exec('composer install --no-scripts');

// exec('chmod -R 777 app/storage');

echo " -- migration -- ";

exec('php artisan migrate --seed');
