<?php


use Phinx\Migration\AbstractMigration;

class AddFieldViewsToTableNews extends AbstractMigration
{
    /**
     * Migrate up.
     */
    public function up()
    {
        $news = $this->table('news');
        $news
            ->addColumn('views', 'integer', ['null' => true])
            ->save();
    }
}
