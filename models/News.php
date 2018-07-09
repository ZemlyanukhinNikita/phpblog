<?php

namespace models;


use PDO;

class News extends Model
{
    private $conn;

    /**
     * News constructor.
     */
    public function __construct()
    {
        $this->conn = parent::getDbConnection();
    }

    /**
     * Метод получения всех новостей из базы данных
     * @return array
     */
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

    /**
     * Метод получения топ 10 новостей за посленднюю неделю
     * @return array
     */
    public function getTopNews()
    {
        $result = $this->conn->query("
            select * 
            from news 
            where created_at >= DATE_SUB(CURRENT_DATE, INTERVAL 7 DAY) 
            order by views 
            desc LIMIT 10
        ");
        $news = $result->fetchAll(PDO::FETCH_ASSOC);
        return $news;
    }

    /**
     * Метод получения одной новости по $id
     * @param $id
     * @return mixed|null
     */
    public function getNewById($id)
    {
        $id = intval($id);

        if ($id) {
            $stmt = $this->conn->prepare("select id, title, content, preview_image_slug, views
                                                    from news
                                                    where id = ?");
            $stmt->bindParam(1, $id);
            $stmt->execute();
            $newsItem = $stmt->fetch();
            return $newsItem;
        }
        return null;
    }

    /**
     * Метод обновления просмотров у новости
     * @param $id
     * @return null
     */
    public function updateViews($id)
    {
        $id = intval($id);

        if ($id) {
            $stmt = $this->conn->prepare("update news set views = views+1 where id=?");
            $stmt->bindParam(1, $id);
            $stmt->execute();
        }
        return null;
    }

    /**
     * Метод создания новости, возвращает $id только что соданной новости
     * @param $title
     * @param $content
     * @param $previewImage
     * @return string
     */
    public function createNew($title, $content, $previewImage)
    {
        $stmt = $this->conn->prepare("insert into news (title, content, preview_image_slug)
                                                values (?, ?, ?)");
        $stmt->bindParam(1, $title);
        $stmt->bindParam(2, $content);
        $stmt->bindParam(3, $previewImage);
        $stmt->execute();

        return $this->conn->lastInsertId();
    }

    /**
     * Метод обовления новости
     * @param $id
     * @param $title
     * @param $content
     * @param $previewImage
     * @return null
     */
    public function updateNew($id, $title, $content, $previewImage)
    {
        $id = intval($id);

        if ($id) {
            if ($previewImage) {
                $stmt = $this->conn->prepare("update news
                                                        set title=?, content=?, preview_image_slug=?
                                                        where id=?");
                $stmt->bindParam(1, $title);
                $stmt->bindParam(2, $content);
                $stmt->bindParam(3, $previewImage);
                $stmt->bindParam(4, $id);
                $stmt->execute();
            } else {
                $stmt = $this->conn->prepare("update news set title=?, content=? where id=?");
                $stmt->bindParam(1, $title);
                $stmt->bindParam(2, $content);
                $stmt->bindParam(3, $id);
                $stmt->execute();
            }
        }
        return null;
    }
}