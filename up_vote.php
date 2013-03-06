<?php include("config.php"); 
 $ip=$_SERVER['REMOTE_ADDR'];
if($_POST['id']) { $id=$_POST['id'];
$id = mysql_escape_String($id); //Проверяем есть ли  IP-адрес того кто голосует в таблице Voting_IP, если есть,то выводим сообщение"Вы уже голосовали!".
$ip_sql=mysql_query("select ip_add from Voting_IP where mes_id_fk='$id' and ip_add='$ip'"); 
$count=mysql_num_rows($ip_sql);
if($count==0) { 
// Обновляем рейтинг. 
$sql = "update quotes set rating=rating+1 where id='$id'";
mysql_query( $sql); // Вставляем IP-адрес и идентификатор сообщения в таблицу Voting_IP . 
$sql_in = "insert into Voting_IP (mes_id_fk,ip_add) values ('$id','$ip')";
mysql_query( $sql_in);}
//echo "<script>alert('Спасибо за ваш гоглос!'); </script>"; 
//else  { echo "<script>alert('Вы уже голосовали!'); </script>";  } 
$result=mysql_query("select rating from quotes where id='$id'"); 
$row=mysql_fetch_array($result);  
$rating=$row['rating'];
echo $rating;} ?>