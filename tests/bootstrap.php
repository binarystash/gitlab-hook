<?php

//Define constants
define( "PACKAGE_DIRECTORY", dirname( __DIR__ ) );

//Load composer packages
require PACKAGE_DIRECTORY . DIRECTORY_SEPARATOR . "vendor/autoload.php";

//Load project files
$classes = array(
	"class-gitlab-storage.php",
	"class-gitlab-sync.php"
);

foreach( $classes as $class ) {
	require_once PACKAGE_DIRECTORY . DIRECTORY_SEPARATOR . "gitlab-hook" . DIRECTORY_SEPARATOR . $class;
}
