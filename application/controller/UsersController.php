<?php
namespace Controller;

use Model\User;
use Ouzo\Controller;

class UsersController extends Controller
{
    public function init()
    {
        $this->layout->setLayout('sample_layout');
    }

    public function index()
    {
        $this->view->users = User::all();
        $this->view->render();
    }

    public function fresh()
    {
        $this->view->user = new User();
        $this->view->render();
    }

    public function create()
    {
        $user = new User($this->params['user']);
        if ($user->isValid()) {
            $user->insert();
            $this->redirect(usersPath(), "User added");
        } else {
            $this->view->user = $user;
            $this->view->render('Users/fresh');
        }
    }
}