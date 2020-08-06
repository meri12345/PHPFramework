<?php
var_dump($model);
?>

<div class="container">
    <h1>Create account</h1>
    <form method="post" action="">

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>FirstName</label>
                    <input type="text" value="<?= $model->firstname ?>"
                           class="form-control<?= $model->hasError('firstname') ? ' is-invalid' : '' ?>" name="firstname">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <div class="form-group">
                        <label>LastName</label>
                        <input type="text" class="form-control" name="lastname">
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" name="email">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" name="password">
        </div>
        <div class="form-group">
            <label>Repeat Password</label>
            <input type="password" class="form-control" name="passwordConfirm">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
