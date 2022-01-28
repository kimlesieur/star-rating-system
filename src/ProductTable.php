<?php 
namespace App;
use \PDO;

class ProductTable {

    protected $pdo;
    private $items;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getProducts(string $class)
    {
        $this->items = $this->pdo
                        ->query("SELECT * FROM products")
                        ->fetchAll(PDO::FETCH_CLASS, $class);
        return $this->items;

    }


}