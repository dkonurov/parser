<?php 
include("header.php");
include("config.php");	

echo '<link rel="stylesheet" type="text/css" href="style.css">';
mysql_set_charset('utf-8');

$query = "SELECT * FROM quotes ORDER BY RAND() LIMIT 50";


$result = mysql_query($query)
        or trigger_error(mysql_errno() . ' ' . 
            mysql_error() . ' query: ' . $sql);

if (mysql_num_rows($result) > 0) {
	while ($row = mysql_fetch_assoc($result)) {
		$id = $row['id'];
		$url = $row['url'];
		$rating = $row['rating'];
		$msg = $row['msg'];
		$date = $row['date'];
	
		echo "<div id='header'>";
		echo "<div id='idef'>$id &nbsp;</div>";
		echo "<div id='rating'>";
		echo "<div class=\"quotes\">";
		echo "<a class='vote' href='#' id=\"$id\" name=\"down\"> - </a>";
		echo "<span class=\"rating$id\">$rating</span>";
		echo "<a class='vote' href='#' id=\"$id\" name=\"up\"> + </a>";
		echo "</div>";
		echo "</div>";
		echo "<div id='link'>$url</div>";
		echo "</div>";
		echo "<div id='content'>";
		echo "$msg";;
		echo "</div>";

echo "<br>";

	}
	}
echo "<a style=\"margin-left:595px;\" href=\"/parser/random.php\">Еще</a>";

?>