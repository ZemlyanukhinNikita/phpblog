<?php


use Phinx\Migration\AbstractMigration;

class CreateNewsTable extends AbstractMigration
{
    /**
     * Migrate up.
     */
    public function up()
    {
        $news = $this->table('news');
        $news
            ->addColumn('title', 'string', ['limit' => 100])
            ->addColumn('content', 'string')
            ->addColumn('preview_image_slug', 'string', ['null' => true])
            ->addIndex(['preview_image_slug'], ['unique' => true])
            ->save();
    }
}
