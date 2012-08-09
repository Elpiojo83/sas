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

        $data = $this->loadData();

        require_once dirname(__FILE__) . '/../3rdparty/phpQuery/phpQuery/phpQuery.php';
        phpQuery::newDocumentHTML($data);
        $newslist = pq('table table');
        foreach($newslist AS $news) {
            $header = pq('tr:eq(0) td font', $news)->html();
            list($date, $author) = explode(' - ', strip_tags(pq('tr:eq(1) td', $news)->html()));
            $date = strtotime($date);
            $content = strip_tags(pq('tr:eq(2) td', $news)->html(), '<p><em><strong><br>');

            var_dump($date, $author, $content);
            exit;
        }

        var_dump($data);
        exit;


    }

}
