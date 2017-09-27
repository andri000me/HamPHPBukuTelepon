<?php

namespace App\Models;

use System\Model;

class HomeModel extends Model
{
    function getKontaks()
    {
        $data = $this->db->query("SELECT * FROM kontaks")->fetchAll();
        return $data;
    }

    function getKontak($id){
    	return $this->db->query("SELECT * FROM kontaks WHERE id=$id")->fetch();
    }

    function tambahsave($data){
    	$this->db->query("INSERT INTO kontaks VALUES (null, '{$data['nama']}', '{$data['nohp']}')");
    }

    function editsave($data){
    	$this->db->query("UPDATE kontaks SET nama='{$data['nama']}', nohp='{$data['nohp']}' WHERE id={$data['id']}");
    }

    function delete($id){
    	$this->db->query("DELETE FROM kontaks WHERE id=$id");
    }
}
