<?php

include 'adverts/db.inc.php';

if(isset($_GET['advert_id'])){
    
    $advert_id=(int)$_GET['advert_id'];
    
    mysql_query("UPDATE `adverts` SET `clicks`=`clicks`+1 WHERE `advert_id`=$advert_id");
    
    $url_query=mysql_query("SELECT `url` FROM `adverts` where `advert_id`=$advert_id");
    $url=mysql_result($url_query,0,'url');
    header('location: '.$url);
    die();
}

?>