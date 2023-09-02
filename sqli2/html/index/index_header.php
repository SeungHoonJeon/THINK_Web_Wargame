<a href="./">Think</a>
        
        <div id="top_list"> <!--상단 메뉴 페이지-->
            <ul>
                <li><a href="./">HOME</a></li>
                <li><a href=""><?php
                    if(!empty($_SESSION['id'])){
                        echo "<a href=\"./logout.php\">logout</a>";
                    }else{
                        echo "<a href=\"./login.php\">login</a>";
                    }
                ?></a></li>
                <li><a href="./join.php">join</a></li>
            </ul>
        </div>