<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateTeams extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('teams');
        $table->addColumn('name', 'string', ['limit' => 255])
              ->addColumn('shortName', 'string', ['limit' => 255])
              ->addColumn('tla', 'string', ['limit' => 3])
              ->addColumn('crest', 'string', ['limit' => 255])
              ->addColumn('address', 'string', ['limit' => 255])
              ->addColumn('website', 'string', ['limit' => 255])
              ->addColumn('founded', 'integer')
              ->addColumn('clubColors', 'string', ['limit' => 255])
              ->addColumn('venue', 'string', ['limit' => 255])
              ->addColumn('lastUpdated', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP'])
              ->create();
    }
}
