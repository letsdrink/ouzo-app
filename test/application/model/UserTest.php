<?php

use Model\User;
use Ouzo\Tests\DbTransactionalTestCase;

class UserTest extends DbTransactionalTestCase
{
    /**
     * @test
     */
    public function shouldPersistUser()
    {
        //given
        $user = new User(array('login' => 'user1', 'password' => 'abc'));

        //when
        $user->insert();

        //then
        $this->assertEquals($user, User::where(array('login' => 'user1'))->fetch());
    }

}