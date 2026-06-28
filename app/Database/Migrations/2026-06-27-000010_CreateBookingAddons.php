<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBookingAddons extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'booking_id' => ['type' => 'INT', 'unsigned' => true],
            'addon_id' => ['type' => 'INT', 'unsigned' => true],
            'addon_name_snapshot' => ['type' => 'VARCHAR', 'constraint' => 120],
            'unit_price_snapshot' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => 0],
            'quantity' => ['type' => 'INT', 'default' => 1],
            'subtotal' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => 0],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('booking_id');
        $this->forge->addKey('addon_id');
        $this->forge->addForeignKey('booking_id', 'bookings', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('addon_id', 'addons', 'id', 'CASCADE', 'RESTRICT');
        $this->forge->createTable('booking_addons');
    }

    public function down()
    {
        $this->forge->dropTable('booking_addons');
    }
}
