<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller
{

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->view('contact_view');
    }
    public function contact_form(){
        //set validation rules
        $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean|callback_alpha_space_only');
        $this->form_validation->set_rules('email', 'Emaid ID', 'trim|required|valid_email');
        $this->form_validation->set_rules('subject', 'Subject', 'trim|required|xss_clean');
        $this->form_validation->set_rules('message', 'Message', 'trim|required|xss_clean');

        //run validation on form input
        if ($this->form_validation->run() == FALSE)
        {
            //validation fails
            $this->load->view('contact_view');
        }
        else
        {
            //get the form data
            $name = $this->input->post('name');
            $from_email = $this->input->post('email');
            $subject = $this->input->post('subject');
            $message = $this->input->post('message');

            //set to_email id to which you want to receive mails
            $to_email = 'alumni.cse.buet@gmail.com';

            //configure email settings
            $config['protocol'] = 'smtp';
            $config['smtp_host'] = 'ssl://smtp.gmail.com';
            $config['smtp_port'] = '465';
            $config['smtp_user'] = 'alumni.cse.buet@gmail.com';
            $config['smtp_pass'] = 'nazmulAlumni';
            $config['mailtype'] = 'html';
            $config['charset'] = 'iso-8859-1';
            $config['wordwrap'] = TRUE;
            $config['newline'] = "\r\n"; //use double quotes
            //$this->load->library('email', $config);
            $this->email->initialize($config);

            //send mail
            $this->email->from($from_email, $name);
            $this->email->to($to_email);
            $this->email->subject($subject);
            $this->email->message($message);
            if ($this->email->send())
            {
                // mail sent
                $data['success_msg'] = '<div class="alert alert-success text-center">Your mail has been sent successfully!<a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">×</a></div>';
                //$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Your mail has been sent successfully!</div>');
                //redirect('contact/index', $data);
                $this->load->view('contact_view', $data);
            }
            else
            {
                //error
                $data['error_msg'] = '<div class="alert alert-danger text-center">There is error in sending mail! Please try again later.<a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">×</a></div>';
                //$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">There is error in sending mail! Please try again later</div>');
                //redirect('contact/index');

                $this->load->view('contact_view', $data);
            }
        }
    }

    //custom validation function to accept only alphabets and space input
    function alpha_space_only($str)
    {
        if (!preg_match("/^[a-zA-Z ]+$/",$str))
        {
            $this->form_validation->set_message('alpha_space_only', 'The %s field must contain only alphabets and space');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
}
?>