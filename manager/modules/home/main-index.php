<div class="main-dex">
    <?php
        $filterAll = filter();
        $move = '';
        if(!empty(filter()['pages'])){
            $move = filter()['pages'];
        }
        if($move == 'rackets'){
            include("modules/pages/rackets.php");
        }
        else if($move == 'woman'){
            include("modules/pages/woman.php");
        }
        else if($move == 'men'){
            include("modules/pages/men.php");
        }
        else if($move == 'sale'){
            include("modules/pages/sale.php");
        }
        else if($move == 'shoes'){
            include("modules\pages\shoes.php");
        }
        else if($move == 'orther'){
            include("modules/pages/orther.php");
        }
        else if($move == 'gioHang'){
            include("modules/pages/gioHang.php");
        }
        else{
            include("./modules/sidebar/sidebar.php");
        }
    ?>
</div>
