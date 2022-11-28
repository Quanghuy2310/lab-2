<?php
require_once '../global.php';
require_once '../model/pdo.php';
require_once '../model/product.php';
require_once '../model/order.php';

if (isset($_GET['chi-tiet'])) {
    $product = getProductById($_GET['id']);
    $VIEW_NAME = 'chi-tiet.php';
} elseif (isset($_GET['danh-muc'])) {
    $VIEW_NAME = 'danh-muc.php';
} elseif (isset($_GET['gio-hang'])) {
    $VIEW_NAME = 'gio-hang.php';
} elseif (isset($_GET['dat-hang'])) {
    if (count($_POST) == 0) {
        $url = SITE_URL;
        header("location: $url?gio-hang");
        return;
    }
    if (isset($_POST['dat-hang'])) {
        $user_id = 2;
        $orderId = add_order($user_id, $_POST['total'])['id'];

        for ($i = 0; $i < count($_POST['prdId']); $i++) {
            add_order_detail($_POST['prdId'][$i], $orderId, $_POST['sl'][$i]);
        }
        $url = SITE_URL;
        header("location: $url?purchase");
    }

    $VIEW_NAME = 'dat-hang.php';
} elseif (isset($_GET['purchase'])) {
    $VIEW_NAME = 'purchase.php';
} else {
    $products = getFullProducts();
    $VIEW_NAME = 'trang-chu.php';
}

include_once './layout.php';
