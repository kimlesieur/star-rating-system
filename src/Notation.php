<?php
namespace App;
use \PDO;

class Notation {

    private $pdo;
    public $error;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getNotation($userId, $productId)
    {
        $notation = $this->pdo
                ->query("SELECT rating FROM star_rating WHERE user_id = {$userId} AND product_id = {$productId} LIMIT 1")
                ->fetch(PDO::FETCH_ASSOC);
                if(empty($notation))
                {
                    return 0;
                }
        return $notation["rating"];

    }

    public function getTotalCount($productId)
    {
        $count = $this->pdo
            ->query(
            "SELECT product_id, COUNT(user_id) AS count
             FROM star_rating
             WHERE product_id = $productId
             GROUP BY product_id")
             ->fetch(PDO::FETCH_ASSOC);
        return $count["count"];


    }

    public function getAverageNotation($productId)
    {
        $average = $this->pdo
            ->query(
                "SELECT product_id, ROUND(AVG(rating), 2) AS average
                FROM star_rating
                WHERE product_id = $productId
                GROUP BY product_id")
            ->fetch(PDO::FETCH_ASSOC);
        return $average["average"];
    }

    public function saveNotation($pid, $uid, $stars)
    {
        try {
            $this->pdo
                ->prepare("REPLACE INTO `star_rating` (`product_id`, `user_id`, `rating`) VALUES (?,?,?)")
                ->execute([$pid, $uid, $stars]);
            return true;
          } catch (\Exception $ex) {
            $this->error = $ex->getMessage();
            return false;
          }
    }





}


/* requête SQL pour avoir tableau moyennes et nb d'évaluations :

SELECT `product_id`, ROUND(AVG(`rating`), 2) AS rating, COUNT(`user_id`) AS count FROM `star_rating` GROUP BY `product_id` */