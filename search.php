<?php
error_reporting(E_ALL);

ini_set('display_errors', 1);
if ($_GET['search']){
$search=(int)$_GET['search'];
$query ="SELECT * FROM quotes WHERE (locate($search,id)>0)";
$result = mysql_query($query);
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
/*echo "<a style=\"margin-left:600px;text-decoration:none;\" href=\"/parser/index.php?page=$prevpage\"><</a>";
echo " "; echo $currpage; echo " ";
echo "<a style=\"text-decoration:none;\" href=\"/parser/index.php?page=$nextpage\">></a>";*/
}
?>