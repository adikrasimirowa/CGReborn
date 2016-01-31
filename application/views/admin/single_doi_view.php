        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            Редактирай ДОИ категория
                        </h1>
                    </div>
                </div>
                <!-- /. ROW  -->
                <div class="row">
                   <div class="col-md-4" >
   <div class="panel panel-primary">
    <div class="panel-heading">Промени :<?php echo " $doi[profile_short]"; ?></div>
     <div class="panel-body">
     <?php  echo form_open('doi/update_single_doi'); 
echo validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); 
  $profile_short=array(
  'type'=>'text',
  'class'=>'form-control',
  'name'=>'profile_short',
  'value'=>"$doi[profile_short]");

 $profile=array(
  'type'=>'text',
  'class'=>'form-control',
  'name'=>'profile',
  'value'=>"$doi[profile]");
 $criteria=array(
  'type'=>'text',
  'class'=>'form-control',
  'name'=>'criteria',
  'value'=>"$doi[criteria]");
 $class=array(
  'type'=>'text',
  'class'=>'form-control',
  'name'=>'class',
  'value'=>"$doi[class]");
 $subject=array(
  'type'=>'text', 
  'class'=>'form-control',
  'name'=>'subject',
  'value'=>"$doi[subject_type]");
 $id_of_doi=array(
   'type'  => 'hidden',
   'name'  => 'id_of_doi',
     'value'  => "$doi[doi_id]");
 $submit=array(
  'type'=>'submit',
  'name'=>'submit_button',
  'value'=>"Редактирай");
?>
      <label>Профил</label><?php echo form_input($profile_short); ?> </br>
      <label>Описание</label><?php echo form_input($profile); ?> </br>
      <label>Критерия : </label><?php  echo form_input($criteria); ?> </br>
      
    </label><?php  
   echo "
      <label>Клас : </label>
      <select name='class' class='form-control'>";
 echo "<option value='$doi[class]'>$doi[class]</option>";
$i = 0;
while($i < count($n_class)){
  $val= $n_class[$i]['value'];
  $des = $n_class[$i]['n_class'];
  echo "<option value='$i'> $des</option>";
  $i++;
}
      echo "</select>";

echo "<label>Предмет : </label>
<select name='subject' class='form-control'>";
 echo "<option value='$doi[subject_type]'>$doi[subject_type]</option>";
$i = 0;
while($i < count($n_subject)){
  $val= $n_subject[$i]['value'];
  $des = $n_subject[$i]['subject_type'];
  echo "<option value='$i'>$des</option>";
  $i++;
}
echo "</select>"; 

 ?> </br>
 <br/>
        <button type="submit" class="btn btn-primary">Редактирай</button>
<?php 
echo form_input($id_of_doi);
echo form_close(); ?>
    </div>
   </div>
  </div>
    </div>
</div>
<!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
