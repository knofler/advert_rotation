<?php

include 'db.inc.php';
include 'func.inc.php';

$ads=mysql_query("SELECT `advert_id`,`image` FROM `adverts` WHERE UNIX_TIMESTAMP() < `expires` AND `shown`=0 ORDER BY `advert_id` ASC LIMIT 1");

while($ads_row = mysql_fetch_assoc($ads)){
    
    $advert_id = $ads_row['advert_id'];
    $image=$ads_row['image'];
    createThumbs($image);
    
    echo '<a href="go.php?advert_id='.$advert_id.'" target="_blank"><img src="'.$image.'" /></a>';
    
    mysql_query("UPDATE `adverts` SET `impressions`=`impressions`+1,`shown`=1 WHERE `advert_id`=$advert_id");
    
    
    $shown=mysql_query("Select Count(`advert_id`) FROM `adverts` WHERE `shown`=0");
    
    if(mysql_result($shown,0)==0){
        
        mysql_query("UPDATE `adverts` SET `shown`=0");
    }
    
}
?>