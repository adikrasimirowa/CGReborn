<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grades extends CI_Controller{
	public function __construct()
    {
        parent::__construct();
        $is_logged = $this->session->userdata('is_logged');
        if (!(isset($is_logged) && $is_logged == TRUE))
        {
            redirect('login/index');
        }
        $this->load->model('classes_model');
    }
    public function show_teacher_classes()
    {
    	$this->load->helper('url');
    	$data['show_classes']=$this->classes_model->get_teach_classes($this->session->userdata('user_id'));
    	$data['dynamic_view'] = 'grades/teacher_classes_list';
        $this->load->view('admin/main_template', $data);
    }

    public function show_class_grades($teacher_class_id, $class_year, $subject_id, $class_id)
    {
        $this->output->enable_profiler(TRUE);
        $this->benchmark->mark('start');
        $this->load->model('doi_model');
        $this->load->model('classes_model');
        $this->load->model('grades_model');

        $data['class_doi'] = $this->doi_model->get_all_class_doi($class_year, $subject_id);
        $data['students_list'] = $this->classes_model->show_students_info($class_id);
        
        //TODO - optimize
        $doi_ids = array();
        $student_ids = array();

        if(count($data['students_list'])>0 && count($data['class_doi'])>0)
        {
            foreach ($data['students_list'] as $key => $value) {
                $student_ids[] = $value['student_id'];
                $student_names = $value['first_name'] . ' ' . $value['last_name'];

                foreach ($data['class_doi'] as $key2 => $value2) {
                    $doi_ids[] = $value2['doi_id'];
                    $student_doi_matrix[$student_names][$value2['doi_id']] = 0;
                    $student_doi_matrix[$student_names]['student_id'] = $value['student_id'];
                }
            }
            $data['students_grades'] = $this->grades_model->get_all_teacher_class_grades($doi_ids, $student_ids);
            //NOTE: here we rely on doi_id order, so in both $data['class_doi'] and $data['students_grades'] queries MUST be oredered by doi_id
            foreach ($data['students_grades'] as $key => $value) {
                $student_names = $value['first_name'] . ' ' . $value['last_name'];
                $student_doi_matrix[$student_names][$value['doi_id']] = $value['max_grade'];
            }
        }else
        {
            $student_doi_matrix = array();
        }
        
        $data['student_doi_matrix'] = $student_doi_matrix;
        $data['class_year'] = $class_year;
        $data['subject_id'] = $subject_id;
        $data['class_id'] = $class_id;
        $data['teacher_class_id'] = $teacher_class_id;
        $data['dynamic_view'] = 'grades/class_grades_view';
        
        //print_r($student_doi_matrix);
        $this->load->view('admin/main_template', $data);

        $this->benchmark->mark('end');
        $this->benchmark->elapsed_time('start', 'end');
    }

    public function add_grades_class($teacher_class_id, $class_year, $subject_id, $class_id)
    {
        $this->load->model('doi_model');
        $this->load->model('classes_model');

        $data['class_doi'] = $this->doi_model->get_all_class_doi($class_year, $subject_id);
        $data['students_list'] = $this->classes_model->show_students_info($class_id);
        $data['class_year'] = $class_year;
        $data['subject_id'] = $subject_id;
        $data['class_id'] = $class_id;
        $data['teacher_class_id'] = $teacher_class_id;
        $data['dynamic_view'] = 'grades/add_grades_class_view';
        
        $this->load->view('admin/main_template', $data);
    }

    public function add_grades_student($teacher_class_id, $class_year, $subject_id, $class_id, $student_id)
    {
        $this->load->model('doi_model');
        $this->load->model('classes_model');

        $data['class_doi'] = $this->doi_model->get_all_class_doi($class_year, $subject_id);
        $data['student_data'] = $this->classes_model->single_student_info($student_id);
        $data['class_year'] = $class_year;
        $data['subject_id'] = $subject_id;
        $data['class_id'] = $class_id;
        $data['teacher_class_id'] = $teacher_class_id;
        $data['dynamic_view'] = 'grades/add_grades_student_view';
        
        $this->load->view('admin/main_template', $data);
    }

    public function insert_grades_class()
    {
        $this->load->model('grades_model');
        
        $this->grades_model->insert_grades_class();
        $this->session->set_flashdata('success_msg', 'Успешно добавихте оценяване за целия клас!');
        //TODO - redirect to show_class_grades($this->input->post('teacher_class_id'), $this->input->post('class_year'), $this->input->post('subject_id'), $this->input->post('class_id'));
        // $this->session->set_flashdata('class_year', $this->input->post('class_year'));
        // $this->session->set_flashdata('class_year', $this->input->post('class_year'));
        // $this->session->set_flashdata('subject_id', $this->input->post('subject_id'));
        // $this->session->set_flashdata('class_id', $this->input->post('class_id'));

        redirect('grades/show_teacher_classes');
    }

    public function insert_grades_student()
    {
        $this->load->model('grades_model');
        
        $this->grades_model->insert_grades_student();
        $this->session->set_flashdata('success_msg', 'Успешно добавихте оценяване за ученика!');

        redirect('grades/show_teacher_classes');
    }

    public function show_grades_history($student_id, $doi_id, $student_names, $doi_name)
    {
        $this->load->model('grades_model');
        
        $data['student_names'] = $student_names;
        $data['doi_name'] = $doi_name;
        $data['student_grades_list']=$this->grades_model->get_student_doi_grades_history($student_id, $doi_id);
        //print_r($data);
        $this->load->view('grades/student_grades_history', $data);
    }
}

?>
