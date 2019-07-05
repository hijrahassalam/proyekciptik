<?php

class User_model extends CI_Model {

	// method untuk membaca data profile user berdasar username
	public function getUserProfile($username){
		$query = $this->db->get_where('users', array('username' => $username));
		return $query->row_array();
	}

	// method untuk menampilkan data buku
	public function showUser($username = false){
		// membaca semua data buku dari tabel 'users'
		if ($username == false){
			$query = $this->db->get('users');
			return $query->result_array();
		} else {
			// membaca data buku berdasarkan id
			$query = $this->db->get_where('users', array("username" => $username));
			return $query->row_array();
		}
	}

	// method untuk hapus data buku berdasarkan id
	public function delUser($username){
		$this->db->delete('users', array("username" => $username));
	}

	// method untuk mencari data buku berdasarkan key
	public function findBook($key){

		$query = $this->db->query("SELECT * FROM books WHERE judul LIKE '%$key%' 
									OR pengarang LIKE '%$key%' 
									OR penerbit LIKE '%$key%'
									OR sinopsis LIKE '%$key%'
									OR thnterbit LIKE '%$key%'");
		return $query->result_array();
	}

	// method untuk insert data buku ke tabel 'books'
	public function insertUser($username, $fullname, $password, $role){
		$data = array(
					"username" => $username,
					"fullname" => $fullname, "password" => $password,"role" => $role
		);
		$query = $this->db->insert('users', $data);
	}

	// edit 
	public function editUser($username, $fullname, $password, $role){
		$data = array(
					"username" => $username,
					"fullname" => $fullname, "password" => $password,"role" => $role
		);
		$this->db->where('username', $username);
		$query = $this->db->update('users', $data);		
	}

	// method untuk membaca data kategori buku dari tabel 'kategori'
	public function getKategori(){
		$query = $this->db->get('kategori');
		return $query->result_array();
	}

	// method untuk menghitung jumlah buku berdasarkan idkategori
	public function countByCat($idkategori){
		$query = $this->db->query("SELECT count(*) as jum FROM books WHERE idkategori = '$idkategori'");
		return $query->row()->jum;
	}


}

?>