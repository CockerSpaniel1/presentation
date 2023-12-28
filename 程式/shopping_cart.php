<title>這是台購物車</title>
<style>* { background-color:lightgoldenrodyellow}</style>
<?php
session_start();

if (isset($_GET["shoppingItem"])){
    $productString = $_GET["shoppingItem"];
    $productArray =explode(",",$productString);
   
    echo "<br>有收到商品<br>";
        if (isset($_SESSION['shoppingCart'])){
            
            //print_r($_SESSION['shoppingCart']);
            
            echo "<br><br>有收到購物車<br>";
            $shoppingCart = $_SESSION['shoppingCart'];

            echo "將商品加入購物車<br>";
            addToCart($productArray);

            echo "<br>查看新增商品後的購物車<br>";
            print_r($shoppingCart);

        }else{
            echo "<br>沒有收到購物車 新增一台空購物車<br>";
            $shoppingCart  = [];
            print_r($shoppingCart);

            echo "<br>將商品加入購物車<br>";
            addToCart($productArray);

            echo "<br>查看新增商品後的購物車<br>";
            print_r($shoppingCart);
        }

    echo "<br>送出購物車<br>";
    $_SESSION['shoppingCart'] = $shoppingCart;

    //返回商品頁面
    header("Location: ./chocolate.php");    
    
    } else {
        //echo "沒有收到商品<br>";
        
        if (isset($_SESSION['shoppingCart']) && !empty($_SESSION['shoppingCart'])){
            //echo "查看目前購物車內的商品(不為空陣列)<br>";

            $tempArray = $_SESSION['shoppingCart'];
            echo  "<table id='productTable' border='5px'> ";
            echo  "<tr><th>編號</th><th>圖片</th><th>品名</th><th>價格</th><th>購買數量</th><th>金額</th><tr>";
            

            foreach($tempArray as $productId => $productDetail){

                echo  "<tr><th>".$productId."</th>";
                echo  "<td><img src=./chocolate_images/".$productDetail['Data_pid'].".jpg alt='沒有圖片' width='100px'></td>";
                echo  "<td>".$productDetail['Data_name']."</td><td>"."\$".$productDetail['Data_price']."</td>";
                echo  "<td>".$productDetail['Data_quantity']."</td>";

                $sub_total = intval($productDetail['Data_price']) * intval($productDetail['Data_quantity']); 
                echo  "<td>".$sub_total."</td>";

                echo "<td><input type='button'  onclick='function1(this.name)' name='".$productId."' value='刪除物品' ></td>";
    
            } echo "</tr></table>";
        }else{
            //echo "目前沒有購物車";
            echo "<script language='javascript'>alert('購物車內尚無商品 請加入一些商品至購物車內'); location.href='./chocolate.php'</script>";
            
        };
}   
?>

<a href="./chocolate.php">返回商品頁面</a>

<?php

    function addToCart($a){
        global $shoppingCart;
        $shoppingCart[$a[0]] = array("Data_pid"=>$a[1],"Data_name"=>$a[2],"Data_price"=>$a[3],"Data_quantity"=>$a[4]) ;

        //[ $array[0]=> array($array[1],$array[2],$array[3],$array[4])];
    }

    function delectProduct($id){

        $tempArray =$_SESSION['shoppingCart'];
        unset($tempArray[$id]);
        
        $_SESSION['shoppingCart'] = $tempArray;
    }  
?>

<?php 
    if (isset($_GET["removeId"])){
        $_removeId = $_GET["removeId"];
        delectProduct($_removeId);

        if (empty($_SESSION['shoppingCart'])){
            
            echo "<script language='javascript'>document.getElementById('productTable').innerHTML =''</script>";
            echo "<script language='javascript'>alert('購物車內尚無商品 請加入一些商品至購物車內'); </script>";
            //echo "購物車空了";
            //header("Refresh:0"); 用refresh的話會帶著同樣的GET參數重新整理頁面
            header("Refresh:1; url=./chocolate.php");
            
        } else{
            //echo "刪完以後購物車還有東西";
            echo "<script language='javascript'>alert('已刪除')</script>";
            
            //header("Location: ./shopping_cart.php");
            header("Refresh:0.1; url=./shopping_cart.php");
            
        }        
    }

    ?>


<!-- 取得欲刪除商品的id 並get方式傳id給自己-->

<script language="javascript" >
    function function1(productId){
        //alert(productId)
     
        location.href=`./shopping_cart.php?removeId=${productId}`
    }

</script>

<!-- <form id="f2" name="f2" method="post" action="<?php //$_SERVER['PHP_SELF']?>"> -->
<!-- <input type="hidden"  name="shoppingCart[]"  value="<?php //echo $shoppingCart; ?>"> -->

<!-- <input type="submit" id="submit1" name="submit1" value="加入購物車" /> -->
<!-- </form> -->
