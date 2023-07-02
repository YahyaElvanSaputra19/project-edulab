<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Createtaskstable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'judul' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'status' => [
                'type' => 'INT',
                'constraint' => 1,
                'default' => 0,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('tasks');
    }

    public function down()
    {
        $this->forge->dropTable('tasks');
    }
}
