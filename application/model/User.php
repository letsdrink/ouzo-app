<?php
namespace Model;

use Ouzo\Model;

class User extends Model
{
    function __construct($attributes = array())
    {
        parent::__construct(array(
            'attributes' => $attributes,
            'fields' => array('login', 'password')));
    }

    public function validate()
    {
        parent::validate();
        $this->validateNotBlank($this->login, 'Login cannot be blank');
    }

}