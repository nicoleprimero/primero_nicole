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

    public function all()
{
    // Current page
    $page = 1;
    if (isset($_GET['page']) && ! empty($_GET['page'])) {
        $page = (int) $this->io->get('page');
    }

    // Search term
    $q = '';
    if (isset($_GET['q']) && ! empty($_GET['q'])) {
        $q = trim($this->io->get('q'));
    }

    // Records per page
    $records_per_page = 10;
    $allowed_per_page = [5, 10, 50, 100];
    if (isset($_GET['per_page']) && in_array((int)$_GET['per_page'], $allowed_per_page)) {
        $records_per_page = (int)$_GET['per_page'];
    }

    // Fetch records + total count
    $all = $this->UserModel->page($q, $records_per_page, $page);
    $data['users'] = $all['records'];
    $total_rows = $all['total_rows'];

    // Pagination setup
    $this->pagination->set_options([
        'first_link'     => '⏮ First',
        'last_link'      => 'Last ⏭',
        'next_link'      => 'Next →',
        'prev_link'      => '← Prev',
        'page_delimiter' => '&page='
    ]);
    $this->pagination->set_theme('bootstrap'); // or 'tailwind', or 'custom'
    $this->pagination->initialize($total_rows, $records_per_page, $page, site_url('users').'?q='.$q);

    // Pass pagination + query back to view
    $data['page'] = $this->pagination->paginate();
    $data['q'] = $q;

    // Render view
    $this->call->view('view_page', $data);
}


}