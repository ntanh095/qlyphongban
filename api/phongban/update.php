<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Truy vấn database
// 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
include_once(__DIR__ . '/../../dbconnect.php');

// 2. Chuẩn bị câu truy vấn $sql
// Lấy giá trị khóa chính được truyền theo dạng QueryString Parameter key1=value1&key2=value2...
$PB_MA = $_POST['PB_MA'];
$PB_TEN = $_POST['PB_TEN'];
$PB_GHICHU = $_POST['PB_GHICHU'];
$sql = "UPDATE `PHONGBAN` SET PB_TEN='$PB_TEN', PB_GHICHU='$PB_GHICHU' WHERE PB_MA='$PB_MA';";
// var_dump($sql);die;
// 3. Thực thi câu lệnh DELETE
$result = mysqli_query($conn, $sql);
$resultAffectedRows = mysqli_affected_rows($conn);

// 4. Đóng kết nối
mysqli_close($conn);
// var_dump($resultAffectedRows);die;

// Dữ liệu JSON, từ array PHP -> JSON
$responseData = [];
$responseData = [
    'statusCode' => 200,
    'msg' => 'Đã cập nhật dữ liệu thành công!'
];

echo json_encode($responseData);