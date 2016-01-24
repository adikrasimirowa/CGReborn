<div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            Добави оценяване на клас
                        </h1>
                    </div>
                </div>
                <!-- /. ROW  -->
                <div class="col-lg-12">
                    <?php
echo validation_errors();
$this->output->enable_profiler(TRUE);
$this->benchmark->mark('code_start');
?>
<div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <?php
                                    $hidden = array('class_year'=>$class_year, 'subject_id'=>$subject_id, 'class_id'=>$class_id, 'teacher_class_id'=>$teacher_class_id);
                                    echo form_open('grades/insert_grades_class', 'role="form"', $hidden); 
                                ?>
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Име</th>
                                            <th>Фамилия</th>
                                            <?php
                                            foreach($class_doi as $doi)
                                            {
                                                echo "<th><span title='$doi[profile]'> $doi[profile_short] </span></th>";
                                            }
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($students_list)) {
                                            
                                            $i = 0;
                                            foreach ($students_list as $student) {
                                                echo '<tr>
                                                <td>'.$student['number'].'</td>
                                                <td>'.$student['first_name'].'</td>
                                                <td>'.$student['last_name'].'</td>';

                                                foreach ($class_doi as $doi_value) {
                                                    $doi_grade=array(
                                                    'type'=>'text',
                                                    'name'=>'doi_grade[' . $student['student_id'] . '][' . $doi_value['doi_id'] . ']'
                                                    );
                                                    echo '<td>' . form_input($doi_grade) . '</td>';
                                                }
                                                $i++;
                                                echo '</tr>';
                                            }
                                            
                                        }
                                    ?>
                                </tbody>
                            </table>
                            <?php
                                $submit=array(
                                            'type'=>'submit',
                                            'name'=>'send',
                                            'value'=>'Запиши',
                                            'class' => 'btn btn-primary pull-right'
                                            );

                                echo form_input($submit);
                            ?>
                        </div>
                    </div>
                </div>

                      </div>
        <!-- /. PAGE WRAPPER  -->
<script type="text/javascript">
    $(document).ready(function(){
        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });
    });
</script>
