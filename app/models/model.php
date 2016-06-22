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
}

$model = new model($app);
