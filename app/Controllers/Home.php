<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    }

    public function ajax()
    {
        return view('ajax');
    }

    public function get()
    {
        $db = db_connect();
        // $db->table('tb_user')->get()->getResultArray();
    }

    public function error()
    {
        $db = db_connect();
        $db->table('tb_user')->get()->getResultArray();
    }
}
