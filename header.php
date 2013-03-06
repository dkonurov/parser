<script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script>



<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>
<script type="text/javascript">
 $(function() {
 $(".vote").click(function() 
 {
var id = $(this).attr("id");
var name = $(this).attr("name");
var dataString = 'id='+ id ;
var parent = $(".rating"+id);

if (name=='up')
{
 $.ajax({
 type: "POST",
 url: "up_vote.php",
 data: dataString,
 cache: false,

 success: function(html)
 {
 parent.html(html);
 } 
 });
}ччч
else
{;
 $.ajax({
 type: "POST",
 url: "down_vote.php",
 data: dataString,
 cache: false,

 success: function(html)
 {
 parent.html(html);
 }
 });
}
return false;
});
 });
</script>


<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?
echo "<a style=\"margin-left:375px;;\" href=\"/parser/index.php\">Главная</a>";
echo "<a style=\"margin-left:30px;;\" href=\"/parser/random.php\">Случайные</a>";
echo "<a style=\"margin-left:30px;;\" href=\"/parser/top.php\">Топ</a>";
include("config.php");	
echo '<link rel="stylesheet" type="text/css" href="style.css">';
?>
<form action="search.php">
	<input type="text" name="search">
	<input type="submit">
</form>