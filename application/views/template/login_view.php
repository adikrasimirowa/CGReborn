<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>ColorGrades - Вход</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <style type="text/css">
.vertical-offset-100{
    padding-top:100px;
}    </style>
</head>
<body>
<div class="container">
    <div class="row vertical-offset-100">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">ColorGrades</h3>
                </div>
                <div class="panel-body">
                    <?php
                    echo form_open('login/validate', array('role'=>'form'));
                    ?>
                    <fieldset>
                        <div class="form-group">
                            <input class="form-control" placeholder="Имейл" name="email" type="text">
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Парола" name="password" type="password" value="">
                        </div>
                        <input class="btn btn-lg btn-success btn-block" type="submit" value="Вход">
                    </fieldset>
                    </form>

                    <?php
                    $err = $this->session->flashdata('err_login');
                    if (isset($err)) 
                    {
                        echo '<br/> <div class="alert alert-danger" role="alert">'.$this->session->flashdata('err_login').'</div>';
                    }
                    echo '<br/>'.validation_errors('<div class="alert alert-danger" role="alert">', '</div>');
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<?php
/*echo $this->session->flashdata('err_login');
echo validation_errors();
echo form_open('login/validate');
echo 'Email: '.form_input('email', set_value('email')).'<br/>';
echo 'Парола: '.form_password('password', set_value('password')).'<br/>';
echo form_submit('submit', 'Login');
echo form_close();*/
?>