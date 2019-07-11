<?php

namespace Selander\DemoApp\Models;

/**
 * Class Post
 * @Store\Table("post")
 * @Store\PrimaryKey("id")
 */
class Post
{
    /**
     * @Store\AutoIncrements("true")
     * @Store\Column("id")
     * @var integer
     */
    public $id;

    /**
     * @Store\Column("title")
     * @var string
     */
    public $title;

    /**
     * @Store\Column("content")
     * @var string
     */
    public $content;
}
