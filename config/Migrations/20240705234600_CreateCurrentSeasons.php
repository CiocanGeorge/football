<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateCurrentSeasons extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('current_seasons');
        $table->addColumn('start_date', 'date')
              ->addColumn('end_date', 'date')
              ->addColumn('current_matchday', 'integer')
              ->addColumn('winner', 'string', ['limit' => 255, 'null' => true])
              ->create();
    }
}
