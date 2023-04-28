<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateQueueTable extends Migration
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
            'counter_id' => [
                'type' => 'int',
                'constraint' => 11, 
                'unsigned' => true
            ],
            'current_queue' => [
                'type' => 'int',
                'constraint' => 10,
                'default' => 0,
                'null' => true
            ],
            'total_queue' => [
                'type' => 'int',
                'constraint' => 10,
                'default' => 0,
                'null' => true
            ],
            'date' => [
				'type' => 'DATE',
				'null' => true,
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
        $this->forge->addForeignKey('counter_id', 'counters', 'id', '', 'CASCADE');
        $this->forge->createTable('queues');
    }

    public function down()
    {
        $this->forge->dropTable('queues');
    }
}
