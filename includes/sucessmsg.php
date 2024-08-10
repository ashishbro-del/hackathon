<?php
if(isset($_GET['msg']))
{
    ?>
    <div class="alert alert-success">
       <?php echo $_GET['msg'];  ?>
</div>
<?php } ?>