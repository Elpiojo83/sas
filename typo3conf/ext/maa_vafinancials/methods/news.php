<?php
/**
 * Created by JetBrains PhpStorm.
 * User: LsV
 * Date: 08-08-12
 * Time: 02:26
 * To change this template use File | Settings | File Templates.
 */
class vafinancials_news
    extends vafinancials_abstract
{

    public function init()
    {

        $db = $GLOBALS['TYPO3_DB']; /** @var $db t3lib_DB */
        $data = $this->loadData();

        require_once dirname(__FILE__) . '/../3rdparty/phpQuery/phpQuery/phpQuery.php';
        phpQuery::newDocumentHTML($data);
        $newslist = pq('table table');
        foreach($newslist AS $news) {
            $md5 = md5(pq($news)->html());
            if ($db->exec_SELECTcountRows('uid', 'tt_news', 'keywords = "' . $md5 . '"') != 0) continue;

            $header = pq('tr:eq(0) td font', $news)->html();
            list($date, $author) = explode(' - ', strip_tags(pq('tr:eq(1) td', $news)->html()));
            $date = strtotime($date);
            $content = strip_tags(pq('tr:eq(2) td', $news)->html(), '<p><em><strong><br>');

            $content = array(
                'pid' => $this->parent->conf['newsPID'],
                'tstamp' => time(),
                'crdate' => time(),
                'title' => $header,
                'datetime' => $date,
                'bodytext' => $content,
                'author' => $author,
                'category' => $this->parent->conf['newsCategory'],
                'keywords' => $md5,
            );

            $db->exec_INSERTquery('tt_news', $content);
        }

    }

}
