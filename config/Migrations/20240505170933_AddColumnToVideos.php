<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AddColumnToVideos extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('videos');
        $table->addColumn('offset', 'integer', [
            'default' => null,
            'null' => true,
            'after' => 'url',
        ]);
        $table->update();
    }
}
