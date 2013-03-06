<?php


//error_reporting(E_ALL);

//ini_set('display_errors', 1);
//ini_set('max_execution_time', 300);

$vkontakteApplicationId = '3424094';
$vkontakteKey ='q81CUbJKVtWq01UG9q0h';
$vkontakteUserId ='39861286';
$token = 'f361fc6b6216f4d09508eda994572a2fc2456e124c1b2e7f34a337f79f34472eafde0ca9dd767f5d1c93e';

include('config.php');
require 'simple_html_dom.php';

function find_key($string){
  $a= "а";
  $key_a  = substr_count($string, $a);
  $o = "о";
  $key_o  = substr_count($string, $o);
  $t = "т";
  $key_t  = substr_count($string, $t);
  $k = "к";
  $key_k  = substr_count($string, $k);

  $key = $key_a.$key_k.$key_t.$key_o;
  return $key;
}

$bashorg = file_get_html('http://bash.im');
$nextjoke = file_get_html('http://nextjoke.net/');

mysql_set_charset('utf-8');
$real[]=0;
$m=0;
$i=0;
foreach($bashorg->find('[class=quote]') as $s){
  $text=nl2br($s->children(1)->plaintext);
  $text = nl2br($s->children(1)->plaintext);
  $text=iconv("cp1251", "utf-8", $text);
  $s->children(0)->children(6)->class="link";
  if (!empty($text)){
  $s->children(0)->children(6)->innertext="bashorg";
  $a=$s->children(0)->children(6);
  $a=str_replace('href="','href="http://bash.im',$a);
  $date = date("Y-m-d");
  $rating = mt_rand(0,10);
  $key = find_key($text);
  $schet=0;
  $k=0;
  $s=mysql_query('SELECT * FROM `quotes`') or die(mysql_error());
   if (mysql_num_rows($s) > 0) {
      while ($row = mysql_fetch_assoc($s)) {
        $k++;
        if ((int)$row['key']!=$key){
          $schet++;
        }
      }
      }
      unset($s);
    if ($schet==$k){ 
  if ($i<3){

  $vktext = str_replace("<br />", "", $vktext);
  $vktext = str_replace("&quot;", "\"", $vktext);
  
  $vktext = urlencode($vktext);
  //$slka = "https://api.vk.com/method/wall.post?owner_id=-49628538&access_token=$token&message=$vktext&from_group=1";

  file_get_contents($slka);
  $i++;
  }
  $text=mysql_real_escape_string($text);
  echo $text;

  $massive = array("url"=>$a,"text"=>$text,"rating"=>$rating,"date"=>$date, "key"=>$key);
  $real[]=$massive;
  $m++;
}
}
}
echo "m=";
echo $m;
echo "<br />";
$m=0;
$i=0;
foreach ($nextjoke->find('[class=joke-cell]') as $e){
  $e->children[0]->innertext="nextjoke";
  $e->children[0]->class="link";
  $a=$e->children[0];
  $a=mysql_real_escape_string($a);
  $text = $e->children[1]->plaintext;
  $date = date("Y-m-d");
  $rating = mt_rand(0,10);
  $key = find_key($text);
  $schet=0;
  $k=0;
  $s=mysql_query('SELECT `key` FROM `quotes`') or die(mysql_error());
   if (mysql_num_rows($s) > 0) {
      while ($row = mysql_fetch_assoc($s)) {
        $k++;
        if ((int)$row['key']!=$key){
          $schet++;
        }
      }
      }
      unset($s);
    if ($schet==$k){ 
    if ($i<3){

      $vktext = iconv('windows-1251', 'UTF-8', $text);
      $vktext = str_replace("<br />", "", $vktext);
      $vktext = str_replace("&quot;", "\"", $vktext);
  
      $vktext = urlencode($vktext);
    //$slka = "https://api.vk.com/method/wall.post?owner_id=-49628538&access_token=$token&message=$vktext&from_group=1";

      file_get_contents($slka);
      $i++;
  }
    $text=mysql_real_escape_string($text);
    $massive = array("url"=>$a,"text"=>$text,"rating"=>$rating,"date"=>$date, "key"=>$key);
    $real[]=$massive;
    $m++;
   
}
}
echo "m1=";
echo $m;
if (count($real)>0){
  shuffle($real);
  for ($i=0;$i<count($real);$i++){
    $a=$real[$i]['url'];
    $text=$real[$i]['text'];
    $rating=$real[$i]['rating'];
    $date=$real[$i]['date'];
    $key = $real[$i]['key'];
    $sql = "INSERT INTO `quotes` (`url`, `msg`, `rating`, `date`,`key`) VALUES ('$a','$text','$rating','$date','$key')";
    $result = mysql_query($sql) or die(mysql_error());
}
}

?>
