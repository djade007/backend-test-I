<?php namespace App\Models;


class Tweet
{
    protected $id;
    protected $text;
    protected $user;

    public function __construct($data)
    {
        $this->id = $data->id;
        $this->text = $data->text;
        $this->user = new User($data->user);
    }

    public function getText(): String {
        return $this->text;
    }

    public function getUser(): User {
        return $this->user;
    }
}
