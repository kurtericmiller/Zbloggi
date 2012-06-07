<?php
const SITE = "/var/local/workspaces/ymozend";
include SITE . "/public/cli.php";
$indexPath = APPLICATION_PATH . "/../data/indexes";
$index = Zend_Search_Lucene::create($indexPath);
$am = new Local_Domain_Mappers_ArticleMapper();
$um = new Local_Domain_Mappers_UserMapper();
$cm = new Local_Domain_Mappers_CommentMapper();
$ac = $am->findAll();
$count = 0;
foreach ($ac as $a) {
    if (0 == $a->get('published')) {
        continue;
    }
    $doc = new Zend_Search_Lucene_Document();
    $uid = $a->get('user_id');
    $u = $um->find($uid);
    $user = $u->get('username');
    $title = $a->get('article_title');
    $text = $a->get('article_text');
    $pubdate = $a->get('created_at');
    $a_id = $a->get('id');
    $cc = $cm->getArticleComments($a_id);
    $comments = "";
    foreach ($cc as $c) {
        $comments.= $c->get('comment_text');
    }
    $doc->addField(Zend_Search_Lucene_Field::Text('Title', $title));
    $doc->addField(Zend_Search_Lucene_Field::UnStored('Text', $text));
    $doc->addField(Zend_Search_Lucene_Field::UnStored('Comments', $comments));
    $doc->addField(Zend_Search_Lucene_Field::UnIndexed('Author', $user));
    $doc->addField(Zend_Search_Lucene_Field::UnIndexed('Published', $pubdate));
    $doc->addField(Zend_Search_Lucene_Field::UnIndexed('RecordID', $a_id));
    $index->addDocument($doc);
}
?>
