<?php


use Phinx\Seed\AbstractSeed;

class UsersSeeder extends AbstractSeed
{
    /**
     * Run Method.
     * Write your database seeder using this method.
     */
    public function run()
    {
        $users = $this->table('users');
        $users->truncate();

        $data = [];
        $data[] = [
            'login' => 'admin',
            'password' => md5('123456'),
            'isAdmin' => 1
        ];

        $data[] = [
            'login' => 'mortal',
            'password' => md5('qwerty'),
            'isAdmin' => 0
        ];
        $users->insert($data)->save();

    }
}
