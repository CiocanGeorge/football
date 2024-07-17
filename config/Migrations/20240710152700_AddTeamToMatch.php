<?php
use Migrations\AbstractMigration;

class AddTeamToMatch extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('matches');
        $table->addColumn('homeName', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('awayName', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->update();
    }
}
