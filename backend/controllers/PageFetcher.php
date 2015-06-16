<?php

namespace backend\controllers;

use backend\models\Page;
use backend\models\House;
use HTML_Parser_HTML5;

class PageFetcher 
{

    public static function fetchPage($idSite, $refPage)
    {
        $page = array();
        $page['url'] = 'http://pubblicita.tribunale.milano.it/milano/scheda.php?id='.$refPage;

        try
            {            
                $curlparams = array(
                    'url' => $page['url'],
                    'host' => '',
                    'header' => '',
                    'method' => 'GET', // 'POST','HEAD'
                    'referer' => '',
                    'cookie' => '',
                    'post_fields' => '', // 'var1=value&var2=value
                    'timeout' => 20
                    );
                $curl = new CurlRequest();
                $curl->init($curlparams);
                $result = $curl->exec();

                if ($result['curl_error'])    throw new \Exception($result['curl_error']);
                $page['idSite'] = $idSite;
                $page['refPage'] = $refPage;
                $page['dtInsert'] = date("Y-m-d H:i:s");
                $page['dtUpdate'] = $page['dtInsert'];
                $page['httpStatus'] = $result['http_code'];
                if ($result['http_code']=='200' && $result['body']) {
                    $page['status'] = 'FOK';
                } else {
                    $page['status'] = 'FKO';
                }
                $page['html'] = $result['body'];
                //$page['save();
                //return $this->redirect(['view', 'id' => $page['idPage]);
            }
            catch (Exception $e)
            {
                echo $e->getMessage();
            }
        return $page;
    }

    public static function parsePage($html)
    {
        $parser = new HTML_Parser_HTML5($html);
        $house = array();
        $page = array();

        // dati procedura
        $house['tribunale'] = PageFetcher::extractText($parser, 'span[id="ufficio_"]');
        if ( trim($house['tribunale']) == false ) {
            $page['status'] = 'PEM';  
        } else {
            try {          
                $page['status'] = 'PKO';  
                $house['dataPubblicazione'] = PageFetcher::extractText($parser, 'th[abbr="Pubblicato"] + td');
                $house['proceduraNum'] = PageFetcher::extractText($parser, 'span[id="numerorg_"]');
                $house['proceduraAnno'] = PageFetcher::extractText($parser, 'span[id="annorg_"]');
                $house['valorePerizia'] = PageFetcher::extractText($parser, 'th[abbr="Valore da Perizia"] + td');
                // dati immobile
                $house['esperimento'] = PageFetcher::extractText($parser, 'span[id="cronologicoOrdinanza_"]');
                $house['dataOrdinanza'] = PageFetcher::extractText($parser, 'span[id="dataOrdinanza_"]');
                $house['tipologia'] = PageFetcher::extractText($parser, 'th[abbr="Esecuzione"] + td');
                $house['superficie'] = PageFetcher::extractText($parser, 'th[abbr="Superficie"] + td');
                $s1 = PageFetcher::extractText($parser, 'span[id^="viaBene"]');
                $s2 = PageFetcher::extractText($parser, 'span[id^="comuneBene"]');
                $house['indirizzo'] = str_replace(',', ' ', $s1).', '.$s2;      
                $house['info'] = PageFetcher::extractText($parser, 'th[abbr="Info Immobile"] + td');

                $house['disponibilita'] = PageFetcher::extractText($parser, 'span[id^="disponibilitaBene"]');

                $pattern = "'<span id=\"descrizioneBene.*?\">(.*?)</span>'si";
                //preg_match($pattern, $subject, $matches, PREG_OFFSET_CAPTURE, 3);
                preg_match($pattern, $html, $match);
                if($match) $house['descrizione'] = $match[1];

                //$house['descrizione'] = PageFetcher::extractText($parser, 'span[id^="descrizioneBene"]');
                //dati vendita
                $house['sincData'] = PageFetcher::extractText($parser, 'span[id="datauUdienzaSenzaIncanto_"]');
                $house['cincData'] = PageFetcher::extractText($parser, 'span[id="dataUdienzaConIncanto_"]');


                //$house['sincStato'] = PageFetcher::extractText($parser, 'th[abbr="Stato"] + td', 0);
                //$house['cincStato'] = PageFetcher::extractText($parser, 'th[abbr="Stato"] + td', 1);
                
                $house['sincStato'] = PageFetcher::extractReg($html, "'<th.*?abbr=\"Stato\".*?>Stato</th>(\R|\h)*<td>(.*?)</td>'", 2, 2);
                $house['cincStato'] = PageFetcher::extractReg($html, "'<th.*?abbr=\"Stato\".*?>Stato</th>(\R|\h)*<td>(.*?)</td>'", 3, 2);


                $house['sincPrezzo'] = PageFetcher::extractText($parser, 'span[id="baseAsta_"]');
                $house['cincPrezzo'] = PageFetcher::extractText($parser, 'th[abbr="Prezzo Base con incanto"] + td');
                //$house['sincEsito'] = PageFetcher::extractText($parser, 'span[id="statoUdienzaSenzaIncanto_"]');
                //$house['cincEsito'] = PageFetcher::extractText($parser, 'span[id="statoUdienzaConIncanto_"]');
                $house['cincEsito'] = PageFetcher::extractReg($html, "'<td><span id=\"statoUdienzaConIncanto_\"></span>(.*?)</td>'");
                $house['sincEsito'] = PageFetcher::extractReg($html, "'<td><span id=\"statoUdienzaSenzaIncanto_\"></span>(.*?)</td>'");

                $page['status'] = 'POK'; 
            }
            catch (Exception $e) {
                $page['statusDetail'] = $e->getMessage();
            }
        }
        $house['dtInsert'] = date("Y-m-d H:i:s");
        $house['dtUpdate'] = $house['dtInsert'];
        $page['dtUpdate'] = $house['dtInsert'];
        unset($parser);   
        return array('page'=>$page, 'house'=>$house);    

    }

    public static function extractReg($html, $pattern, $occurrence = 1, $group = 1) {
        \Yii::error('preg_match['.$pattern.']');
        $ret = preg_match_all($pattern, $html, $match, PREG_SET_ORDER);
        \Yii::error('matches['.$ret.'] - error['.PageFetcher::getPregError().']');
        if (!$ret) {
            return "";
        }
        \Yii::error('['.print_r($match, true).']');
        $s = $match[$occurrence-1][$group];
        $s = PageFetcher::removeLeadingHtml($s);
        $s = str_replace('&nbsp;', ' ', $s);
        $s = preg_replace('`\s+`', ' ', $s);
        $s = trim($s);
        return $s;
        }

    public static function getInnerText($html) {
        $pattern = "'<([a-zA-Z]+).*?>(.*?)</\\1>'";
        \Yii::error('preg_match['.$pattern.']');
        $ret = preg_match($pattern, $html, $match);
        \Yii::error('matches['.$ret.'] - error['.PageFetcher::getPregError().']');
        if (!$ret) {
            return "";
        }
        \Yii::error('['.print_r($match, true).']');
        $s = $match[1];
        return $s;
        }
        
    public static function removeLeadingHtml($html) {
        $pattern = "'<([a-zA-Z]+).*?(</\1|\/)>(.*?)'";
        \Yii::error('removeLeadingHtml text['.$html.'] - pattern['.$pattern.']');
        $ret = preg_match($pattern, $html, $match);
        \Yii::error('matches['.$ret.'] - error['.PageFetcher::getPregError().']');
        if (!$ret) {
            return "";
        }
        \Yii::error('['.print_r($match, true).']');
        if ($ret>0) {
            return PageFetcher::removeLeadingHtml($match[2]);
            }
        return $s;
        }

    private static function getPregError() {
            if (preg_last_error() == PREG_NO_ERROR) {
                return 'There is no error.';
            }
            else if (preg_last_error() == PREG_INTERNAL_ERROR) {
                return 'There is an internal error!';
            }
            else if (preg_last_error() == PREG_BACKTRACK_LIMIT_ERROR) {
                return 'Backtrack limit was exhausted!';
            }
            else if (preg_last_error() == PREG_RECURSION_LIMIT_ERROR) {
                return 'Recursion limit was exhausted!';
            }
            else if (preg_last_error() == PREG_BAD_UTF8_ERROR) {
                return 'Bad UTF8 error!';
            }
            else if (preg_last_error() == PREG_BAD_UTF8_ERROR) {
                return 'Bad UTF8 offset error!';
            }
        }

    public static function extractText($parser, $selector, $index = 0) {
        $node = $parser->select($selector);
        if ($index >= count($node)) return '';
        $s = $node[$index]->toString(false, true, true);
        $s = str_replace('&nbsp;', ' ', $s);
        //$s = utf8_encode($s);
        //$s = str_replace('à', 'a', $s);
        //$s = html_entity_decode($s, ENT_QUOTES);
        $s = html_entity_decode($s, ENT_COMPAT, 'UTF-8');
        $s = preg_replace('`\s+`', ' ', $s);
        $s = trim($s);
        //$s = utf8_encode($s);
        return $s;
    }


}
?>