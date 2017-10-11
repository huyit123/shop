<?php

class FcHelper
{

    public static function Alertmessage($errors)
    {
        if ($errors->any()) {
            return '<ul style="padding: 0px;">' . implode('', $errors->all('<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">x</a><strong>Error! <strong>:message</div>')) . '</ul>';
        }
        if (Session::has('success')) {
            $msg = Session::get('success');
            return '<div class="alert fadeout_alert alert-success alert-icon"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> ' . $msg . ' <i class="icon"></i> </div>';
        } else if (Session::has('warning')) {
            $msg = Session::get('warning');
            return '<div class="alert fadeout_alert alert-warning alert-icon"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' . $msg . ' <i class="icon"></i> </div>';
        }
        return '';
    }
    public static function Alertmessage_frontend($errors)
    {
        if ($errors->any()) {
            return '<ul style="padding: 0px;">' . implode('', $errors->all('<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">x</a>:message</div>')) . '</ul>';
        }
        if (Session::has('success')) {
            $msg = Session::get('success');
            return '<div class="alert fadeout_alert alert-success alert-icon"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> ' . $msg . ' </div>';
        } else if (Session::has('warning')) {
            $msg = Session::get('warning');
            return '<div class="alert fadeout_alert alert-warning alert-icon"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' . $msg . '</div>';
        }
        return '';
    }
    public static function aliasUrl($str)
    {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
        $str = preg_replace("/( )/", '-', $str);
        $str = preg_replace("/(-+-)/", '-', $str);
        return $str;
    }
    public static function formatprice($price)
    {
        return number_format($price,0,',','.').' đ';
    }
    public static function getAvailableCode($event,$id)
    {
        $code = $event."-" . strtoupper(self::gen_uuid(6));
        if (self::checkCodeExists($code, $id)) {
            $code = self::getAvailableCode($id);
        }
        return $code;
    }
    public static function gen_uuid($len = 8)
    {
        $hex = md5("yourSaltHere" . uniqid("", true));
        $pack = pack('H*', $hex);
        $tmp = base64_encode($pack);
        $uid = preg_replace("#(*UTF8)[^A-Za-z0-9]#", "", $tmp);
        $len = max(4, min(128, $len));
        while (strlen($uid) < $len)
            $uid .= gen_uuid(22);
        return substr($uid, 0, $len);
    }
    private static function checkCodeExists($code, $id)
    {
        return Discountcode::where('code', '=', $code)->where('discountid', '=', $id)->exists();
    }
    public static function getMailBooking()
    {
        $config = Configdat::where('type','event')->first();
        $config = array(
            'driver' => 'smtp',
            'host' => 'smtp.gmail.com',
            'port' => '587',
            'from' => array('address' => $config->email, 'name' => $config->title),

            'encryption' => 'tls',
            'username' => $config->email,
            'password' => $config->password,
            'sendmail' => '/usr/sbin/sendmail -bs',
            'pretend' => false
        );
        return $config;
    }

    public static function ConfigMail()
    {
        $config = self::getMailBooking();
        Config::set('mail', $config);
    }
}

?>