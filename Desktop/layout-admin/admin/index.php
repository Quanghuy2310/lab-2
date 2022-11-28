<?php

require_once '../global.php';
require_once '../model/pdo.php';
require_once '../model/danh_muc.php';
require_once '../model/product.php';
// include_once '../model/danh_muc.php';
// $show_error=getConnect();
// echo $show_error;
if (isset($_GET['danh-muc'])) {
    $show_dm = loadall_danh_muc();
    $VIEW_AD = './danh-muc/danh-sach.php';
} elseif (isset($_GET['add-danh-muc'])) {
    if (isset($_POST['themmoi'])) {
        $tenloai = $_POST['tenloai'];
        add_danh_muc($tenloai);
        $msg="Thêm danh mục thành công";
    }
    $VIEW_AD = './danh-muc/add-danh-muc.php';
} elseif (isset($_GET['delete'])) {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        delete_danh_muc($id);
    }
    $show_dm = loadall_danh_muc();
    $VIEW_AD = './danh-muc/danh-sach.php';
} elseif (isset($_GET['edit'])) {
    if (isset($_GET['id'])) {
        $edit = loadone_danh_muc($_GET['id']);
    }
    $sql = "SELECT * FROM `groupproduct` order by id desc";
    $edit_dm = pdo_query_one($sql);
    $VIEW_AD = './danh-muc/edit-danh-muc.php';
} elseif (isset($_GET['update'])) {
    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        update_danh_muc($id, $name);
    }
    $show_dm = loadall_danh_muc();
    $VIEW_AD = './danh-muc/danh-sach.php';
} elseif (isset($_GET['san-pham'])) {
    $list_pro = getFullProducts();
    $VIEW_AD = './san-pham/danh-sach.php';
} elseif (isset($_GET['add-san-pham'])) {
    if (isset($_POST['add-san-pham'])) {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $priceNew = $_POST['sale'];
        $detail = $_POST['detail'];
        $description = $_POST['description'];
        $date = $_POST['date'];
        $image = $_FILES['image']['name'];
        // $groupProduct_Id=$_POST['groupProduct_Id'];
        //upload ảnh
        $folder = "../upload/";
        $targerupload = $folder . basename($_FILES['image']['name']);
        $targetupload = $folder . basename($_FILES['image']['name']);
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetupload)) {
        } else {
        }
        insertProduct($name, $detail, $image,$price,$date,$priceNew,$description);
    }
    $VIEW_AD = './san-pham/add-san-pham.php';
} elseif (isset($_GET['delete-sanpham'])) {
    if (isset($_GET['id'])) {
        $id_pro = $_GET['id'];
        deleteProduct($id_pro);
    }
    $list_pro = getFullProducts();
    $VIEW_AD = './san-pham/danh-sach.php';
} elseif (isset($_GET['delete-tai-khoan'])) {
    $VIEW_AD = '../danh-muc/edit-danh-muc.php';
} else {
    $VIEW_AD = 'home.php';
}
// require_once './danh-muc/    index.php';

include_once './layout.php';

?>
<img src="../upload/" alt="">