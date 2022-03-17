<?php
namespace App\Model;

class Post
{
    public static function get($args) {
        return new \WP_Query($args);
    }
}
