<?php
namespace QCloud_WeApp_SDK\Model;

use QCloud_WeApp_SDK\Mysql\Mysql as DB;
use QCloud_WeApp_SDK\Constants;
use \Exception;

class User
{
    public static function storeUserInfo ($userinfo, $skey, $session_key) {
        $uuid = bin2hex(openssl_random_pseudo_bytes(16));
        $create_time = date('Y-m-d H:i:s');
        $last_visit_time = $create_time;
        $open_id = $userinfo->openId;
        $user_info = json_encode($userinfo);

        $user_name=$userinfo->openId;
        $reg_time=time();

        $res = DB::row('cSessionInfo', ['*'], compact('open_id'));
        if ($res === NULL) {
            $user_id=DB::insertid('user', compact('user_name', 'reg_time'));
            $user_id=$user_id[0]->user_id;
            DB::insert('cSessionInfo', compact('user_id','uuid', 'skey', 'create_time', 'last_visit_time', 'open_id', 'session_key', 'user_info'));
            return $user_id;
        } else {
            DB::update(
                'cSessionInfo',
                compact('uuid', 'skey', 'last_visit_time', 'session_key', 'user_info'),
                compact('open_id')
            );
            return User::findUserBySKey($skey)->user_id;
        }
    }

    public static function findUserBySKey ($skey) {
        return DB::row('cSessionInfo', ['*'], compact('skey'));
    }
}
