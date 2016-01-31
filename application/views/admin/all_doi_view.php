                  <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            ДОИ Категории
                        </h1>
                    </div>
                </div>
                <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                Изтриване на ДОИ Категория?
                            </div>
                            <div class="modal-body">
                                <img src="<?php echo base_url();?>index.php/assets/img/sign-warning-icon.png" align="left">
                                <h4> Сигурни ли сте, че искате да изтриете ДОИ Категорията?</h4>
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
                   
            <div class="col-lg-12 ">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12"><a href="add_form" class="btn btn-primary btn pull-right"><b>+</b> Добави нови категории</a><br/>
                                    <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover custab">
    <thead>
    
        <tr>
            <th>Профил</th>
            <th>Описание</th>
            <th>Критерия</th>
             <th>Предмет</th>
              <th>Клас</th>
            <th class="text-center">Редактирай</th>
            <th class="text-center">Изтрий</th>
        </tr>
    </thead>
          <?php foreach ($all_doi as $key => $value) 
          {
            echo "<tr>
                <td> $value[profile_short]</td>
                <td> $value[profile]</td>
                <td> $value[criteria] </td>
                        <td> $value[subject_type] </td>
                        <td> $value[class] </td>
                <td class='text-center'>
                <a class='btn btn-info' href='show_single_doi/$value[doi_id]' ><span class='glyphicon glyphicon-edit'></span> Редактирай</a> 
               </td> <td>  <button class='btn btn-danger' data-href='".base_url()."index.php/doi/delete/".$value['doi_id']."' data-toggle='modal' data-target='#confirm-delete'><span class='glyphicon glyphicon-trash'></span> Изтрий</button></td></td>      
            </tr> "; 
        }
            ?>
            
    </table>
                        </div>
                        </div>
                    </div>
                </div>
            </div> 
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
</script>
