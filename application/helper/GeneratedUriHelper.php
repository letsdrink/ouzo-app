<?php
function indexUsersPath()
{
    return url(array('string' => "/"));
}

function usersPath()
{
    return url(array('string' => "/users"));
}

function freshUserPath()
{
    return url(array('string' => "/users/fresh"));
}

function editUserPath($id)
{
    return url(array('string' => "/users/$id/edit"));
}

function userPath($id)
{
    return url(array('string' => "/users/$id"));
}