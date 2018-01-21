<?php
require_once('core.php');
require_once('db.php');
require_once('sing_up.php');
require_once('rezerv.php');
require_once('addres.php');
require_once('tour.php');





$content = file_get_contents("php://input");
$update = json_decode($content, true);
$chat_id = $update["message"]['chat']['id'];
$text = $update["message"]['text'];
$username=$update["message"]['chat']["username"];
$user_id=$chat_id;
$db = Db::getInstance();


/////
////anger con db
////
//////////////
/// ////////////
/// //////////////main page
/// ////////////////
///
///

///
///
sign_up($text,$chat_id,$username);
rezerv($text,$chat_id,$username);
addres($text,$chat_id);
tour($text,$chat_id,$username);
//give file id json
//$res =MessageRequestJson("getChatMember", array('chat_id' =>'@coaches21','user_id'=>$chat_id));
//
//$res = json_decode($res, true);
//
//$member_result = $res['ok'];
//
//$member_status = $res['result']['status'];
if($text=="/start"||$text=="منو اصلی") {
    $db = Db::getInstance();
    $member = $db->query("SELECT * FROM sabtenam WHERE user_id=:user_id", array(
        'user_id' => $chat_id
    ));
    if ($member[0]['comp'] == 1) {
    $start = "از بین گزینه های زیر یک گزینه را انتخاب نمایید";
    MessageRequestJson("sendMessage", array('chat_id' => $chat_id, 'text' => $start, 'reply_markup' => array(resize_keyboard => true,


        "keyboard" => array(

            array('🏆اطلاع از مسابقات', 'کد معرف من'),
            array('امتیازات شما', 'رزرو میز'),
            array('ساعت کاری امروز ما'),
            array('📡آدرس  ما')

        )

    )));

    } else{
        MessageRequestJson("sendMessage", array('chat_id' =>$chat_id,'text'=>"شما در Punisher club  ثبت نام نکرده اید.برای استفاده از مزایا و تخفیفات ویژه اعضا ربات لطفا ابتدا فرم ثبت نام را پر کنید",'reply_markup' => array(resize_keyboard =>true,

            "keyboard"=>array(

                array('ثبت نام','منو اصلی'),


            )

        )));
    }
}
else if($text == 'ساعت کاری امروز ما' ){
  $db = Db::getInstance();
    $member_t = $db->query("SELECT * FROM time");
$time_up=$member_t[0]['time'];
$time_down=$member_t[0]['time_down'];

	     MessageRequestJson("sendphoto", array('chat_id' =>$chat_id,'photo'=>"https://mehrdadseyfi.ir/punisherbot/open.png",'caption'=>"ساعت کاری امروز ما"."\n"."$time_up"."\n"."تا"."\n"."$time_down",'reply_markup' => array(resize_keyboard =>true,

            "keyboard"=>array(

                array('منو اصلی')

            )

        )));


    }
?>