<?php


use Phinx\Migration\AbstractMigration;

class AddTimestampsToTableNews extends AbstractMigration
{
    /**
     * Migrate up.
     */
    public function up()
    {
        $news = $this->table('news');
        $news->addTimestamps()->save();
    }
}
