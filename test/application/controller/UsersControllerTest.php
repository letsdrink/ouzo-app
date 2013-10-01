<?php

use Model\User;
use Ouzo\Tests\ControllerTestCase;

class UsersControllerTest extends ControllerTestCase
{
    /**
     * @test
     */
    public function shouldRenderIndex()
    {
        //given

        //when
        $this->get('/users');

        //then
        $this->assertRenders('Users/index');
    }

    /**
     * @test
     */
    public function shouldRenderFreshWhenValidationErrorInCreate()
    {
        //when
        $this->post('/users', array('user' => array(
            'login' => ''
        )));

        //then
        $this->assertRenders('Users/fresh');
    }

    /**
     * @test
     */
    public function shouldRedirectToIndexOnSuccessInCreate()
    {
        //when
        $this->post('/users', array('user' => array(
            'login' => 'login'
        )));

        //then
        $this->assertRedirectsTo(usersPath());
    }

    /**
     * @test
     */
    public function shouldCreateUser()
    {
        //when
        $this->post('/users', array('user' => array(
            'login' => 'login'
        )));

        //then
        $this->assertNotNull(User::where(array('login' => 'login'))->fetch());
    }
}