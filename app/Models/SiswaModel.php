<?php
class SiswaModel extends Model{
    public function getAll($keyword=""){
        $sql = " 
            SELECT s.*, k.nama_kelas FROM siswa s
            LEFT JOIN kelas k ON s.id_kelas = k.id_kelas 
        ";

		// Digunakan untuk fitur pencarian
		if($keyword!=""){
			$sql .= " WHERE concat(s.nis, s.nama_siswa, k.nama_kelas) like '%$keyword%'";
		}
        $query = $this->db->query($sql);

        $hasil = [];
        while ($data = $query->fetch_assoc()) {
            $hasil[] = $data;
        }
        return $hasil;
    }

    public function getListKelas(){
        $sql = " SELECT id_kelas, nama_kelas FROM kelas ";
        $query = $this->db->query($sql);

        $hasil = [];
        while ($data = $query->fetch_assoc()) {
            $hasil[] = $data;
        }
        return $hasil;
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM siswa WHERE id_siswa = $id";
        $query = $this->db->query($sql);
        return $query->fetch_assoc();
    }

    public function insert($data)
    {   
        $nis = $data['nis'];
        $nama = $data['nama'];
        $jenkel = $data['jenkel'];
        $alamat = $data['alamat'];
        $no_hp = $data['no_hp'];
        $password = $data['password'];
        $id_kelas = $data['id_kelas'];

        $sql = "
			INSERT INTO siswa (nis, nama_siswa, jenkel, alamat, no_hp, password, id_kelas) 
			VALUES ('$nis', '$nama', '$jenkel', '$alamat', '$no_hp', '$password', $id_kelas)
		";
        return $this->db->query($sql);
    }

    public function update($id, $data)
    {
        $nis = $data['nis'];
        $nama = $data['nama'];
        $jenkel = $data['jenkel'];
        $alamat = $data['alamat'];
        $no_hp = $data['no_hp'];
        $password = $data['password'];
        $id_kelas = $data['id_kelas'];
        
		$sql = "
			UPDATE siswa SET 
			nis = '$nis', nama_siswa = '$nama', jenkel = '$jenkel', alamat = '$alamat', no_hp = '$no_hp', password = '$password', id_kelas = '$id_kelas' 
			WHERE id_siswa = $id ";
        return $this->db->query($sql);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM siswa WHERE id_siswa = $id";
        return $this->db->query($sql);
    }
}