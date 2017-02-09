<?php

namespace Models;

class CatdModel extends BaseModel{
    public function getCatds(){
        $q = $this->db->createQueryBuilder();
        $q->select('*');
        $q->from('catds', '');
        $rh = $q->execute();
        // $catds = [];
        return $rh;
    }
    // public function getCatdArts($catdSlug){
    //     $q = $this->db->createQueryBuilder();
    //     $q->select('a.*, \':\', c.*');
    //     $q->from('catd_articles', 'a');
    //     $q->join('a', 'catds', 'c', 'a.catd_id = c.id');
    //     $q->where('c.slug = ?')->setParameter(0, $catdSlug);
    //     // $q->setMaxResults(1);
    //
    //     while($res = $q->execute()->fetchAll();
    //     var_dump($res);die();
    //     return $res;
    // }
    public function getCatdInfo($catdSlug){
        $q = $this->db->createQueryBuilder();
        $q->select('*')->from('catds');
        $q->where('slug = ?')->setParameter(0, $catdSlug);
        $q->setMaxResults(1);

        $res = $q->execute()->fetch();
        return $res;
    }
    public function getCatdArts($catdId){
        $q = $this->db->createQueryBuilder();
        $q->select('a.*, u.data as user_data, u.name as user_name, u.image as user_image, u.prof as user_prof');
        $q->from('catd_articles', 'a');
        $q->join('a', 'users', 'u', 'a.user_id = u.id');
        $q->where('catd_id = ?')->setParameter(0, $catdId);
        $rh = $q->execute()->fetchAll();
        return $rh;
    }
}
