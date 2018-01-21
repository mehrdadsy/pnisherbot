<?php
function tour($text,$chat_id,$username)
{
    $user_id=$chat_id;
    $fifalaw="not";
    $pesLaw="not";


 if($text == '🏆اطلاع از مسابقات' ){
     $db = Db::getInstance();
     $member_t = $db->query("SELECT * FROM tour WHERE user_id=:user_id", array(
         'user_id' => $user_id,
     ));

     if(count($member_t)== 1){

     }
     else{
         $db = Db::getInstance();
         $db->query("INSERT INTO tour (user_id) VALUES ('".$user_id."')");

     }

    MessageRequestJson("sendphoto", array('chat_id' =>$chat_id,'photo'=>"https://mehrdadseyfi.ir/punisherbot/pesfifa.jpg",'caption'=>"مایل اید در کدام مسابقات شرکت کنید؟",'reply_markup' => array(resize_keyboard =>true,

        "keyboard"=>array(

            array('FIFA 18','PES 18'),
            array('منو اصلی')

        )

    )));

}else if($text == 'PES 18' ){


    MessageRequestJson("sendMessage", array('chat_id' =>$chat_id,'text'=>"قوانین را با دقت مطالعه و در پایان موافقت نمایید"."\n".$fifalaw,'reply_markup' => array(resize_keyboard =>true,

        "keyboard"=>array(

            array('با قوانین pes موافقم'),
            array('منو اصلی')

        )

    )));

}else if($text == 'FIFA 18' ){


    MessageRequestJson("sendMessage", array('chat_id' =>$chat_id,'text'=>"قوانین را با دقت مطالعه و در پایان موافقت نمایید"."\n".$pesLaw,'reply_markup' => array(resize_keyboard =>true,

        "keyboard"=>array(

            array('با قوانین فیفا موافقم'),
            array('منو اصلی')

        )

    )));

}else if($text == 'با قوانین pes موافقم' ){
    $pes=1;
    $db = Db::getInstance();
    $db->modify("UPDATE tour SET pes=:pes WHERE user_id=:user_id", array(
        'pes' => 1,
        'user_id' => $user_id,
    ));
    MessageRequestJson("sendMessage", array('chat_id' =>$chat_id,'text'=>"شما با موفقیت ثبت نام شده اید"."\n"."🔴🔵🔴🔵 توجه بفرمایید که ثبت نام شما زمانی قطعی می شود که وجه ورودی را پرداخت نمایید",'reply_markup' => array(resize_keyboard =>true,

        "keyboard"=>array(


            array('منو اصلی')

        )

    )));

}else if($text == 'با قوانین فیفا موافقم' ){
    $fifa=1;
    $db = Db::getInstance();
    $db->modify("UPDATE tour SET fifa=:fifa WHERE user_id=:user_id", array(
        'fifa' => 1,
        'user_id' => $user_id,
    ));
    MessageRequestJson("sendMessage", array('chat_id' =>$chat_id,'text'=>"شما با موفقیت ثبت نام شده اید"."\n"."🔴🔵🔴🔵 توجه بفرمایید که ثبت نام شما زمانی قطعی می شود که وجه ورودی را پرداخت نمایید",'reply_markup' => array(resize_keyboard =>true,

        "keyboard"=>array(


            array('منو اصلی')

        )

    )));

}
}
?>