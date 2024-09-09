<div class="Admin-Content-Main">
    <div class="Admin-Content-Main-Title">
        <h1>Dashboard</h1>

        <?php
            $tam = '';
            if(!empty(filter()['quanli'])){
                $tam = filter()['quanli'];
            }
            if($tam == 'listUsers'){
                include("modules/users/list.php");
            }
            else if($tam == 'listProducts'){
                include("modules/products/list.php");
            }
            else if($tam == 'listCategory'){
                include("modules/category/list.php");
            }
        ?>
    </div>
</div>          