<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBookings extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'user_id' => ['type' => 'INT', 'unsigned' => true],
            'booking_code' => ['type' => 'VARCHAR', 'constraint' => 30],
            'booking_date' => ['type' => 'DATE'],
            'booking_start_time' => ['type' => 'TIME'],
            'booking_end_time' => ['type' => 'TIME', 'null' => true],
            'buffer_minutes_snapshot' => ['type' => 'INT', 'default' => 15],
            'payment_type' => ['type' => 'ENUM', 'constraint' => ['full', 'dp'], 'default' => 'full'],
            'total_price' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => 0],
            'dp_amount' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => 0],
            'remaining_amount' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => 0],
            'booking_status' => ['type' => 'ENUM', 'constraint' => ['pending_payment', 'pending_verification', 'confirmed', 'rejected', 'completed', 'cancelled'], 'default' => 'pending_payment'],
            'payment_deadline_at' => ['type' => 'DATETIME', 'null' => true],
            'cancel_reason' => ['type' => 'TEXT', 'null' => true],
            'status_reason' => ['type' => 'TEXT', 'null' => true],
            'cancelled_at' => ['type' => 'DATETIME', 'null' => true],
            'completed_at' => ['type' => 'DATETIME', 'null' => true],
            'notes' => ['type' => 'TEXT', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('booking_code');
        $this->forge->addKey('user_id');
        $this->forge->addKey(['booking_date', 'booking_status']);
        $this->forge->addKey('payment_deadline_at');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('bookings');
    }

    public function down()
    {
        $this->forge->dropTable('bookings');
    }
}
