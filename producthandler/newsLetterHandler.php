<?php

class NewsLetterHandler {
    function getNewsLetter($user_id){
    return resultAssociate("select * from nfw_news_letters as nnl join nfw_news_letter_box as nlb on nlb.news_letter_id=nnl.id  where nlb.receiver_id='$user_id' and nlb.flag in (0,1)");
    }
function countNewsLetter($user_id,$status){
    return resultAssociate("select * from nfw_news_letters as nnl join nfw_news_letter_box as nlb on nlb.news_letter_id=nnl.id  where nlb.receiver_id='$user_id' and nlb.flag in ($status)");
}
function changeNewsLetterStatus($id,$status){
    mysql_query("update nfw_news_letter_box set flag=$status where id=$id");
    return resultAssociate("select * from nfw_news_letters as nnl join nfw_news_letter_box as nlb on nlb.news_letter_id=nnl.id  where nlb.id='$id'");
    
}
}
?>
