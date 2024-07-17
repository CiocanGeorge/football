<?php
use Migrations\AbstractMigration;

class AddLogoTeam extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('matches');
        $table->addColumn('homeLogo', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('awayLogo', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->update();
    }
}
