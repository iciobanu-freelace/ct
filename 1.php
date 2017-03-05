<?

class Utils
{
//-----------------------------------------------------------------------------------------------------
    function PageHead($c)
    {
        switch ($c) {
            case "101" :
                echo $GLOBALS[mTEXT_PAGES];
                break;
            case "201" :
                echo $GLOBALS[mDOMAINS] . " :: " . $GLOBALS[mmMAIN_DOMAINS];
                break;
            case "202" :
                echo $GLOBALS[mDOMAINS] . " :: " . $GLOBALS[mmPROFESSIONAL_DOMAINS];
                break;
            case "203" :
                echo $GLOBALS[mDOMAINS] . " :: " . $GLOBALS[mmWATCH_THEMES];
                break;
            case "204" :
                echo $GLOBALS[mINFO_FLOWS] . " :: " . $GLOBALS[mmRemarkableData];
                break;
            case "205" :
                echo $GLOBALS[mINFO_FLOWS] . " :: " . $GLOBALS[mmEventAgenda];
                break;
            case "100" :
                echo $GLOBALS[mLANGUAGES] . " :: " . $GLOBALS[mmTEXT];
                break;
            case "210" :
                echo $GLOBALS[mLANGUAGES] . " :: " . $GLOBALS[mmMONTHS];
                break;
            case "211" :
                echo $GLOBALS[mLANGUAGES] . " :: " . $GLOBALS[mmDAYS];
                break;
            case "220" :
                echo $GLOBALS[mLANGUAGES] . " :: " . $GLOBALS[mmTEXTSFORNEWS];
                break;

            case "300" :
                echo $GLOBALS[mNEWS];
                break;
            case "310" :
                echo $GLOBALS[mSONDAJE];
                break;
            case "206" :
                if ($_GET[type] == 2) echo "COMUNICATE ELECTORALE"; else echo $GLOBALS[mPRESS_RELEASE];
                break;
            case "207" :
                echo $GLOBALS[mINVITATIONS];
                break;
            case "208" :
                echo $GLOBALS[mmAnouncement];
                break;
        }
    }

//-----------------------------------------------------------------------------------------------------
    function FillSelect($rs, $name, $id, $checkid = 0)
    {
        for ($i = 0; $i < count($rs); $i++) {
            if ($rs[$i][$id] == $checkid) $result .= "<option value=" . $rs[$i][$id] . " selected>" . $rs[$i][$name];
            else $result .= "<option value=" . $rs[$i][$id] . ">" . $rs[$i][$name];
        }
        return $result;
    }

//-----------------------------------------------------------------------------------------------------
    function FillSelectNumbers($start, $end, $checkid = 0)
    {
        for ($i = $start; $i <= $end; $i++) {
            if ($i == $checkid) $result .= "<option value=" . $i . " selected>" . $i;
            else $result .= "<option value=" . $i . ">" . $i;
        }
        return $result;
    }

//-----------------------------------------------------------------------------------------------------
    function ValidEmail($email)
    {
        return (eregi("^[a-zA-Z0-9_\.]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$", $email));
    }

//-----------------------------------------------------------------------------------------------------
    function Digest($string)
    {
        return md5($string);
    }

//-----------------------------------------------------------------------------------------------------
    function ReplaceQ($str)
    {
        return str_replace("\"", "&quot;", $str);
        return str_replace("'", "\'", $str);
        return str_replace("`", "\`", $str);
        // return str_replace("&", "&amp;", $str);
    }

//-----------------------------------------------------------------------------------------------------
    function ReplaceBRNL($str)
    {
        $links = Object::ListByClassSimple(Language::getCurrent(), 220);

        $c = count($links);
        for ($i = 0; $i < $c; $i++)
            if (strpos($str, $links[$i][ObjectTName]) !== false) $str = str_replace($links[$i][ObjectTName], "<a target=new href=" . $links[$i][ObjectContent] . ">" . $links[$i][ObjectTName] . "</a>", $str);

//	$str = eregi_replace("scers", "<a target=_new href=http://www.scers.md>SCERS</a>" ,$str);
//	$str = eregi_replace("Strategia de Cre�tere Economic� �i Reducere a S�r�ciei", "<a target=new href=http://www.scers.md>Strategia de Cre�tere Economic� �i Reducere a S�r�ciei</a>" ,$str);
// text bold
        $str = eregi_replace("\[", "<b>", $str);
        $str = eregi_replace("]", "</b>", $str);
// text italic
        $str = eregi_replace("\{", "<i>", $str);
        $str = eregi_replace("}", "</i>", $str);
// $str = eregi_replace("&", "&amp;" , $str);

        //return str_replace("\n", "<br>", $str);
        return $str;
    }

//-----------------------------------------------------------------------------------------------------
    function ReplaceBRP($str, $class = "")
    {
        //return str_replace("\n", "<p $class>", $str);
        return $str;
    }

//-----------------------------------------------------------------------------------------------------
    function RemoveQ($str)
    {
        return str_replace("\\\"", "", $str);
        return str_replace("\"", "", $str);
    }

//-----------------------------------------------------------------------------------------------------
    function Filter($str, $n)
    {
        return trim(substr(strip_tags($str), 0, $n));
    }

//-----------------------------------------------------------------------------------------------------
    function FilterQ($str, $n)
    {
        return trim(substr(strip_tags(Utils::RemoveQ($str)), 0, $n));
    }

//-----------------------------------------------------------------------------------------------------
    function FilterT($str)
    {
        $str = str_replace(TS, "[TABLE_START]", $str);
        $str = str_replace(TE, "[TABLE_END]", $str);

        //$str = strip_tags($str);

        $str = str_replace("[TABLE_START]", TS, $str);
        $str = str_replace("[TABLE_END]", TE, $str);

        return trim($str);
    }

//-----------------------------------------------------------------------------------------------------
    function getLen($text, $len)
    {
        $sub = substr($text, 0, $len);
        $pos = strrpos($sub, ' ');
        if ($pos > 0) return substr($sub, 0, $pos) . "..."; else return $sub;
    }

//-----------------------------------------------------------------------------------------------------
    function getWords($text)
    {
        preg_match("/^(.*\s+){6}/iU", $text, $matches);
        return $matches[0] != NULL ? $matches[0] . "..." : $text . "...";
    }

//-----------------------------------------------------------------------------------------------------
    function getWordsAgenda($text)
    {
        preg_match("/^(.*\s+){10}/iU", $text, $matches);
        return $matches[0] != NULL ? $matches[0] . "..." : $text . "...";
    }

//-----------------------------------------------------------------------------------------------------
    function getWordsNewsContent($text)
    {
// text bold
        $text = eregi_replace("\[", "<b>", $text);
        $text = eregi_replace("]", "</b>", $text); // text bold
// text italic
        $str = eregi_replace("\{", "<i>", $str);
        $str = eregi_replace("}", "</i>", $str);

        preg_match("/^(.*\s+){30}/iU", $text, $matches);
        return $matches[0] != NULL ? $matches[0] : $text;
    }

//-----------------------------------------------------------------------------------------------------
    function getWordsNewsContentLong($text)
    {
        return $text;
//	preg_match("/^(.*\s+){10}/iU", $text, $matches);
//	return $matches[0] != NULL ? $matches[0]  : $text;
    }

//-----------------------------------------------------------------------------------------------------
    function getWordsMainNews($text)
    {
        preg_match("/^(.*\s+){150}/iU", $text, $matches);
        return $matches[0] != NULL ? $matches[0] : $text;
    }

//-----------------------------------------------------------------------------------------------------

    function getFirstParagraph($text, $delimiter)
    {
        $pos = strpos($text, $delimiter);
        if ($pos !== false)
            return substr($text, 0, $pos - 1);

        return $text;
    }

//-----------------------------------------------------------------------------------------------------

    function error($err)
    {
        return "<p align=center><a class=bred>$err</a></p>\n";
    }

//-----------------------------------------------------------------------------------------------------

    function message($msg)
    {
        echo "<p align=center class=bgreen>$msg</p>\n";
    }

//-----------------------------------------------------------------------------------------------------

    function getmt()
    {
        list($usec, $sec) = explode(" ", microtime());
        return ((float)$usec + (float)$sec);
    }

//-----------------------------------------------------------------------------------------------------

    function validateDate($date)
    {
        if (!preg_match("/^([0-9]{4}\/[0-9]{2}\/[0-9]{2})$/", $date)) $date = date("Y/m/d");
        return $date;
    }

//-----------------------------------------------------------------------------------------------------
    function validateDateDefis($date)
    {
        if (!preg_match("/^([0-9]{4}\/[0-9]{2}\/[0-9]{2})$/", $date)) $date = date("Y-m-d");
        return $date;
    }

//-----------------------------------------------------------------------------------------------------

    function log($string)
    {

        return true;

        if ($f = fopen($_SERVER['DOCUMENT_ROOT'] . "/_log/log.txt", "a")) {
            fputs($f, date("Y/m/d H:i") . " ## " . $string . "\n");
            fclose($f);
        }
    }

//-----------------------------------------------------------------------------------------------------

    function ReplaceQForSerialization($str)
    {
        $str = str_replace("\"", "&quot;", $str);
        return str_replace("'", "\'", $str);
        // return str_replace("&", "&amp;", $str);
    }
    //-----------------------------------------------------------------------------------------------------
    // by ebs Title parser for news
    function ParseTitle($title, $delimiter = '-')
    {
        @setlocale(LC_CTYPE, 'ro_RO.ISO8859-2');
        $clean = iconv('ISO-8859-2', 'ASCII//TRANSLIT', $title);
        $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
        $clean = strtolower(trim($clean, '-'));
        $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

        return $clean;

    }

//Official excange rates
    function getBNM($lng)
    {
        //$bnm = 'http://www.host.md/bnm.md/rates.php?date='.date("d.m.Y")."&lang=$lng";
        //  $bnm = 'http://bnm.md/md/official_exchange_rates?get_xml=1&date='.date("d.m.Y")."&lang=$lng";
        //http://bnm.md/md/official_exchange_rates?get_xml=1&date=

        if ($lng == 'ro') $lng = 'md';

        $tableBNM = array(
            'en' => array(
                'title' => array('Currency', 'Code', 'ABR', 'Rate', 'Exchange Rate')),
            'md' => array(
                'title' => array('Valuta', 'Cod', 'ABR', 'Rata', 'Cursul')),
            'ru' => array(
                'title' => array('&#1042;&#1072;&#1083;&#1102;&#1090;&#1072;', '&#1050;&#1086;&#1076;', 'ABR', '&#1053;&#1086;&#1084;&#1080;&#1085;&#1072;&#1083;', '&#1050;&#1091;&#1088;&#1089;'),
                'name' => array(
                    '036' => '&#1040;&#1074;&#1089;&#1090;&#1088;&#1072;&#1083;&#1080;&#1081;&#1089;&#1082;&#1080;&#1081; &#1044;&#1086;&#1083;&#1083;&#1072;&#1088;',
                    '944' => '&#1040;&#1079;&#1077;&#1088;&#1073;&#1072;&#1081;&#1076;&#1078;&#1072;&#1085;&#1089;&#1082;&#1080;&#1081; &#1052;&#1072;&#1085;&#1072;&#1090;',
                    '008' => '&#1040;&#1083;&#1073;&#1072;&#1085;&#1089;&#1082;&#1080;&#1081; &#1083;&#1077;&#1082;',
                    '826' => '&#1040;&#1085;&#1075;&#1083;&#1080;&#1081;&#1089;&#1082;&#1080;&#1081; &#1060;&#1091;&#1085;&#1090; &#1057;&#1090;&#1077;&#1088;&#1083;&#1080;&#1085;&#1075;&#1086;&#1074;',
                    '051' => '&#1040;&#1088;&#1084;&#1103;&#1085;&#1089;&#1082;&#1080;&#1081; &#1044;&#1088;&#1072;&#1084;',
                    '933' => '&#1041;&#1077;&#1083;&#1086;&#1088;&#1091;&#1089;&#1089;&#1082;&#1080;&#1081; &#1056;&#1091;&#1073;&#1083;&#1100;',
                    '975' => '&#1041;&#1086;&#1083;&#1075;&#1072;&#1088;&#1089;&#1082;&#1080;&#1081; &#1051;&#1077;&#1074;',
                    '348' => '&#1042;&#1077;&#1085;&#1075;&#1077;&#1088;&#1089;&#1082;&#1080;&#1081; &#1060;&#1086;&#1088;&#1080;&#1085;&#1090;',
                    '344' => '&#1043;&#1086;&#1085;&#1082;&#1086;&#1085;&#1075;&#1089;&#1082;&#1080;&#1081; &#1076;&#1086;&#1083;&#1083;&#1072;p',
                    '981' => '&#1043;&#1088;&#1091;&#1079;&#1080;&#1085;&#1089;&#1082;&#1080;&#1081; &#1051;&#1072;&#1088;&#1080;',
                    '208' => '&#1044;&#1072;&#1090;&#1089;&#1082;&#1072;&#1103; &#1050;&#1088;&#1086;&#1085;&#1072;',
                    '840' => '&#1044;&#1086;&#1083;&#1083;&#1072;&#1088; &#1057;&#1064;&#1040;',
                    '978' => '&#1045;&#1074;&#1088;&#1086;',
                    '376' => '&#1048;&#1079;&#1088;&#1072;&#1080;&#1083;&#1100;&#1089;&#1082;&#1080;&#1081; &#1064;&#1077;&#1082;&#1077;&#1083;&#1100;',
                    '356' => '&#1048;&#1085;&#1076;&#1080;&#1081;&#1089;&#1082;&#1072;&#1103; p&#1091;&#1087;&#1080;&#1103;',
                    '352' => '&#1048;&#1089;&#1083;&#1072;&#1085;&#1076;&#1089;&#1082;&#1072;&#1103; &#1050;&#1088;&#1086;&#1085;&#1072;',
                    '398' => '&#1050;&#1072;&#1079;&#1072;&#1093;&#1089;&#1082;&#1080;&#1081; &#1058;&#1077;&#1085;&#1075;&#1077;',
                    '124' => '&#1050;&#1072;&#1085;&#1072;&#1076;&#1089;&#1082;&#1080;&#1081; &#1044;&#1086;&#1083;&#1083;&#1072;&#1088;',
                    '417' => '&#1050;&#1080;&#1088;&#1075;&#1080;&#1079;&#1089;&#1082;&#1080;&#1081; &#1057;&#1086;&#1084;',
                    '156' => '&#1050;&#1080;&#1090;&#1072;&#1081;&#1089;&#1082;&#1080;&#1081; &#1102;&#1072;&#1085;&#1100; &#1056;&#1077;&#1085;&#1084;&#1080;&#1085;&#1073;&#1080;',
                    '414' => '&#1050;&#1091;&#1074;&#1077;&#1081;&#1090;&#1089;&#1082;&#1080;&#1081; &#1044;&#1080;&#1085;&#1072;&#1088;',
                    '428' => '&#1051;&#1072;&#1090;&#1074;&#1080;&#1081;&#1089;&#1082;&#1080;&#1081; &#1051;&#1072;&#1090;',
                    '440' => '&#1051;&#1080;&#1090;&#1086;&#1074;&#1089;&#1082;&#1080;&#1081; &#1051;&#1080;&#1090;',
                    '807' => '&#1052;&#1072;&#1082;&#1077;&#1076;&#1086;&#1085;&#1089;&#1082;&#1080;&#1081; &#1076;&#1077;&#1085;&#1072;&#1088;',
                    '458' => '&#1052;&#1072;&#1083;&#1072;&#1081;&#1079;&#1080;&#1081;&#1089;&#1082;&#1080;&#1081; &#1088;&#1080;&#1085;&#1075;&#1075;&#1080;&#1090;',
                    '554' => '&#1053;&#1086;&#1074;&#1086;&#1079;&#1077;&#1083;&#1072;&#1085;&#1076;&#1089;&#1082;&#1080;&#1081; &#1044;&#1086;&#1083;&#1083;&#1072;&#1088;',
                    '578' => '&#1053;&#1086;&#1088;&#1074;&#1077;&#1078;&#1089;&#1082;&#1072;&#1103; &#1050;&#1088;&#1086;&#1085;&#1072;',
                    '784' => '&#1054;.&#1040;.&#1069;. &#1044;&#1080;&#1088;&#1093;&#1072;&#1084;',
                    '985' => '&#1055;&#1086;&#1083;&#1100;&#1089;&#1082;&#1072;&#1103; &#1047;&#1083;&#1086;&#1090;&#1072;',
                    '643' => '&#1056;&#1086;&#1089;&#1089;&#1080;&#1081;&#1089;&#1082;&#1080;&#1081; &#1056;&#1091;&#1073;&#1083;&#1100;',
                    '946' => '&#1056;&#1091;&#1084;&#1099;&#1085;&#1089;&#1082;&#1080;&#1081; &#1051;&#1077;&#1081;',
                    '960' => '&#1057;&#1044;&#1056;',
                    '941' => '&#1057;&#1077;&#1088;&#1073;&#1089;&#1082;&#1080;&#1081; &#1044;&#1080;&#1085;&#1072;&#1088;',
                    '972' => '&#1058;&#1072;&#1076;&#1078;&#1080;&#1082;&#1089;&#1082;&#1080;&#1081; &#1057;&#1086;&#1084;&#1086;&#1085;&#1080;',
                    '949' => '&#1058;&#1091;&#1088;&#1077;&#1094;&#1082;&#1072;&#1103; &#1051;&#1080;&#1088;&#1072;',
                    '934' => '&#1058;&#1091;&#1088;&#1082;&#1084;&#1077;&#1085;&#1089;&#1082;&#1080;&#1081; &#1052;&#1072;&#1085;&#1072;&#1090;',
                    '860' => '&#1059;&#1079;&#1073;&#1077;&#1082;&#1089;&#1082;&#1080;&#1081; &#1057;&#1091;&#1084;',
                    '980' => '&#1059;&#1082;&#1088;&#1072;&#1080;&#1085;&#1089;&#1082;&#1072;&#1103; &#1043;&#1088;&#1080;&#1074;&#1085;&#1072;',
                    '191' => '&#1061;&#1086;&#1088;&#1074;&#1072;&#1090;&#1089;&#1082;&#1072;&#1103; &#1050;&#1091;&#1085;&#1072;',
                    '203' => '&#1063;&#1077;&#1096;&#1089;&#1082;&#1072;&#1103; &#1050;&#1088;&#1086;&#1085;&#1072;',
                    '752' => '&#1064;&#1074;&#1077;&#1076;&#1089;&#1082;&#1072;&#1103; &#1050;&#1088;&#1086;&#1085;&#1072;',
                    '756' => '&#1064;&#1074;&#1077;&#1081;&#1094;&#1072;&#1088;&#1089;&#1082;&#1080;&#1081; &#1060;&#1088;&#1072;&#1085;&#1082;',
                    '410' => '&#1070;&#1078;&#1085;&#1086;&#1082;&#1086;&#1088;&#1077;&#1081;&#1089;&#1082;&#1080;&#1081; &#1074;&#1086;&#1085;',
                    '392' => '&#1071;&#1087;&#1086;&#1085;&#1089;&#1082;&#1072;&#1103; &#1049;&#1077;&#1085;&#1072;')
            )
        );


        $url = "http://bnm.md/{$lng}/official_exchange_rates?get_xml=1&date=";

        //$url = 'http://www.host.md/bnm.md/rates.php?date=';
        // $url = "http://db.devebs.net/curs/curs.php?&date=";


        $today = date("d.m.Y");
        $cache = $_SERVER['DOCUMENT_ROOT'] . "/cache/{$lng}_rates.xml";
        $old_cache = $_SERVER['DOCUMENT_ROOT'] . "/cache/{$lng}_rates_old.xml";
        $now = time();


        //diferenta o zi
        if (!file_exists($cache) OR (0 == filesize($cache))) {
            $bnm = $url . date("d.m.Y") . "&lang=$lng";

            $xml = self::getData($bnm);

            file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/cache/{$lng}_rates.xml", $xml);



        } else {
            if ((($now - filemtime($cache)) > 3600 * 10)) {
                $bnm = $url . date("d.m.Y") . "&lang=$lng";;
                $xml = self::getData($bnm);
                file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/cache/{$lng}_rates.xml", $xml);
            }
        }
        //diferenta 2 zile
        if (!file_exists($old_cache) OR (0 == filesize($old_cache))) {
            $ieri = mktime(0, 0, 0, date("m"), date("d") - 1, date("Y"));
            $bnm = $url . date("d.m.Y", $ieri) . "&lang=$lng";;
            if (@self::getData($bnm)) {
                $xml = self::getData($bnm);
                if (isset($xml)) file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/cache/{$lng}_rates_old.xml", $xml);
            }
        } else {
            if ((($now - filemtime($old_cache)) > 7200 * 10)) {
                $ieri = mktime(0, 0, 0, date("m"), date("d") - 1, date("Y"));
                $bnm = $url . date("d.m.Y", $ieri) . "&lang=$lng";;
                $xml = self::getData($bnm);
                file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/cache/{$lng}_rates_old.xml", $xml);
            }
        }
        // end diferenta 2 zile


        $file_path = $_SERVER['DOCUMENT_ROOT'] . "/cache/{$lng}_rates.xml";


        if (0 == filesize($file_path)) $file_path = $_SERVER['DOCUMENT_ROOT'] . "/cache/{$lng}_rates_old.xml";
        if (0 == filesize($file_path)) $file_path = $_SERVER['DOCUMENT_ROOT'] . "/cache/{$lng}_old.xml";

        $xmlObject = simplexml_load_file($file_path);
        $date = $xmlObject->attributes();


        foreach ($xmlObject->children() as $node) {

            $c['Name'] = $node->Name;
            $c['NumCode'] = $node->NumCode;
            $c['CharCode'] = $node->CharCode;
            $c['Nominal'] = $node->Nominal;
            $c['Value'] = $node->Value;

            $a[] = $c;
        }

        usort($a, function ($a, $b) {
            return strcmp($a["Name"], $b["Name"]);
        });

        //write table
        $table .= '<table width="100%" cellspacing="1" cellpadding="2" border="0">';
        $db_table = "[T]\r\n";


        foreach ($a as $key => $attr) {
            if ($key == 0) {

                if (isset($tableBNM[$lng])) {
                    $title = $tableBNM[$lng]['title'];
                    $table .= "<tr>";

                    foreach ($title as $t) {

                        $table .= "<td bgcolor='#cccccc'><b>$t</b></td>";
                        $db_table .= $t . "\t";
                    }
                    $db_table .= "\r\n";

                    $table .= "</tr>";
                }

            }

            if ($lng == 'ru') {
                $attr['NumCode'] = (array)$attr['NumCode'];
                $attr['NumCode'] = $attr['NumCode'][0];
                $attr['Name'] = (array)$attr['Name'];
                $attr['Name'] = $attr['Name'][0];

                if (isset($tableBNM['ru']['name'][$attr['NumCode']])) $attr['Name'] = $tableBNM['ru']['name'][$attr['NumCode']];

            }

            $table .= "<tr><td>{$attr['Name']}</td>
                          <td>{$attr['NumCode']}</td>
                          <td>{$attr['CharCode']}</td>
                          <td>{$attr['Nominal']}</td>
                          <td>{$attr['Value']}</td>
                      </tr>";

            $db_table .= "{$attr['Name']} \t {$attr['NumCode']} \t {$attr['CharCode']} \t {$attr['Nominal']} \t {$attr['Value']} \r\n";

        }

        $table .= '</table>';
        $db_table .= '[*T]';


        return array('date' => $date, 'table' => $table, 'db_table' => $db_table);

    }

    /*
     * curl
     */
    function getData($url)
    {
        $ch = curl_init();
        $timeout = 20;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }


}


