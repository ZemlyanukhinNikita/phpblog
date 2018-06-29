<?php

namespace models;


use config\Database;

class News
{
    private $conn;

    /**
     * News constructor.
     */
    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function getAllNews()
    {
        $news = [];

        $query = $this->conn->query('select id, title, content, preview_image_slug, views from news');

        $i = 0;
        while ($row = $query->fetch()) {

            $news[$i]['id'] = $row['id'];
            $news[$i]['title'] = $row['title'];
            $news[$i]['content'] = $row['content'];
            $news[$i]['preview_image_slug'] = $row['preview_image_slug'];
            $news[$i]['views'] = $row['views'];
            $i++;
        }
        return $news;
    }

    public function getNewById($id)
    {
        $id = intval($id);

        if ($id) {
            $query = $this->conn->query('select id, title, content, preview_image_slug, views from news where id=' . $id);
            $query->setFetchMode(\PDO::FETCH_ASSOC);
            $newsItem = $query->fetch();
            return $newsItem;
        }
    }

}