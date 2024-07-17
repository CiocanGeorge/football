<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateScore extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('scores');
        $table->addColumn('match_id', 'integer', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('winner', 'string', [
            'default' => null,
            'null' => true,
            'limit' => 50,
        ]);
        $table->addColumn('duration', 'string', [
            'default' => null,
            'null' => true,
            'limit' => 50,
        ]);
        $table->addColumn('full_time_home', 'integer', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('full_time_away', 'integer', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('half_time_home', 'integer', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('half_time_away', 'integer', [
            'default' => null,
            'null' => true,
        ]);
        $table->addForeignKey('match_id', 'matches', 'id', ['delete'=> 'CASCADE', 'update'=> 'CASCADE']);
        $table->create();
    }
}
