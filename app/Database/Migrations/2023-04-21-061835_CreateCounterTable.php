<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCounterTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type' => 'int',
                'constraint' => 11, 
                'unsigned' => true
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '128',
            ],
            'created_at' => [
				'type' => 'DATETIME',
				'null' => true,
			],
			'updated_at' => [
				'type' => 'DATETIME',
				'null' => true,
			],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', '', 'CASCADE');
        $this->forge->createTable('counters');
    }

    public function down()
    {
        $this->forge->dropTable('counters');
    }
}
