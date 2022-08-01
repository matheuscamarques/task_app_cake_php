<?php

use Cake\Log\Log;
use Migrations\AbstractMigration;

class TaskPrimaryKeyUUID extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        // TODO alter id index primary key to UUID.
        Log::alert("TODO alter id index primary key to UUID.");
    }
}
