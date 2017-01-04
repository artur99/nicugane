<?php

namespace Models;

class SectModel extends BaseModel{
    public function getSections(){
        $q = $this->db->createQueryBuilder();
        $q->select('*');
        $q->from('sections', '');
        $rh = $q->execute();
        $sects = [];
        while($res = $rh->fetch()){
            $sects[$res['slug']] = $res;
        }
        return $sects;
    }
    public function getSectPages($id){
        $q = $this->db->createQueryBuilder();
        $q->select('id, title, slug, image, ext_link, left(content, 150) as content');
        $q->from('pages', '');
        $q->where('section_id = ?')->setParameter(0, $id);
        $rh = $q->execute();
        $pages = [];
        while($res = $rh->fetch()){
            $res['content'] = str_replace("\n", ' ', strip_tags($res['content']));
            $pages[] = $res;
        }
        return $pages;
    }
    public function getPage($pageSlug){
        $q = $this->db->createQueryBuilder();
        $q->select('*');
        $q->from('pages', '');
        $q->where('slug = ?')->setParameter(0, $pageSlug);
        $q->setMaxResults(1);
        $res = $q->execute()->fetch();
        return $res;
    }
}
