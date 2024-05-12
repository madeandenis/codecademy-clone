<?php

namespace app\utils;

use app\models\PricePlan;
use PDO;
use PDOException;

class PricingUtil {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getPricePlans(){
        try {
            $sqlQuery = "SELECT * FROM price_plans";
            $stmt = $this->pdo->query($sqlQuery);

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $pricePlans = [];
            foreach($results as $result) {
                $pricePlans[] = new PricePlan(
                    $result['name'],
                    $result['price'],
                    $result['billing'],
                    $result['description'],
                    $result['button_url'],
                    $result['button_text']
                );
            }

            return $pricePlans;

        } catch (PDOException $e) {
            die("Error fetching price plans: " . $e->getMessage());
        }
    }

    public function displayPricePlans(array $pricePlans){
        foreach ($pricePlans as $plan) {
            $className = strtolower($plan->getName());
            
            $priceParts = explode('.', $plan->getPrice());
            $integerPart = $priceParts[0];
            $floatingPart = $priceParts[1];
            echo "
                <div class='pricing-container {$className}'>
                    <div class='pricing-type'>
                        <p>{$plan->getName()}</p>
                    </div>
                    <div class='pricing-price'>
                        <h3><img src='assets/svg/Dollar-Sign-Sans-Serif.svg' class='dollar'></span>{$integerPart}</h3>
                        <p>{$plan->getBilling()}</p>
                        <div class='petty-cash'>
                            <h1>.{$floatingPart}</h1>
                            <p>/mo</p>
                        </div>
                    </div>
                    <div class='dotted-line-plan'>....................................................</div>
                    <div class='pricing-info'>
                        <p>{$plan->getDescription()}</p>
                    </div>
                    <div class='subsol-pricing'>
                        <a href='{$plan->getButtonUrl()}'><button class='link-button'>{$plan->getButtonText()}</button></a>
                    </div>
                </div>
            ";
        }
    }
}
