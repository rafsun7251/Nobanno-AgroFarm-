<?php

require_once __DIR__ . '/Database.php';

class OrderItem
{
    private mysqli $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->connect();
    }


    // ==========================================
    // ADD ITEM
    // ==========================================

    public function create(
        int $orderId,
        int $cropId,
        int $quantity,
        float $pricePerKg
    ): int|false {

        $subtotal =
            $quantity * $pricePerKg;

        $sql = "
            INSERT INTO order_items
            (
                order_id,
                crop_id,
                quantity,
                price_per_kg,
                subtotal
            )
            VALUES (?, ?, ?, ?, ?)
        ";

        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            return false;
        }

        $stmt->bind_param(
            "iiddi",
            $orderId,
            $cropId,
            $quantity,
            $pricePerKg,
            $subtotal
        );

        if ($stmt->execute()) {
            return $stmt->insert_id;
        }

        return false;
    }


    // ==========================================
    // GET ORDER ITEMS
    // ==========================================

    public function getByOrder(
        int $orderId
    ): array {

        $sql = "
            SELECT
                oi.*,
                c.crop_name,
                c.category,
                c.unit,
                c.farmer_id,
                f.farm_name

            FROM order_items oi

            INNER JOIN crops c
                ON oi.crop_id = c.crop_id

            INNER JOIN farmers f
                ON c.farmer_id = f.farmer_id

            WHERE oi.order_id = ?

            ORDER BY oi.order_item_id ASC
        ";

        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            return [];
        }

        $stmt->bind_param(
            "i",
            $orderId
        );

        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_all(
            MYSQLI_ASSOC
        );
    }
}