<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateApi extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('api');
        $table->addColumn('apiKey', 'string', ['limit' => 255])
              ->create();
        $table->insert(["apiKey" => "b10aca13f2654a608ccf860165b9b898"])->saveData();
    }
}
