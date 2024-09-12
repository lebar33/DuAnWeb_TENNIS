<div class="main-dex">
    <?php
        $filterAll = filter();
        $move = '';
        if(!empty(filter()['pages'])){
            $move = filter()['pages'];
        }
        if($move == 'rackets'){
            require_once("modules/pages/rackets.php");
        }
        else if($move == 'woman'){
            require_once("modules/pages/woman.php");
        }
        else if($move == 'men'){
            require_once("modules/pages/men.php");
        }
        else if($move == 'sale'){
            require_once("modules/pages/sale.php");
        }
        else if($move == 'shoes'){
            require_once("modules\pages\shoes.php");
        }
        else if($move == 'orther'){
            require_once("modules/pages/orther.php");
        }
        else if($move == 'gioHang'){
            require_once("modules/pages/gioHang.php");
        }
        else{
            require_once("./modules/sidebar/sidebar.php");
        }
    ?>
</div>
