<?php 
namespace App;

class Products {

    private $id;
    private $name;
    private $description;
    private $price;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

}