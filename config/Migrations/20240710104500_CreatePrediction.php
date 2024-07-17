<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreatePrediction extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('predictions');
        $table->addColumn('matchId', 'integer', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('over2.5', 'string', [
            'default' => null,
            'null' => true,
            'limit' => 50,
        ]);
        $table->addColumn('under2.5', 'string', [
            'default' => null,
            'null' => true,
            'limit' => 50,
        ]);
        $table->addForeignKey('matchId', 'matches', 'id', ['delete'=> 'CASCADE', 'update'=> 'CASCADE']);
        $table->create();
    }
}
