<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMachines extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'code' => ['type' => 'VARCHAR', 'constraint' => 50],
            'name' => ['type' => 'VARCHAR', 'constraint' => 100],
            'type' => ['type' => 'ENUM', 'constraint' => ['washer', 'dryer', 'combo']],
            'capacity_kg' => ['type' => 'DECIMAL', 'constraint' => '5,2', 'default' => 0],
            'price_per_hour' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'minimum_duration_minutes' => ['type' => 'INT', 'default' => 30],
            'duration_step_minutes' => ['type' => 'INT', 'default' => 30],
            'max_duration_minutes' => ['type' => 'INT', 'null' => true],
            'status' => ['type' => 'ENUM', 'constraint' => ['available', 'maintenance', 'broken', 'inactive'], 'default' => 'available'],
            'status_note' => ['type' => 'TEXT', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
            'deleted_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('code');
        $this->forge->addKey('status');
        $this->forge->addKey('type');
        $this->forge->createTable('machines');
    }

    public function down()
    {
        $this->forge->dropTable('machines');
    }
}
