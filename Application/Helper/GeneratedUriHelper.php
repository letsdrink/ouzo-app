<?php
function indexUsersPath()
{
    return url(['string' => "/"]);
}

function usersPath()
{
    return url(['string' => "/users"]);
}

function freshUserPath()
{
    return url(['string' => "/users/fresh"]);
}

function editUserPath($id)
{
    return url(['string' => "/users/$id/edit"]);
}

function userPath($id)
{
    return url(['string' => "/users/$id"]);
}