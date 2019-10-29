<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Add_agama extends CI_Migration
{
	public function up()
	{
				$this->dbforge->add_field([
									'id_agama'          => [
													'type'           => 'INT',
													'constraint'     => 5,
													'auto_increment' => TRUE
									],
									'agama'       => [
													'type'           => 'VARCHAR',
													'constraint'     => '50',
									],
					]);
					$this->dbforge->add_key('id_agama', TRUE);
					$this->dbforge->create_table('tb_agama');
	}

	public function down()
	{
					$this->dbforge->drop_table('tb_agama');
	}
}
