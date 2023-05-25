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
        $db->table('tb_user')->get()->getResultArray();
    }

    public function error()
    {
        $db = db_connect();
        $db->table('tb_user')->get()->getResultArray();
    }

    public function insert($djson = null)
    {
        // $json = ($this->request->getVar('json')) ? $this->request->getVar('json') : null;

        if ($djson == null) {
            $json = file_get_contents('php://input');
        } else {
            $json = $djson;
        }
        date_default_timezone_set('Asia/Jakarta');
        if ($json != null) {
            $json = json_decode($json, true);
            $data = [
                'title' => $json['title'],
                'code' => $json['code'],
                'response_code' => $json['response']['response'],
                'message' => $json['message'],
                'file' => $json['file'],
                'line' => $json['line'],
                'path' => $json['request']['path'],
                'http_method' => $json['request']['http_method'],
                'ip_address' => $json['request']['ip_address'],
                'is_ajax' => $json['request']['is_ajax'],
                'is_cli' => $json['request']['is_cli'],
                'is_secure_request' => $json['request']['is_secure_request'],
                'user_agent' => $json['request']['user_agent'],
                // 'json' => '',
                'json' => json_encode($json),
                'created_at' => date('Y-m-d H:i:s'),
            ];

            $db = db_connect();

            $db->table('tb_debug')->insert($data);
        }
    }
}
