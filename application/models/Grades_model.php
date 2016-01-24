<?php

/**
* 
*/
class Grades_model extends CI_Model
{
	public function insert_grades_class()
	{
		$data = array();
		$now = date('Y-m-d H:i:s');
		foreach($this->input->post('doi_grade') as $student_key => $student)
        {
            foreach($student as $doi_key => $grade)
            {
                if(isset($grade) && $grade != '')
                {
                	$data[] = array(
	                	'doi_id' => $doi_key
	                	,'student_id' => $student_key
	                	,'grade' => $grade
	                	,'date_created' => $now
	                	,'created_by' => $this->session->userdata('user_id')
                	);
                }
            }
        }
        
        //print_r($data);
        return $this->db->insert_batch('grades', $data);
	}

	public function insert_grades_student()
	{
		$data = array();
		$now = date('Y-m-d H:i:s');
		foreach($this->input->post('doi_grade') as $doi_id => $grade)
        {
        	if(isset($grade) && $grade != '')
        	{
        		$data[] = array(
	        	'doi_id' => $doi_id
	        	,'student_id' => $this->input->post('student_id')
	        	,'grade' => $grade
	        	,'date_created' => $now
	        	,'created_by' => $this->session->userdata('user_id')
            );
        	}
        }
        
        return $this->db->insert_batch('grades', $data);
	}

	public function get_all_teacher_class_grades($doi_ids, $student_ids)
	{
		$this->db->select('max(grades.grade) as max_grade, grades.doi_id, grades.student_id, students.first_name, students.last_name');
		$this->db->from('grades');
		$this->db->join('students', 'grades.student_id = students.student_id');
		$this->db->where_in('students.student_id', $student_ids);
		$this->db->where_in('doi_id', $doi_ids);
		$this->db->group_by('doi_id');
		$this->db->group_by('students.student_id');
		$this->db->order_by('doi_id');
		$q = $this->db->get();

		return $q->result_array();
	}

	public function get_student_doi_grades_history($student_id, $doi_id)
	{
		$this->db->select('grade, date_created');
		$this->db->from('grades');
		$this->db->where('student_id', $student_id);
		$this->db->where('doi_id', $doi_id);
		$this->db->order_by('date_created', 'DESC');

		$q = $this->db->get();
		return $q->result_array();
	}
}