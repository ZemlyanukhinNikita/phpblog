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

        $stmt = $this->conn->query('select * from news');

        $i = 0;
        while ($row = $stmt->fetch()) {

            $news[$i]['id'] = $row['id'];
            $news[$i]['title'] = $row['title'];
            $news[$i]['content'] = $row['content'];
            $news[$i]['preview_image_slug'] = $row['preview_image_slug'];
            $news[$i]['views'] = $row['views'];
            $news[$i]['created_at'] = $row['created_at'];
            $news[$i]['updated_at'] = $row['updated_at'];
            $i++;
        }
        return $news;
    }

    public function getNewById($id)
    {
        $id = intval($id);

        if ($id) {
            $stmt = $this->conn->prepare("select id, title, content, preview_image_slug, views from news where id = ?");
            $stmt->bindParam(1, $id);
            $stmt->execute();
            $newsItem = $stmt->fetch();
            return $newsItem;
        }
        return null;
    }

    public function updateViews($id)
    {
        $id = intval($id);

        if ($id) {
            $stmt = $this->conn->prepare("UPDATE news set views = views+1 where id=?");
            $stmt->bindParam(1, $id);
            $stmt->execute();
        }
        return null;
    }

    private function replacingEmptyStringWithNull($value)
    {
        if ($value === '') {
            return null;
        }
        return $value;
    }


    public function createNew($title, $content, $previewImage)
    {

        $previewImage = $this->replacingEmptyStringWithNull($previewImage);

        $stmt = $this->conn->prepare("INSERT INTO news (title, content, preview_image_slug) VALUES (?, ?, ?)");
        $stmt->bindParam(1, $title);
        $stmt->bindParam(2, $content);
        $stmt->bindParam(3, $previewImage);
        $stmt->execute();

        return $this->conn->lastInsertId();
    }

    public function editNew($id, $title, $content, $previewImage)
    {
        $id = intval($id);
        if ($id) {

            $previewImage = $this->replacingEmptyStringWithNull($previewImage);

            $stmt = $this->conn->prepare("UPDATE news set title=?, content=?, preview_image_slug=? where id=?");
            $stmt->bindParam(1, $title);
            $stmt->bindParam(2, $content);
            $stmt->bindParam(3, $previewImage);
            $stmt->bindParam(4, $id);
            $stmt->execute();

            return true;
        }
        return null;
    }

}