<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePayments extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'booking_id' => ['type' => 'INT', 'unsigned' => true],
            'bank_account_id' => ['type' => 'INT', 'unsigned' => true],
            'bank_name_snapshot' => ['type' => 'VARCHAR', 'constraint' => 100],
            'account_number_snapshot' => ['type' => 'VARCHAR', 'constraint' => 50],
            'account_name_snapshot' => ['type' => 'VARCHAR', 'constraint' => 100],
            'payment_stage' => ['type' => 'ENUM', 'constraint' => ['full', 'dp', 'remaining'], 'default' => 'full'],
            'amount' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'sender_bank_name' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'sender_account_name' => ['type' => 'VARCHAR', 'constraint' => 100],
            'sender_account_number' => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'paid_at' => ['type' => 'DATETIME'],
            'uploaded_at' => ['type' => 'DATETIME', 'null' => true],
            'proof_file_path' => ['type' => 'VARCHAR', 'constraint' => 255],
            'proof_original_name' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'payment_status' => ['type' => 'ENUM', 'constraint' => ['pending', 'verified', 'rejected'], 'default' => 'pending'],
            'verified_by' => ['type' => 'INT', 'unsigned' => true, 'null' => true],
            'verified_at' => ['type' => 'DATETIME', 'null' => true],
            'reject_reason' => ['type' => 'TEXT', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('booking_id');
        $this->forge->addKey('bank_account_id');
        $this->forge->addKey('payment_status');
        $this->forge->addKey('paid_at');
        $this->forge->addKey('verified_at');
        $this->forge->addUniqueKey(['booking_id', 'payment_stage']);
        $this->forge->addForeignKey('booking_id', 'bookings', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('bank_account_id', 'bank_accounts', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('verified_by', 'users', 'id', 'SET NULL', 'SET NULL');
        $this->forge->createTable('payments');
    }

    public function down()
    {
        $this->forge->dropTable('payments');
    }
}
