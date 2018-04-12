<?php namespace App\Models;

class User
{
    protected $id;
    protected $name;
    protected $username;
    protected $description;
    protected $followers_count;

    public function __construct($data)
    {
        $this->id = $data->id;
        $this->name = $data->name;
        $this->username = $data->screen_name;
        $this->description = $data->description;
        $this->followers_count = $data->followers_count ?? 0;
    }

    public function getName(): String {
        return $this->name;
    }

    public function getUsername(): String {
        return $this->username;
    }

    public function getDescription(): String {
        return $this->description;
    }

    public function getFollowersCount(): int {
        return $this->followers_count;
    }
}
