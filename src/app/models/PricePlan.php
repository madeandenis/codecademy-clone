<?php

namespace app\models;

class PricePlan {
    private $name;
    private $price;
    private $billing;
    private $description;
    private $buttonUrl;
    private $buttonText;

    public function __construct($name, $price, $billing, $description, $buttonUrl, $buttonText) {
        $this->name = $name;
        $this->price = $price;
        $this->billing = $billing;
        $this->description = $description;
        $this->buttonUrl = $buttonUrl;
        $this->buttonText = $buttonText;
    }

    public function getName() {
        return $this->name;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getBilling() {
        return $this->billing;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getButtonUrl() {
        return $this->buttonUrl;
    }

    public function getButtonText() {
        return $this->buttonText;
    }
}
