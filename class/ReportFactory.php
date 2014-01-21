<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 14-1-18
 * Time: 下午2:42
 */
include_once ROOT_PATH ."Class/ReportUser.php";

class ReportFactory
{
    public static function CreateUser($account_id,$cid,$parent,$name='',$nid='') {
        switch ($cid) {
            case 0:
                return new TransparentReportProxy($account_id,$name,$nid,$parent);
                break;
            case 1:
            case 2:
            case 3:
            case 4:
                return new ReportProxy($account_id,$cid,$parent);
                break;
            case 5:
                return new ReportMember($account_id,$parent);
                break;
        }
    }

//    public static function CreateUserView($user_obj) {
//        switch ($user_obj->cid) {
//            case 0:
//                //TODO:recheck for detail
//                return new DLView($user_obj);
//                break;
//            case 1:
//            case 2:
//            case 3:
//                return new FGSView($user_obj);
//                break;
//            case 4:
//                return new DLView($user_obj);
//                break;
//            case 5:
//                return new HYView($user_obj);
//                break;
//        }
//
//
//    }
//
//    public static function CreateType($type='all',$user) {
//        if ($type == 'all') {
//            return new MultiGameType($type,$user);
//        } else {
//            return GameType::$type_list[$type]==1 ?
//                new SingleGameType($type,$user)
//                : new MultiGameType($type,$user);
//        }
//    }
//
//    public static function CreateTypeView($type_obj) {
//
//
//        return ;
//    }


} 