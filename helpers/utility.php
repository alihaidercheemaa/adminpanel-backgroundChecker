<?php
    require($_SERVER['DOCUMENT_ROOT'] . '/config/define.php');



    //==============================Curl Function==============================
    function curlFunction($url, $data, $headers = "", $userpwd = "", $type = "", $response = "")
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        if ($headers != "") {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        if ($userpwd != "") {
            curl_setopt($ch, CURLOPT_USERPWD, $userpwd);
        }
        if (in_array($type, ["POST", "GET", "PUT", "PATCH", "DELETE"])) {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        } else if ($type != "") {
            curl_setopt($ch, CURLOPT_POST, 0);
        } else {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        if ($err) {
            return $err;
        } else {
            return $response == '1' ? json_decode($result) : $result;
        }
    }
    //==============================Curl Function==============================
    //==============================Array Pluck==============================
    function array_pluck($array, $key)
    {
        return array_map(function ($v) use ($key) {
            return is_object($v) ? $v->$key : $v[$key];
        }, $array);
    }
    //==============================Array Pluck==============================
    //==============================Compress Json==============================
    function compressJson($array)
    {
        $json = json_encode($array);
        $compress = gzencode($json, 9);
        header('Content-Encoding: gzip');
        return $compress;
    }
    //==============================Compress Json==============================

    function cleanString($string)
    {
        $utf8 = array(
            '/[áàâãªä]/u'   =>   'a',
            '/[ÁÀÂÃÄ]/u'    =>   'A',
            '/[ß]/u'    =>   'B',
            '/[ÍÌÎÏ]/u'     =>   'I',
            '/[íìîïī]/u'     =>  'i',
            '/[éèêë]/u'     =>   'e',
            '/[ÉÈÊË]/u'     =>   'E',
            '/[óòôõºö]/u'   =>   'o',
            '/[ÓÒÔÕÖ]/u'    =>   'O',
            '/[úùûü]/u'     =>   'u',
            '/[ÚÙÛÜ]/u'     =>   'U',
            '/ç/'           =>   'c',
            '/Ç/'           =>   'C',
            '/ñ/'           =>   'n',
            '/Ñ/'           =>   'N',
            '/–/'           =>   '-', // UTF-8 hyphen to "normal" hyphen
            '/[’‘‹›‚]/u'    =>   ' ', // Literally a single quote
            '/[“”«»„]/u'    =>   ' ', // Double quote
            '/ /'           =>   ' ', // nonbreaking space (equiv. to 0x160)
            '/&/'           =>   'And', // &
        );
        return preg_replace(array_keys($utf8), array_values($utf8), $string);
    }
    //==============================Clean String==============================

    function sessionDestroy($string, $type)
    {
        switch ($type) {
            case 'single':
                if (isset($_SESSION[$string])) {
                    unset($_SESSION[$string]);
                }
                break;
            case 'multiple':
                foreach ($_SESSION as $key => $value) {
                    foreach ($string as $prefix) {
                        if (strpos($key, $prefix) === 0) {
                            unset($_SESSION[$key]);
                            break;
                        }
                    }
                }
                break;
            default:
                break;
        }
    }

    function sessionSet($string)
    {
        $_SESSION[$string];
    }


    function dataHandle($data)
    {
        register_shutdown_function($data);
    }

