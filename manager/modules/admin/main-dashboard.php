<div class="Admin-Content-Main">
    <div class="Admin-Content-Main-Title">
        <h1>Dashboard</h1>

        <?php 
            if(!empty($_GET['quanli'])){
                $tam = $_GET['quanli'];
            }
            else{
                $tam = '';
            }
            if($tam == 'listUsers'){
                include("modules/users/list.php");
            }
        ?>
    </div>
</div>          