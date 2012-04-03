<?php
class View_Helper_GetRss extends Zend_View_Helper_Abstract
{
  public function getRss()
  {
    $feed = Zend_Feed_Reader::import('http://devzone.zend.com/feed/rss2');
    $data = array('items' => array());
    foreach ($feed as $entry) {
      $idata = array('title' => $entry->getTitle(), 'link' => $entry->getLink());
      $data['items'][] = $idata;
    }
    echo "<ul class='rssfeed'>";
    for ($i = 0; $i < 5; $i++) {
      echo "<li><a href='" . $data['items'][$i]['link'] . "' target='_blank'>" . $data['items'][$i]['title'] . "</a></li>";
    }
    echo "</ul>";
  }
}
