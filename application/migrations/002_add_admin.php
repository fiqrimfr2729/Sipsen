<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Add_admin extends CI_Migration
{
	public function up()
	{
		$this->forge->addField([
							'username'          => [
											'type'           => 'VARCHAR',
											'constraint'     => '50',
							],
							'password'       => [
											'type'           => 'VARCHAR',
											'constraint'     => '255',
							],
			]);
			$this->forge->addKey('username', TRUE);
			$this->forge->createTable('tb_admin');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('tb_admin');
	}
}
