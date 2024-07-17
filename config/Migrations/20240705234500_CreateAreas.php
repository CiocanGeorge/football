<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateAreas extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('areas');
        $table->addColumn('name', 'string', ['limit' => 255])
              ->addColumn('code', 'string', ['limit' => 3])
              ->addColumn('flag', 'string', ['limit' => 255])
              ->create();
    }
}
