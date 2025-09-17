<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Controller: UserController
 * 
 * Automatically generated via CLI.
 */
class UserController extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->call->library('pagination');
        $this->call->library('session'); 
        
    }

    /*public function get_all(){
       
        $data['s'] = $this->UserModel->all();
        $this->call->view('get_all', $data);
    }*/
        public function landing_page() {
        $this->call->view('create');
    }

   

    public function create() {
        
        $this->call->library('form_validation');
        if($this->form_validation->submitted()){

    
            $username = $this->io->post('username');
            $email    = $this->io->post('email');
            $role     = $this->io->post('role');

            $this->UserModel->create($username, $email, $role);

           
            $this->session->set_flashdata('success','User added successfully!');
            redirect('users/view');
            }
            else
            {
                $this->call->view('add_User');
            }
        

           
    }

    public function update($id) {
         
        $data['user'] = $this->UserModel->find($id);
        if($this->io->method() === 'post'){
            $data = [
                'username' => $this->io->post('username'),
                'email' => $this->io->post('email'),
                'role' => $this->io->post('role')
            ];
            $this->UserModel->update($id, $data);
            redirect('users/view');
        }
        else
        {
            $this->call->view('update_User', $data);
        }
    }

    public function delete($id) {
        $this->UserModel->delete($id);
        redirect('users/view');
    }

    public function get_all($page = 1)
{
    try {
        // Per page settings
        $per_page = isset($_GET['per_page']) ? (int)$_GET['per_page'] : 5;
        $allowed_per_page = [5, 10, 50, 100];
        if (!in_array($per_page, $allowed_per_page)) {
            $per_page = 5;
        }

        // Search term
        $q = isset($_GET['q']) ? trim($_GET['q']) : '';

        // Ensure page is valid
        $page = max(1, (int)$page);

        // Offset for pagination
        $offset = ($page - 1) * $per_page;

        // Total rows + fetch data depending on search
        if ($q !== '') {
            $total_rows = $this->UserModel->count_filtered_records($q);
            $users = $this->UserModel->get_filtered_records($q, $per_page, $offset);
        } else {
            $total_rows = $this->UserModel->count_all_records();
            $users = $this->UserModel->get_records_with_pagination("LIMIT {$offset}, {$per_page}");
        }

        // Pagination setup
        $pagination_data = $this->pagination->initialize(
            $total_rows,
            $per_page,
            $page,
            'get_all',
            1
        );

        // Pass data to view
        $data['users']            = $users;
        $data['total_records']    = $total_rows;
        $data['pagination_data']  = $pagination_data;
        $data['pagination_links'] = $this->pagination->paginate();
        $data['error']            = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';
        $data['q']                = $q; // keep search value in view

        $this->call->view('view_page', $data);

    } catch (Exception $e) {
        $error_msg = urlencode($e->getMessage());
        redirect('users/get_all/1?error=' . $error_msg);
    }
}



}