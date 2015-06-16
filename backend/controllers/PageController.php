<?php

namespace backend\controllers;

use backend\models\Page;
use backend\models\House;
use backend\controllers\PageFetcher;

use HTML_Parser_HTML5;
use HTML_Formatter;

class PageController extends BasePageController
{


    public function actionFetchall($idSite = 1, $start = 1017441 /*1017194*/)
    {
        header( 'Content-Type: text/html; charset=UTF-8' );
    	$refPage = $start;
    	do {
	    	$page = new Page();
			$result = PageFetcher::fetchPage($idSite, $refPage);
			//echo "<br/>".var_dump($result);
			//unset($result['idPage']);
			$page->attributes = $result;
			$page->html = $result['html'];
			$res = $page->insert(false);
			if (!$res) return "<br/>".var_dump($page);
			//echo "<br/>".var_dump($page);
			\Yii::error($refPage . " - " . $page->idPage . " - " . $page->status);
			echo "<br/>".$refPage . " - " . $page->idPage . " - " . $page->status;
			if ($page->status == 'FOK') {
				$result = PageFetcher::parsePage($page->html);
				//echo "<br/>".var_dump($result);
				$page->attributes = $result['page'];

				$page->update(false);
				$house = new House();
				$house->attributes = $result['house'];
				$house->idPage = $page->idPage;
				$house->refPage = $page->refPage;
				//echo "<br/>".var_dump($house->attributes);
				\Yii::error($page->html );
				\Yii::error($house->attributes);
				$house->insert(false);
				echo "<br/>".$refPage . " - " . $page->idPage . " - ". $page->status;
			}
			$refPage++;
			
		} while (false); //($page->status != 'PKO');
		//return $this->redirect(['view', 'id' => $page->idPage]);
		//return $this->redirect(['index']);
		//return $this->render('view', ['model' => $page]);
	}

    public function actionParse($id)
    {
        if (($page = Page::findOne($id)) === null) 
        {
          throw new NotFoundHttpException('The requested page does not exist.');
        }
		//echo "<br/>idPage [".$page->idPage.']';
        $parser = new HTML_Parser_HTML5($page->html);
        //$s = PageFetcher::extractText($parser, 'th[abbr="Pubblicato"] ~ td');
		//$s = PageFetcher::extractText($parser, 'th[abbr="Valore da Perizia"] + td');
		$s = PageFetcher::extractText($parser, 'span[id^="descrizioneBene"]');
        //$s1 = PageFetcher::extractText($parser, 'span[id^="viaBene"]');
        //$s2 = PageFetcher::extractText($parser, 'span[id^="comuneBene"]');
        //$s = str_replace(',', ' ', $s1).', '.$s2;
        //$s = PageFetcher::extractText($parser, 'th[abbr="Indirizzo"] ~ td');
        header( 'Content-Type: text/html; charset=UTF-8' );
        echo '<html><body>';
		echo '<br/>text ['.$s.']';
		//echo '<br/>text ['.utf8_encode($s).']';
        echo '</body></html>';

	}



    public function actionPoller($idSite, $start)
    {
    	$refPage=$start;
    	do {
			$page = fetchPage($idSite, $refPage);
			if ($page->status == 'FOK') {
				$page = parsePage($page->idPage);
				$refPage++;
			}
    	} while ($page->status == 'POK');
	}

	/**
     * Updates an existing Page model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDownload($idSite, $refPage)
    {
        $model = new Page();
        $model->url = 'http://www.asteannunci.it/aste-giudiziarie/scheda.php?id='.$refPage; //1017835
        //http://www.asteannunci.it/aste-giudiziarie/scheda.php?id=1017835
        //http://pubblicita.tribunale.milano.it/milano/scheda.php?id=1019842

        try
            {            
                $curlparams = array(
                    'url' => $model->url,
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
                if ($result['http_code']=='200' && $result['body']) 
                {
                	$model->html = $result['body'];
                	//$model->htmlPretty = dom_format($model->html, array('attributes_case' => CASE_LOWER));
                }
                //$html = file_get_dom($model->url);
                $model->idSite = $idSite;
                $model->refPage = $refPage;
                $model->status = 'GET';
                $model->httpStatus = $result['http_code'];
                $model->dtInsert = date("Y-m-d H:i:s");
                $model->dtUpdate = $model->dtInsert;
                $model->save();
                return $this->redirect(['view', 'id' => $model->idPage]);
            }
            catch (Exception $e)
            {
                        echo $e->getMessage();
            }
    }


}
?>