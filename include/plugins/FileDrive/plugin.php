<?php


set_include_path(get_include_path().PATH_SEPARATOR.dirname(__file__).'/include');
return array(
 'akshay:FileDrive', # notrans
 'version' => '0.1',
 'name' => 'File Drive',
 'author' => 'akshay.nikhare@live.com',
 'description' => 'Add File sharing and cloud share functionalty to osticket.',
 'url' => 'https://github.com/akshaynikhare/',
 'plugin' => 'class.FileDrive.php:FileDrive'
); 

?>

