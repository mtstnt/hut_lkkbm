<?php
defined('BASEPATH') OR exit('No direct scripts are allowed');

class Wishlist extends CI_Controller {
    public function __construct() {
        parent::__construct();

        if (!$this->session->userdata('user')) {
            $this->session->set_flashdata('err', 'Please log in first');
            return redirect('admin/auth');
        }

        $this->load->helper('functions');
        $this->load->model('Wishlist_model');
    }

    public function index () {
        $data = array();
        $data['wishlist'] = $this->Wishlist_model->getAdmin()->result();
        // $data['query'] = mysql_query("SELECT wishlist.nama, wishlist.content, wishlist.nrp, jurusan.nama AS Jurusan FROM jurusan JOIN wishlist ON jurusan.id = wishlist.jurusan_id");
        $data['counter'] = 1;
        $data['page'] = 'wishlist';
        // $data['jurusan'] = mysql_query("SELECT jurusan.nama FROM jurusan JOIN wishlist ON jurusan.id = wishlist.jurusan_id");
        load_admin($this->load, 'admin/wishlist/index', $data);
    }

    public function delete ($id) {
        $wishlist = $this->Wishlist_model->find($id)->result();

        if (count($wishlist) == 0) {
            return show_404();
        }
        if ($this->Wishlist_model->delete($id)) {
			$this->session->set_flashdata('ok', 'Berhasil delete!');
		} else {
			$this->session->set_flashdata('err', 'Gagal delete!');
		}
		return redirect('admin/wishlist');
    }

    public function deleteAll () {
        if (isset($_POST['ids'])) {
            $ids = explode(',', $_POST['ids']);

            $results = $this->Wishlist_model->deleteById($ids);
            if ($results === TRUE) {
                $this->session->set_flashdata('ok', 'Berhasil delete!');
            } else {
                $this->session->set_flashdata('err', 'Gagal delete!');
            }
        }
        else {
            $this->session->set_flashdata('err', 'Pilih minimal satu baris !');
        }
    }
}
