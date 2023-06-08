<?php


include("KontrakView.php");
include("presenter/ProsesPasien.php");

class TampilPasien implements KontrakView
{
	private $prosespasien; //presenter yang dapat berinteraksi langsung dengan view
	private $tpl;

	function __construct()
	{
		//konstruktor
		$this->prosespasien = new ProsesPasien();
	}

	function tampil()
	{
		$this->prosespasien->prosesDataPasien();
		$data = null;
		$addButton = null;

        $addButton = '<button class="btn btn-primary" type="submit" name="add">Add New</button>';

		//semua terkait tampilan adalah tanggung jawab view
		for ($i = 0; $i < $this->prosespasien->getSize(); $i++) {
			$no = $i + 1;
			$data .= "<tr>
			<td>" . $no . "</td>
			<td>" . $this->prosespasien->getNik($i) . "</td>
			<td>" . $this->prosespasien->getNama($i) . "</td>
			<td>" . $this->prosespasien->getTempat($i) . "</td>
			<td>" . $this->prosespasien->getTl($i) . "</td>
			<td>" . $this->prosespasien->getGender($i) . "</td>
			<td>" . $this->prosespasien->getEmail($i) . "</td>
			<td>" . $this->prosespasien->getTelp($i) . "</td>
            <td>
            <a href='index.php?id_edit=" . $this->prosespasien->getId($i) .  "' class='btn btn-warning''>Edit</a>
            <a href='index.php?id_hapus=" . $this->prosespasien->getId($i) . "' class='btn btn-danger''>Hapus</a>
            </td>";
		}
		// Membaca template skin.html
		$this->tpl = new Template("templates/skin.html");

		// Mengganti kode Data_Tabel dengan data yang sudah diproses
		$this->tpl->replace("DATA_TABEL", $data);
		$this->tpl->replace("ADD_BUTTON", $addButton);

		// Menampilkan ke layar
		$this->tpl->write();
	}

	function addForm(){
		$form = null;
        $action = 'Add';

        $form .= '
        <div class="mb-3 mx-3">
            <label for="nik" class="form-label"> NIK: </label>
            <input type="text" name="nik" class="form-control">
        </div>
        <div class="mb-3 mx-3">
            <label for="nama" class="form-label"> Nama: </label>
            <input type="text" name="nama" class="form-control">
        </div>
        <div class="mb-3 mx-3">
            <label for="tempat" class="form-label"> Tempat: </label>
            <input type="text" name="tempat" class="form-control">
        </div>
        <div class="mb-3 mx-3">
            <label for="tl" class="form-label"> Tanggal Lahir: </label>
            <input type="date" name="tl" class="form-control">
        </div>
        <div class="mb-3 mx-3">
            <label for="gender" class="form-label"> Gender: </label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="gender" value="Perempuan">
                <label class="form-check-label" for="gender">Perempuan</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="gender2" value="Laki-laki">
                <label class="form-check-label" for="gender2">Laki-laki</label>
            </div>
        </div>
        <div class="mb-3 mx-3">
            <label for="email" class="form-label"> Email: </label>
            <input type="text" name="email" class="form-control">
        </div>
        <div class="mb-3 mx-3">
            <label for="telp" class="form-label"> Telp: </label>
            <input type="text" name="telp" class="form-control">
        </div>

        <div class="row my-3 justify-content-center">
            <div class="col-auto">
                <button class="btn btn-success" type="submit" name="add-submit">Submit</button>
                <a class="btn btn-info" type="submit" name="cancel" href="index.php">Cancel</a>
            </div>
        </div>';

		$this->tpl = new Template("templates/form.html");
		$this->tpl->replace("DATA_FORM", $form);
		$this->tpl->replace("DATA_ACTION", $action);

		// Menampilkan ke layar
		$this->tpl->write();
	}

	function editForm($id){
		$form = null;
        $action = 'Edit';
        
        $this->prosespasien->prosesDataPasienById($id);

        $form .= '
        <div class="mb-3 mx-3">
            <label for="nik" class="form-label"> NIK: </label>
            <input type="text" name="nik" class="form-control" value"' . $this->prosespasien->getNik(0).'">
        </div>
        <div class="mb-3 mx-3">
            <label for="nama" class="form-label"> Nama: </label>
            <input type="text" name="nama" class="form-control" value"' . $this->prosespasien->getNama(0).'">
        </div>
        <div class="mb-3 mx-3">
            <label for="tempat" class="form-label"> Tempat: </label>
            <input type="text" name="tempat" class="form-control" value"' . $this->prosespasien->getTempat(0).'">
        </div>
        <div class="mb-3 mx-3">
            <label for="tl" class="form-label"> Tanggal Lahir: </label>
            <input type="date" name="tl" class="form-control" value"' . $this->prosespasien->getTl(0).'">
        </div>
        <div class="mb-3 mx-3">
            <label for="gender" class="form-label"> Gender: </label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="gender" value="Perempuan">
                <label class="form-check-label" for="gender">Perempuan</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="gender2" value="Laki-laki">
                <label class="form-check-label" for="gender2">Laki-laki</label>
            </div>
        </div>
        <div class="mb-3 mx-3">
            <label for="email" class="form-label"> Email: </label>
            <input type="text" name="email" class="form-control" value"' . $this->prosespasien->getEmail(0).'">
        </div>
        <div class="mb-3 mx-3">
            <label for="telp" class="form-label"> Telp: </label>
            <input type="text" name="telp" class="form-control" value"' . $this->prosespasien->getTelp(0).'">
        </div>

        <div class="row my-3 justify-content-center">
            <div class="col-auto">
                <button class="btn btn-success" type="submit" name="edit-submit">Submit</button>
                <a class="btn btn-info" type="submit" name="cancel" href="index.php">Cancel</a>
            </div>
        </div>';

        $this->tpl = new Template("templates/form.html");
		$this->tpl->replace("DATA_FORM", $form);
		$this->tpl->replace("DATA_ACTION", $action);

		// Menampilkan ke layar
		$this->tpl->write();
	}

    function addPasien($data){
        $this->prosespasien->add($data);
    }

    function editPasien($id, $data){
        $this->prosespasien->edit($id, $data);
    }

    function deletePasien($id){
        $this->prosespasien->delete($id);
    }
}
