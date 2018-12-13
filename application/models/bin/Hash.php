<?php

class Hash {

    /**
     *
     * @param string $algorithm The algorithm (md5, sha1, whirlpool, etc)
     * @param string $data The data to encode
     * @param string $salt The salt (This should be the same throughout the system probably)
     * @return string The hashed/salted data
     */
    public static function create($algorithm, $data, $salt) {

        $context = hash_init($algorithm, HASH_HMAC, $salt);
        hash_update($context, $data);

        return hash_final($context);
    }

    public static function whirlpool($data) {
        return Hash::create("whirlpool", $data, true);
    }

    public static function md5($data) {
        return Hash::create("md5", $data, true);
    }

    public static function sha1($data) {
        return Hash::create("sha1", $data, true);
    }

    public static function getDateForView() {
        date_default_timezone_set("America/Bogota");
        return date("d/m/Y h:i A");
    }

    public static function getTimeStamp($date) {
        date_default_timezone_set("America/Bogota");
        $date = date_create($date);
        $date = date_format($date, "Y-m-d H:i:s");
        return strtotime($date) * 1000;
    }

    public static function getTime() {
        date_default_timezone_set("America/Bogota");
        $date = Hash::getDate();
        $date = date_create($date);
        $date = date_format($date, "Y-m-d H:i:s");
        return strtotime($date);
    }

    public static function timeStampToDate($timestamp) {
        $date = Hash::getTimeStamp(Hash::getDate());
        return date("Y-m-d H:i:s", $timestamp / 1000);
    }

    public static function getDate() {
        date_default_timezone_set("America/Bogota");
        return date("Y-m-d H:i:s");
    }

    public static function getDateForTrackFromDate($date, $track) {
        $timer = new TimerGlobal();
        $date = new Date($date);
        $limit = 18; //Hasta las 10:00 pm.
//        switch ($track) {
//            case TimerGlobal::NOTY:
//                $limit = 22;
//                break;
//            case TimerGlobal::TRACK:
//                $limit = 18;
//                break;
//        }
        if ($date->hour >= $limit) {
            if ($date->hour > $limit) {
                $date->hour = 6;
                $date->minute = 0;
                $date->secound = 0;
                //Se pasa para el siguiente día...
                $date->day++;
            }
        } else if ($date->hour < 6) {
            $date->hour = 6;
            $date->minute = 0;
            $date->secound = 0;
        }
        return $date->getDate();
    }

    public static function getDateForTrack($track = "NOTY") {
        $timer = new TimerGlobal();
        $date = new Date(Hash::getDate());
        $limit = 18; //Hasta las 10:00 pm.
        switch ($track) {
            case TimerGlobal::NOTY:
                $limit = 22;
                break;
            case TimerGlobal::TRACK:
                $limit = 18;
                break;
        }
        if ($date->hour >= $limit) {
            if ($date->hour > $limit) {
                $date->hour = 6;
                $date->minute = 0;
                $date->secound = 0;
                //Se pasa para el siguiente día...
                $date->day++;
            }
        } else if ($date->hour < 6) {
            $date->hour = 6;
            $date->minute = 0;
            $date->secound = 0;
        }
        return $date->getDate();
    }

    public static function addMinutes($date, $minutes) {
        $nuevafecha = strtotime('+' . $minutes . ' minute', strtotime($date));
        $nuevafecha = date('Y-m-d H:i:s', $nuevafecha);
        return $nuevafecha;
    }

    public static function subtractMinutes($date, $hours) {
        $nuevafecha = strtotime('-' . $minutes . ' minute', strtotime($date));
        $nuevafecha = date('Y-m-d H:i:s', $nuevafecha);
        return $nuevafecha;
    }

    public static function addHours($date, $hours) {
        $nuevafecha = strtotime('+' . $hours . ' hour', strtotime($date));
        $nuevafecha = date('Y-m-d H:i:s', $nuevafecha);
        return $nuevafecha;
    }

    public static function subtractHours($date, $hours) {
        $nuevafecha = strtotime('-' . $hours . ' hour', strtotime($date));
        $nuevafecha = date('Y-m-d H:i:s', $nuevafecha);
        return $nuevafecha;
    }

    public static function addDay($date, $day) {
        $nuevafecha = strtotime('+' . $day . ' day', strtotime($date));
        $nuevafecha = date('Y-m-d H:i:s', $nuevafecha);
        return $nuevafecha;
    }

    public static function subtractDay($date, $day) {
        $nuevafecha = strtotime('-' . $day . ' day', strtotime($date));
        $nuevafecha = date('Y-m-d H:i:s', $nuevafecha);
        return $nuevafecha;
    }

    public static function subtractMillisecounds($date, $secounds) {
        $nuevafecha = strtotime('-' . $secounds . ' secounds', strtotime($date));
        $nuevafecha = date('Y-m-d H:i:s', $nuevafecha);
        return $nuevafecha;
    }

    public static function betweenHoras($hms_inicio, $hms_fin, $hms_referencia = NULL) {
        if (is_null($hms_referencia)) {
            $hms_referencia = date('G:i:s');
        }

        list($h, $m, $s) = array_pad(preg_split('/[^\d]+/', $hms_inicio), 3, 0);
        $s_inicio = 3600 * $h + 60 * $m + $s;

        list($h, $m, $s) = array_pad(preg_split('/[^\d]+/', $hms_fin), 3, 0);
        $s_fin = 3600 * $h + 60 * $m + $s;

        list($h, $m, $s) = array_pad(preg_split('/[^\d]+/', $hms_referencia), 3, 0);
        $s_referencia = 3600 * $h + 60 * $m + $s;

        if ($s_inicio <= $s_fin) {
            return $s_referencia >= $s_inicio && $s_referencia <= $s_fin;
        } else {
            return $s_referencia >= $s_inicio || $s_referencia <= $s_fin;
        }
    }

    public static function getMinutesBettween($date1, $date2 = null) {
        $date1 = Hash::getTimeStamp($date1);
        if (!$date2) {
            $date2 = Hash::getDate();
        }
        $date2 = Hash::getTimeStamp($date2);
        $diff = ($date2 - $date1);
        $hours = floor(abs($diff) / 36e5);
        $minutes = round((($diff % 86400000) % 3600000) / 60000) + ($hours * 60);
        return $minutes;
    }

}
