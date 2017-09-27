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

    function tambah(){
        $this->load->view('header',['pagetitle'=>'Tambah - Buku Telepon']);
        $this->load->view('home/tambah');
        $this->load->view('footer');
    }

    function tambahsave(){
        $this->homemodel->tambahsave($_POST);
        header('Location: /');
    }

    function edit($id){
        $kontak = $this->homemodel->getKontak($id);

        $this->load->view('header',['pagetitle'=>'Edit '.$id.' - Buku Telepon']);
        $this->load->view('home/edit',$kontak);
        $this->load->view('footer');
    }

    function editsave(){
        $this->homemodel->editsave($_POST);
        header('Location: /');
    }

    function delete($id){
        $this->homemodel->delete($id);
        header('Location: /');
    }
}
