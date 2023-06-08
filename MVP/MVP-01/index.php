<?php

/******************************************
Asisten Pemrogaman 11
 ******************************************/

include("model/Template.class.php");
include("model/DB.class.php");
include("model/Pasien.class.php");
include("model/TabelPasien.class.php");
include("view/TampilPasien.php");


$tp = new TampilPasien();
if (isset($_POST['add'])) {
    $tp->addForm();
} else if (isset($_POST['add-submit'])) {
    $tp->addPasien($_POST);
} else if(isset($_POST['edit-submit'])){
    $id = $_GET['id_edit'];
    $tp->editPasien($id, $_POST);
}
else if (!empty($_GET['id_hapus'])) {
    $id = $_GET['id_hapus'];
    $tp->deletePasien($id);
} else if (!empty($_GET['id_edit'])) {
    $id = $_GET['id_edit'];
    $tp->editForm($id);
} else{
    $tp->tampil();
}