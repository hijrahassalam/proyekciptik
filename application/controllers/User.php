<?php
class User extends CI_Controller {

	public function __construct(){
		parent::__construct();
		
		// cek keberadaan session 'username'	
		if (!isset($_SESSION['username'])){
			// jika session 'username' blm ada, maka arahkan ke kontroller 'login'
			redirect('login');
		}
	}


	// method hapus data buku berdasarkan id
	public function delete($username){
		$this->user_model->delUser($username);
		// arahkan ke method 'books' di kontroller 'dashboard'
		redirect('user/showuser');
	}

    public function ShowInsertUser(){
        $data['fullname'] = $_SESSION['fullname'];

        $this->load->view('dashboard/header', $data);
        $this->load->view('dashboard/adduser', $data);
        $this->load->view('dashboard/footer');	
    }

	// method untuk tambah data buku
	public function insert(){

		// baca data dari form insert buku
		$username = $_POST['username'];
		$fullname = $_POST['fullname'];
		$password = $_POST['password'];
		$role = $_POST['role'];

		// panggil method insertBook() di model 'book_model' untuk menjalankan query insert
		$this->user_model->insertUser($username, $fullname, $password, $role);

		// arahkan ke method 'books' di kontroller 'dashboard'
		redirect('user/showuser');
	}

	// method untuk edit data buku berdasarkan id
	public function edit($username){
		// get the data
		$data['user'] = $this->user_model->showUser($username);
		// get the user that edit from session
		$data['fullname'] = $_SESSION['fullname'];

		$this->load->view('dashboard/header', $data);
        $this->load->view('dashboard/edituser', $data);
        $this->load->view('dashboard/footer');		
	}

	// method untuk update data buku berdasarkan id
	public function update(){

        // baca data dari form insert buku
		$username = $_POST['username'];
		$fullname = $_POST['fullname'];
		$password = $_POST['password'];
		$role = $_POST['role'];

		// panggil method insertBook() di model 'book_model' untuk menjalankan query insert
		$this->user_model->editUser($username, $fullname, $password, $role);

		// arahkan ke method 'books' di kontroller 'dashboard'
		redirect('user/showuser');		
	}

	// view mirip seperti edit > get the data first
	public function view($id){
		// get the data
		$data['kategori'] = $this->kategori_model->showKategori($id);
		// get the user that edit from session
		$data['fullname'] = $_SESSION['fullname'];

		$this->load->view('dashboard/header', $data);
        $this->load->view('dashboard/viewkategori', $data);
        $this->load->view('dashboard/footer');	
	}

	// method untuk mencari data buku berdasarkan 'key'
	public function findKategori(){
		
		// baca key dari form cari data
		$key = $_POST['key'];

		// ambil session fullname untuk ditampilkan ke header
		$data['fullname'] = $_SESSION['fullname'];

		// panggil method findBook() dari model book_model untuk menjalankan query cari data
		$data['kategori'] = $this->kategori_model->findKategori($key);

		// tampilkan hasil pencarian di view 'dashboard/books'
		$this->load->view('dashboard/header', $data);
        $this->load->view('dashboard/kategori', $data);
        $this->load->view('dashboard/footer');
	}

	// method untuk menampilkan seluruh data buku
	public function showUser(){

		// panggil method showBook() dari book_model untuk membaca seluruh data buku
		$data['user'] = $this->user_model->showUser();

		$data['countBukuTeks'] = 0;
		$data['countMajalah'] = 0;
		$data['countSkripsi'] = 0;
		$data['countThesis'] = 0;
		$data['countDisertasi'] = 0;
		$data['countNovel'] = 0;

		// baca data session 'fullname' untuk ditampilkan di view
		$data['fullname'] = $_SESSION['fullname'];

		// tampilkan view 'dashboard/books'
		$this->load->view('dashboard/header', $data);
		$this->load->view('dashboard/user', $data);
		$this->load->view('dashboard/footer', $data);
	}        

}
?>