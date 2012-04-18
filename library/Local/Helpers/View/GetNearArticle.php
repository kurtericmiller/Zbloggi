<?php
class View_Helper_GetNearArticle extends Zend_View_Helper_Abstract
{
    public function getNearArticle($article_id, $which)
    {
        $am = new Local_Domain_Mappers_ArticleMapper();
        if ($which == 'next') {
            $options['where'] = "id = (select min(id) from articles where id > " . $article_id . " and published = 1)";
        }
        if ($which == 'prev') {
            $options['where'] = "id = (select max(id) from articles where id < " . $article_id . " and published = 1)";
        }
        $ac = $am->findAll($options);
        $values = array();
        foreach ($ac as $a) {
            $values['id'] = $a->get('id');
            $values['title'] = $a->get('article_title');
        }
        return $values;
    }
}
