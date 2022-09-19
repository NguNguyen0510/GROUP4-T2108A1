<header id="header">
    <meta charset="UTF-8">


    <style>
        .navbar-brand{
            color: black;
        }
        .text-warning {
            position: absolute;
            color: #ffc107!important;
            margin-left: 5px;
        }

        .bg-light {

            background-color: #7a7a7a !important;
            border-radius: 15%;
            width: 25px;
            align-items: center;
            margin-top: 1.5px;
        }
        .text-warning bg-light{
            margin-left: 10px;
        }


    </style>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="background-color: whitesmoke !important;" >

        <a href="product.php" class="navbar-brand">
        <h2  class="px-5" style="text-shadow: 1px 0 black;
         font-size: 50px;
         color: black;
         font-size: 16px;
         padding-top: 30px;

font-weight: bold;margin-top: 35px">
           VỀ TRANG SẢN PHẨM
        </h2>
        </a>

        <button class="navbar-toggler" type="button"
                data-toggle="collapse"
                data-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup"
                aria-expanded="false"
                aria-label="Toggle navigation"

            >
            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="mr-auto">  </div>
                <div class="navbar-nav">
                    <a style="width: 300px;margin-left: -80px;margin-top: 50px;font-family: Arial" href="cart.php" class="nav-item nav-link active">
                    <h5 class="px-5 cart">
                    <a style="color: black" class="fas fa-shopping-cart"> Giỏ Hàng</a>
                        <?php

                        if (isset($_SESSION['cart'])){
                            $count = count($_SESSION['cart']);
                            echo " <span id=\"cart_count\" class=\"text-warning bg-light\">$count</span>";
                        }else{
                            echo " <span  id=\"cart_count\" class=\"text-warning bg-light\"><span style='margin-left:7px'>0</span></span>";
                        }
                        ?>
                    </h5>
                    </a>

            </div>
        </div>

    </nav>
</header>