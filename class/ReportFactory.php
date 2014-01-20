<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 14-1-18
 * Time: 下午2:42
 */

include_once "ReportTypeView.php";
include_once "ReportUserView.php";

class ReportFactory
{
    public static function CreateUser($account_id,$cid) {
        switch ($cid) {
            case 0:
                return new TransparentProxy($account_id,$cid);
                break;
            case 1:
            case 2:
            case 3:
            case 4:
                return new Proxy($account_id,$cid);
                break;
            case 5:
                return new Memenber($account_id,$cid);
                break;
        }
    }

    public static function CreateUserView($user_obj) {
        switch ($user_obj->cid) {
            case 0:
                //TODO:recheck for detail
                return new DLView($user_obj);
                break;
            case 1:
            case 2:
            case 3:
                return new FGSView($user_obj);
                break;
            case 4:
                return new DLView($user_obj);
                break;
            case 5:
                return new HYView($user_obj);
                break;
        }


    }

    public static function CreateType($type='all',$user) {
        if ($type == 'all') {
            return new MultiGameType($type,$user);
        } else {
            return GameType::$type_list[$type]==1 ?
                new SingleGameType($type,$user)
                : new MultiGameType($type,$user);
        }
    }

    public static function CreateTypeView($type_obj) {


        return ;
    }


} 