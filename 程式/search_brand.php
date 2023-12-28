
<?php  
    function searchBrand($text){
        $servername = "localhost";
        $username = "root";
        $password = "A12345678";
        $dbname = "chocolate_db";
    
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM chocolate WHERE Data_brand LIKE '%".$text."%' ";

        $result = $conn->query($sql);
        // echo  "<table border='5px'> ";
        if ($result->num_rows > 0) {
            
            // echo  "<tr><th>編號</th><th>圖片</th><th>品名</th><th>價格</th><th>購買數量</th><tr>";
            while($row = $result->fetch_assoc()) {                
                //-----表格呈現模式------------------------------------------------------------------------------------------------------------------
                // echo  "<tr><th>".$row['Data_orderid']."</th>";
                // echo  "<td><img src=./chocolate_images/".$row['Data_pid'].".jpg alt='沒有圖片' width='100px'></td>";
                // echo  "<td>".$row['Data_name']."</td><td>"."\$".$row['Data_price']."</td>";
                // echo  "<td><input type='number' id='quantity' name='quantity' value='0' min='0' max='99'></td>";
                // echo  "<td>&nbsp;&nbsp;&nbsp;0</td></tr>";
                
                //-----方格呈現模式------------------------------------------------------------------------------------------------------------------
                echo "<div class='product'><div class='productup'><a  href='#'>";
                echo "<img class='product_image' src='./chocolate_images/".$row['Data_pid'].".jpg' alt='".$row['Data_name']."' title='".$row['Data_name']."' >";
                echo "</a></div>";
                echo "<div class='product_description'><a href='#' title='".$row['Data_name']."'>".$row['Data_name']."</a>";
                echo "<div class='price'><em>"."\$".$row['Data_price']."</em><i></i></div>";
    
                echo "<label>購買數量: <input type='number' id='quantity".$row['Data_orderid']."' name='quantity' value='0' min='0' max='99'></label>";
                echo "&nbsp&nbsp&nbsp&nbsp<input type='button'  onclick='addProduct(this.name)' name='button".$row['Data_orderid']."' value='加入購物車'/></div></div>";
                echo "<input type='hidden' id='productArray".$row['Data_orderid']."' value='[".$row['Data_orderid'].",".$row['Data_pid'].",".$row['Data_name'].",".$row['Data_price']." ]'/>";
                   
                
            }

        $result->close();
        $conn->close();

    
        } 
            
    } 
    //header("Location: ./chocolate.php");
    
    ?>