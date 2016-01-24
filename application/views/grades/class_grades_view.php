        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            Учители
                        </h1>
                    </div>
                </div>
                <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                Изтриване на Учител?
                            </div>
                            <div class="modal-body">
                                <img src="<?php echo base_url();?>assets/img/warning.png" align="left">
                                <h4>Сигурни ли сте, че искате да изтриете Учител?</h4>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Откажи</button>
                                <a class="btn btn-danger btn-ok">ИЗТРИЙ</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /. ROW  -->
                <div class="row">
                    <div class="col-lg-9">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Учители
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <?php
                                    $success_msg = $this->session->flashdata('success_msg');
                                    if (isset($success_msg)) {
                                        echo '<div class="alert alert-success" role="alert">'.$success_msg.'</div>';
                                    }
                                    if (count($student_doi_matrix)>0) {
                                ?>
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Име и Фамилия</th>
                                            <?php
                                            $doi_ids = array();
                                            $doi_names = array();
                                            $i = 0;
                                            foreach($class_doi as $doi)
                                            {
                                                echo "<th><span title='$doi[profile]'> $doi[profile_short] </span></th>";
                                                $doi_names[$i] = $doi['profile_short'];
                                                $doi_ids[$i] = $doi['doi_id'];
                                                $i++;
                                            }
                                            ?>
                                            <th>Редактирай</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach ($student_doi_matrix as $key => $student_grades) {
                                                echo "<tr>
                                                        <td> </td>
                                                        <td>
                                                            $key
                                                        </td>";
                                                        $i = 0;
                                                foreach ($student_grades as $key2 => $value2) {
                                                    if($key2 != 'student_id')
                                                    {
                                                        echo "<td onclick='show_grades_history($student_grades[student_id], $doi_ids[$i], \"$key\", \"$doi_names[$i]\")'>".$value2.'</td>';
                                                        $i++;
                                                    }
                                                }

                                                echo '<td><a href='.base_url()."index.php/grades/add_grades_student/$teacher_class_id/$class_year/$subject_id/$class_id/$student_grades[student_id]".'><button class="btn btn-warning">Оцени ученик</button></a></td>
                                                </tr>';
                                            }
                                    ?>
                                </tbody>
                            </table>
                            <?php
                            echo '<a href=' . base_url("index.php/grades/add_grades_class/$teacher_class_id/$class_year/$subject_id/$class_id") . ' class="btn btn-primary pull-right">Оцени класа</a>';
                            }else
                            {
                                //There are no studnets or dois for this class
                                echo 'За този клас липсват ученици или ДОИ!';
                            }
                            echo '<a href=' . base_url("index.php/grades/show_teacher_classes") . ' class="btn btn-default pull-right">Назад към класове</a>';
                            ?>
                        </div>
                    </div>
                </div>
            </div> 
        </div>

        <div class="col-lg-3" id="grades_history">

        </div>
    </div>     
</div>
<!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
<script type="text/javascript">
    $(document).ready(function(){
        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });
    });

    function show_grades_history(student_id, doi_id, student_names, doi_name)
    {
        alert(student_id + ' ' + doi_id);
        $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>index.php/grades/show_grades_history/'+student_id+'/'+doi_id+'/'+student_names+'/'+doi_name, //We are going to make the request to the method "list_dropdown" in the match controller
        data: {'student_id' : student_id, 'doi_id': doi_id, 'student_names': student_names, 'doi_name': doi_name}, //POST parameter to be sent
        success: function(resp) { //When the request is successfully completed, this function will be executed
           //Activate and fill in the grades history list
           $('div#grades_history').html(resp); //With the ".html()" method we include the html code returned by AJAX into the matches list
        }
     });
    }
</script>