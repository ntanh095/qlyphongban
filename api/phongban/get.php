<?php
// Truy vấn database để lấy danh sách
// 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
include_once(__DIR__.'/../../dbconnect.php');

// 2. Chuẩn bị câu truy vấn $sql
$sqlSelect = "select * from `phongban`";

// Tìm theo tham số
$CV_MA = isset($_GET['PB_MA']) ? $_GET['PB_MA'] : '';

$sqlWhereArr = [];
if (!empty($PB_MA)) {
    $sqlWhereArr[] = "PB_MA = '$PB_MA'";
}

if (count($sqlWhereArr) > 0) {
    $sqlWhere = "WHERE " . implode(' AND ', $sqlWhereArr);
    $sqlSelect .= $sqlWhere;
}

// 3. Thực thi câu truy vấn SQL để lấy về dữ liệu
$result = mysqli_query($conn, $sqlSelect);

// 4. Khi thực thi các truy vấn dạng SELECT, dữ liệu lấy về cần phải phân tích để sử dụng

$dataPhongban = [];
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    $dataPhongban[] = array(
        'PB_MA' => $row['PB_MA'],
        'PB_TEN' => $row['PB_TEN'],
        'PB_GHICHU' => $row['PB_GHICHU']
    );
}

// 5. Chuyển đổi dữ liệu về định dạng JSON
$responseData = [];
if(count($dataPhongban) > 0) {
    $responseData = [
        'statusCode' => 200,
        'msg' => 'Đã tải dữ liệu thành công!',
        'data' => $dataPhongban
    ];
} else {
    $responseData = [
        'statusCode' => 500,
        'msg' => 'Không tìm thấy dữ liệu!',
        'data' => $dataPhongban
    ];
}
// Dữ liệu JSON, từ array PHP -> JSON
echo json_encode($responseData);