<?php

namespace Snnyk\Yandex;

use Snnyk\Yandex\Request;

class Mail extends Request
{
    public function __construct($config)
    {
        parent::__construct($config);
    }

    public function getList()
    {
        return parent::getList();
    }

    public function addUser($params)
    {
        return parent::addUser($params);
    }

    public function deleteUser($username)
    {
        return parent::deleteUser($username);
    }

    public function editUser($params)
    {
        return parent::editUser($params);
    }
}