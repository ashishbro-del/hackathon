<?php
if(isset($_GET['err']))
{
    ?>
    <div class="alert alert-danger">
       <?php echo $_GET['err'];  ?>
</div>
<?php } ?>