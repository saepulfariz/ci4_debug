<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbDebug extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => '128',
            ],
            'code' => [
                'type'       => 'VARCHAR',
                'constraint' => '128',
            ],
            'response_code' => [
                'type'       => 'VARCHAR',
                'constraint' => '128',
            ],
            'message' => [
                'type'       => 'VARCHAR',
                'constraint' => '256',
            ],
            'file' => [
                'type'       => 'VARCHAR',
                'constraint' => '256',
            ],
            'line' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'path' => [
                'type'       => 'VARCHAR',
                'constraint' => '256',
            ],
            'http_method' => [
                'type'       => 'VARCHAR',
                'constraint' => '256',
            ],
            'ip_address' => [
                'type'       => 'VARCHAR',
                'constraint' => '256',
            ],
            'is_ajax' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'is_cli' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'is_secure_request' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'user_agent' => [
                'type'       => 'VARCHAR',
                'constraint' => '256',
            ],
            'json' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('tb_debug');
    }

    public function down()
    {
        $this->forge->dropTable('tb_debug');
    }
}
