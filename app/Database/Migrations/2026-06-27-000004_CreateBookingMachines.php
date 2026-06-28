<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBookingMachines extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'booking_id' => ['type' => 'INT', 'unsigned' => true],
            'machine_id' => ['type' => 'INT', 'unsigned' => true],
            'machine_name_snapshot' => ['type' => 'VARCHAR', 'constraint' => 100],
            'machine_code_snapshot' => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'machine_start_time' => ['type' => 'TIME'],
            'machine_end_time' => ['type' => 'TIME'],
            'available_again_time' => ['type' => 'TIME'],
            'duration_minutes' => ['type' => 'INT'],
            'price_per_hour_snapshot' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'subtotal' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('booking_id');
        $this->forge->addKey('machine_id');
        $this->forge->addKey(['machine_id', 'machine_start_time', 'machine_end_time']);
        $this->forge->addUniqueKey(['booking_id', 'machine_id']);
        $this->forge->addForeignKey('booking_id', 'bookings', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('machine_id', 'machines', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('booking_machines');
    }

    public function down()
    {
        $this->forge->dropTable('booking_machines');
    }
}
