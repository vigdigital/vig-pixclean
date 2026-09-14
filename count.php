<?php
/**
 * VIG PixClean — bộ đếm lượt dùng (tự chủ, không bên thứ ba).
 *   GET count.php        -> đọc tổng hiện tại
 *   GET count.php?hit=1  -> +1 rồi trả tổng mới
 * Lưu trong count.txt cùng thư mục, dùng flock tránh race khi ghi đồng thời.
 */
header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');

$file = __DIR__ . '/count.txt';
$fp = @fopen($file, 'c+');
if ($fp === false) {
    http_response_code(500);
    echo json_encode(['count' => null, 'error' => 'store']);
    exit;
}

flock($fp, LOCK_EX);
$cur = (int) trim(stream_get_contents($fp));

if (isset($_GET['hit'])) {
    $cur++;
    rewind($fp);
    ftruncate($fp, 0);
    fwrite($fp, (string) $cur);
    fflush($fp);
}

flock($fp, LOCK_UN);
fclose($fp);

echo json_encode(['count' => $cur]);
