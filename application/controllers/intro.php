<?php
class Intro extends CI_Controller {
    private $title=array('title'=>'Вход');
    
    public function __construct() {
     
        parent::__construct();
        if($this->session->userdata('logged_in')){ redirect("zayavki");  }
        
    }
    
    public function index()
		{     
                        $this->load->view('templates/header',$this->title);
                        $this->load->view('pages/intro');
                        $this->load->view('templates/footer');
		}

        public function login_valid()
        {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('login', 'Логин', 'trim|required|min_length[3]|max_length[15]|xss_clean');
            $this->form_validation->set_rules('pass', 'Пароль', 'required');
            if($this->form_validation->run())
            {
		 $this->load->model('intromodel');
                 $data['usin']= $this->intromodel->get_us($this->input->post('login'), $this->input->post('pass'));
                 if(empty($data['usin'])){$data['ermes']='Неправильный Логин/Пароль';
				
                                $this->load->view('templates/header',$this->title);
                                $this->load->view('pages/intro',$data);
                                $this->load->view('templates/footer');
						}
					
			else{
                          
                            $newdata = array(
						'uid'     => $data['usin'][0]->id,
						'ceh'     => $data['usin'][0]->ceh,
                                                'fam'     => $data['usin'][0]->fam,
						'logged_in' => TRUE
						);
						$this->session->set_userdata($newdata);
						redirect('zayavki');
						}
			}
            else {$this->load->view('templates/header',$this->title);
                  $this->load->view('pages/intro');
                  $this->load->view('templates/footer'); } 
	}

}

