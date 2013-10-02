<?php

function usersPath() {
    return url(array('string' => '/users'));
}

function addUserPath() {
    return url(array('string' => '/users/fresh'));
}

function showUserPath($user) {
    return url(array('string' => "/users/{$user->id}"));
}

function editUserPath($user) {
    return url(array('string' => "/users/{$user->id}/edit"));
}

function updateUserPath($user) {
    return url(array('string' => "/users/{$user->id}"));
}

