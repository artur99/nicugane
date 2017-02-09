<?php

namespace Models;
use Misc\MiscClass;

class UserModel{
    function __construct($db, $sess){
        $this->db = $db;
        $this->sess = $sess;
    }
    function in(){
        if($this->sess->has('user'))
            return $this->sess->get('user')['id'];
        return false;
    }
    function login_check($em, $pw){
        if(!MiscClass::validate($em, 'email')) return 0;
        $pw = MiscClass::encode($pw);
        $q = $this->db->executeQuery("SELECT id FROM users WHERE email = ? AND password = ? LIMIT 1", [$em, $pw]);
        $r = $q->fetchAll();
        if(isset($r[0]['id']))
            return $r[0]['id'];
        return false;
    }
    function login($uid, $keepin = 0, &$cookie = null){
        $uq = $this->db->executeQuery("SELECT name,email,type,prof,admin,image,fb_id,priority,data,rdate,ldate FROM users WHERE id = ? LIMIT 1", [(int)$uid]);
        $this->db->executeQuery("UPDATE users SET ldate = UNIX_TIMESTAMP(NOW()) WHERE id = ? LIMIT 1", [(int)$uid]);
        $udata = $uq->fetch();
        $udata['id'] = $uid;
        $this->sess->set('user', $udata);
        if($keepin){
            $token = str_shuffle(str_shuffle("artur99artur99artur99net").implode(range('f','y')).time().microtime(true)).time();
            $this->db->executeQuery("UPDATE users SET token = ? WHERE id = ? LIMIT 1", [$token, (int)$uid]);
            if($resp)
                $cookie = new Cookie('token', $token, time()+604800);
        }
        return 1;
    }
    function logout(){
        $this->sess->clear();
        return 1;
    }
    function info(){
        if(!$this->sess->has('user'))
            return false;
        $info = $this->sess->get('user');


        if($info['prof']){
            $info['prof_catds'] = $this->profCatds($info['id']);
        }
        return $info;
    }
    public function profCatds($uid){
        $uid = intval($uid);
        $dt = $this->db->executeQuery("SELECT t1.* FROM catds t1 JOIN catd_roles t2 ON t1.id = t2.catd_id WHERE t2.user_id = ?", [$uid])->fetchAll();
        return $dt;
    }
}
