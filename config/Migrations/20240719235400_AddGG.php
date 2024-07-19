<?php
use Migrations\AbstractMigration;

class AddGG extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('predictions');
        $table->addColumn('gg', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);

        $table->update();
    }
}
