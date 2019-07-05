<?php

class Kategori_model extends CI_Model {

	// method untuk menampilkan data buku
	public function showKategori($id = false){
		// membaca semua data buku dari tabel 'kategori'
		if ($id == false){
			$query = $this->db->get('kategori');
			return $query->result_array();
		} else {
			// membaca data buku berdasarkan id
			$query = $this->db->get_where('kategori', array("idkategori" => $id));
			return $query->row_array();
		}
	}

	// method untuk hapus data buku berdasarkan id
	public function delKategori($id){
		$this->db->delete('kategori', array("idkategori" => $id));
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
	public function insertKategori($kategori){
		$data = array(
					"kategori" => $kategori,
		);
		$query = $this->db->insert('kategori', $data);
	}

	// edit 
	public function editKategori($idkategori,$kategori){
		$data = array(
			"idkategori"=>$idkategori,
			"kategori" => $kategori,
		);
		$this->db->where('idkategori', $idkategori);
		$query = $this->db->update('kategori', $data);		
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