<?php
use Migrations\AbstractMigration;

class over0FirstHalfPredictions extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('predictions');
        $table->addColumn('over0FirstHalf', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('under0FirstHalf', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->update();
    }
}
