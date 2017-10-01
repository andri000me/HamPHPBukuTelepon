<?php

namespace App\Controllers;

use System\Controller;
use App\Models\HomeModel;

class Home extends Controller
{
    public $homemodel;

    function __construct(){
        parent::__construct();

        $this->homemodel = new HomeModel();
    }

    function index()
    {
        $kontaks = $this->homemodel->getKontaks();

        $this->load->view('header',['pagetitle'=>'Buku Telepon']);
        $this->load->view('home/home',$kontaks);
        $this->load->view('footer');
    }

    function getKontaks(){
        $kontaks = $this->homemodel->getKontaks();
        echo json_encode($kontaks);
    }

    function tambah(){
        $this->load->view('home/tambah');
    }

    function tambahsave(){
        $this->homemodel->tambahsave($_GET);
    }

    function edit($id){
        $kontak = $this->homemodel->getKontak($id);
        $this->load->view('home/edit',$kontak);
    }

    function editsave(){
        $this->homemodel->editsave($_GET);
    }

    function delete($id){
        $this->homemodel->delete($id);
    }
}
