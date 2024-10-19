<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

// รวมไฟล์เชื่อมต่อฐานข้อมูล
include 'db_connection.php';

try {
    // ตรวจสอบการเชื่อมต่อฐานข้อมูล
    if ($db === false) {
        throw new Exception("ไม่สามารถเชื่อมต่อฐานข้อมูลได้");
    }

    // สร้างคำสั่ง SQL เพื่อดึงข้อมูลสินค้า
    $sql = "SELECT * FROM product";
    $result = mysqli_query($db, $sql);

    if (!$result) {
        throw new Exception("เกิดข้อผิดพลาดในการดึงข้อมูล");
    }

    $products = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $product[] = $row;
    }

    // ส่งข้อมูลสินค้ากลับในรูปแบบ JSON
    echo json_encode([
        "success" => 1,
        "products" => $product
    ]);

} catch (Exception $e) {
    echo json_encode([
        "success" => 0,
        "message" => $e->getMessage()
    ]);
}
?>
