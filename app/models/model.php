<?php

class model{
    function __construct(Silex\Application $app){
        $this->db = $app['db'];
        $this->user = $app['user'];
    }

    function get_profs(){
        $q = $this->db->createQueryBuilder();
        $q->select('*');
        $q->from('users', '');
        $q->where('prof = 1');
        $q->orderBy('priority', 'DESC');
        $res = $q->execute()->fetchAll();
        array_walk($res, function(&$val){
            $val['data'] = json_decode($val['data']);
        });
        return $res;
    }
    function get_prof($pid=0){
        $pid = intval($pid);
        if($pid==0) return false;

        $q = $this->db->createQueryBuilder();
        $q->select('*');
        $q->from('users', '');
        $q->where('id = ?')->setParameter(0, $pid);
        $res = $q->execute()->fetchAll();
        if(sizeof($res)==0) return false;
        $res[0]['data'] = json_decode($res[0]['data']);
        return $res[0];
    }

    function get_activities(){
        $q = $this->db->createQueryBuilder();
        $q->select('*');
        $q->from('activities', '');
        $q->orderBy('priority', 'DESC');
        $res = $q->execute()->fetchAll();
        return $res;
    }
    function get_events(){
        $q = $this->db->createQueryBuilder();
        $q->select('*');
        $q->from('events', '');
        $q->orderBy('priority', 'DESC');
        $res = $q->execute()->fetchAll();
        return $res;
    }
    function get_catedre(){
        $q = $this->db->createQueryBuilder();
        $q->select('*');
        $q->from('catds', '');
        $res = $q->execute()->fetchAll();
        return $res;
    }

    function get_activ($aid = 0){
        $aid = intval($aid);
        if($aid==0) return false;

        $q = $this->db->createQueryBuilder();
        $q->select('*');
        $q->from('activities', '');
        $q->where('id = ?')->setParameter(0, $aid);
        $res = $q->execute()->fetchAll();
        if(sizeof($res)==0) return false;
        return $res[0];

    }

    function get_event($eid = 0){
        $eid = intval($eid);
        if($eid==0) return false;

        $q = $this->db->createQueryBuilder();
        $q->select('*');
        $q->from('events', '');
        $q->where('id = ?')->setParameter(0, $eid);
        $res = $q->execute()->fetchAll();

        if(sizeof($res)==0) return false;
        return $res[0];
    }

    function get_catd_data($cid){
        $cid = intval($cid);
        if($cid==0) return false;

        $q = $this->db->createQueryBuilder();
        $q->select('*');
        $q->from('catds', '');
        $q->where('id = ?')->setParameter(0, $cid);
        $res = $q->execute()->fetchAll();

        if(sizeof($res)==0) return false;
        return $res[0];
    }

    function get_catd_art($cid){
        $cid = intval($cid);
        if($cid==0) return false;

        $res = $this->db->executeQuery("
            SELECT catd_articles.*, users.email AS user_email, users.name AS user_name, users.image AS user_img, users.data AS user_data
            FROM catd_articles
            LEFT JOIN users ON users.id = catd_articles.user_id WHERE catd_articles.catd_id = ?
            ORDER BY pinned DESC, date DESC
        ", [$cid])->fetchAll();

        return $res;
    }
}

$model = new model($app);
