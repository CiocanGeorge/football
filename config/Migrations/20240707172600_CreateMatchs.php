<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateMatchs extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('matches');
        $table->addColumn('utcDate', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('status', 'string', [
            'default' => null,
            'limit' => 50,
            'null' => false,
        ]);
        $table->addColumn('matchday', 'integer', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('stage', 'string', [
            'default' => null,
            'limit' => 50,
            'null' => true,
        ]);
        $table->addColumn('lastUpdated', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('homeTeamId', 'integer', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('awayTeamId', 'integer', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('areaId', 'integer', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('competitionId', 'integer', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('seasonId', 'integer', [
            'default' => null,
            'null' => false,
        ]);
        $table->addPrimaryKey(['id']);
        $table->create();
    }
}
