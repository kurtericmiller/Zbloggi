<?php
class Local_Api_Wp extends Local_Api_XmlRpc
{
    protected $_user;

    public function getTags($blogid, $username, $password)
    {
        $tags = array();
        if (!$this->login($username, $password)) {
            return $tags;
        }
        $localReg = Zend_Registry::get('local');
        $km = new Local_Domain_Mappers_KeywordMapper();
        $kc = $km->findAll();
        $kw = $km->countKeyword();
        foreach ($kw as $k) {
            $keyword = $k['keyword'];
            $count = $k['rank'];
            $id = $km->findByKeyword($keyword);
            $tag = array(
                'tag_id' => new Zend_XmlRpc_Value_Integer($id),
                'name' => $keyword,
                'slug' => $keyword,
                'html_url' => $localReg->get('site_url') . '/blog/tag?tag=' . $keyword,
                'rss_url' => '',
                'count' => new Zend_XmlRpc_Value_Integer($count));
            $tags[] = $tag;
        }
        return $tags;
    }
}
