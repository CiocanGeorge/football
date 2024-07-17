<?php
use Migrations\AbstractMigration;

class over1Predictions extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('predictions');
        $table->addColumn('over1', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('under1', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->update();
    }
}
