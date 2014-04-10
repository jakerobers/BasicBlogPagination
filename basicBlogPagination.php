<?php
error_reporting(E_ALL);

function loadText() {
	$filename = 'posts/' . $_GET["page"] . '.txt';
	try {
		$file = fopen($filename, "r");
	} catch(Exception $e) {
		throw new Exception($e);
	}
	if($file) {
		while(!(feof($file))) {
			$line = fgets($file);
			echo $line;
		}
		fclose($file);
	}
	else {
		echo "<h1>FILE NOT FOUND</h1>";
	}
}

function loadPagination() {
	$entryCount = numberOfPages();
	if($_GET["page"] > 1) {
		echo '<a href="blog.php?page=' . ($_GET["page"] - 1) . '"><img src="images/leftArrow.png"></a>';
	}
	else {
		echo '<img src="images/leftArrow.png">';
	}
	echo ' &nbsp &nbsp ' . $_GET["page"] . ' &nbsp &nbsp ';
	if($_GET["page"] < $entryCount) {
		echo '<a href="blog.php?page=' . ($_GET["page"] + 1) . '"><img src="images/rightArrow.png"></a>';
	}
	else {
		echo '<img src="images/rightArrow.png">';
	}
}

function numberOfPages() {
	$entryCount = 0;
	$dir = opendir('posts');
	if($dir) {
		while(false !== ($entry = readdir($dir))) {
			if ($entry != "." && $entry != "..") {
				$entryCount++;
			}
		}
	}
	return $entryCount;
}
?>