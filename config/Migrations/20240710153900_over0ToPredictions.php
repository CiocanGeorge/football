<?php
use Migrations\AbstractMigration;

class over0ToPredictions extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('predictions');
        $table->addColumn('over0', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('under0', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->update();
    }
}
