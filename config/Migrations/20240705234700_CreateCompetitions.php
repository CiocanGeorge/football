<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateCompetitions extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('competitions');
        $table->addColumn('area_id', 'integer')
              ->addColumn('name', 'string', ['limit' => 255])
              ->addColumn('code', 'string', ['limit' => 3])
              ->addColumn('type', 'string', ['limit' => 255])
              ->addColumn('emblem', 'string', ['limit' => 255])
              ->addColumn('plan', 'string', ['limit' => 255])
              ->addColumn('current_season_id', 'integer')
              ->addColumn('number_of_available_seasons', 'integer')
              ->addColumn('last_updated', 'datetime')
              ->addForeignKey('area_id', 'areas', 'id')
              ->addForeignKey('current_season_id', 'current_seasons', 'id')
              ->create();
    }
}
