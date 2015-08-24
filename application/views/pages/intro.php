<div class="row-fluid">
    <div class="col-sm-4 col-sm-offset-4">
<div class="row">
<div class="col-sm-12">
    <?php if (validation_errors()): ?>
 <div class="panel panel-danger"><div class="panel-heading">
          <p><?=validation_errors()?></p>
    </div></div>
<?php endif;?>
    <?php if (isset($ermes)): ?>
 <div class="panel panel-danger"><div class="panel-heading">
          <p><?=$ermes?></p>         
    </div></div>
<?php endif;?>
    
</div></div>
        <form role="form" method="post" action="entry">
            <div class="form-group">
                    <label>Логин:</label>
                    <input class="form-control" type="text" name="login" value="<?=set_value('login');?>">
            </div>

            <div class="form-group">
                    <label>Пароль:</label>
                    <input class="form-control" type="password" placeholder="pass" name="pass">
            </div>
             <input class="form-control" type="submit" name="sub" value="Ввод">

        </form>
    </div>
</div>