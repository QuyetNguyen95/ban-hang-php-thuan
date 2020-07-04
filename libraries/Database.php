

<?php 

    /**
    * 
    */
    class Database
    {
        /**
         * Khai báo biến kết nối
         * @var [type]
         */
        public $link;
        //contructor luôn gọi đến khi khởi tạo đối tượng
        public function __construct()
        {
            //create connection
            $this->link = mysqli_connect("localhost","root","","tuanphuongphp") or die ();
            //set tiếng việt
            mysqli_set_charset($this->link,"utf8");
        }

        

        /**
         * [insert description] hàm insert 
         * @param  $table
         * @param  array  $data  
         * @return integer
         */
        // INSERT INTO table_name (column1, column2, column3, ...) VALUES (value1, value2, value3, ...);
        public function insert($table, array $data)
        {
            //code
            //example: array('id'=>'1','name'=>'quyet');
            $sql = "INSERT INTO {$table} ";
            $columns = implode(',', array_keys($data));
            //hàm array_keys($data) trả về $key của $data gồm có id và name;
            //dùng hàm implode nối các phần tử của mảng thành một chuổi ngăn cách bởi dấu ,  $column = id, name
            $values  = "";
            $sql .= '(' . $columns . ')';
            //$sql = (id,name)
            foreach($data as $field => $value) {
                if(is_string($value)) {
                    //nếu dử liệu đầu vào là kiểu string
                    $values .= "'". mysqli_real_escape_string($this->link,$value) ."',";
                    //mysqli_real_escape_string(connection, escapestring)
                    //mysqli_real_escape_string loại bỏ các ký tự đặc biệt
                    //in ra '1','quyet',
                } else {
                    //nếu dữ liệu đầu vào không phải là kiểu string ( kiểu int chẳng hạn)
                    $values .= mysqli_real_escape_string($this->link,$value) . ',';
                }
            }
            $values = substr($values, 0, -1);//substr($str,$star,$lent);
            //substr("abcdef", 0, -1); // trả về "abcde"
            //loại bỏ dấu , sau cũng của $value = '1','quyet',
            //Nếu tham số $length được sử dụng và là một số dương, chuỗi trả về sẽ bao gồm $length ký tự, tính từ vị trí thứ $start (tùy thuộc vào độ dài của chuỗi).

            //Nếu tham số $length được sử dụng và là một số âm, 
            //chuỗi trả về được tính từ vị trí $start đến vị trí $length (trong đó vị trí $length được tính từ cuối chuỗi trở lại)
            ////ký tự đầu tiên được tính là vị trí số 0
            $sql .= " VALUES (" . $values . ')';
            // _debug($sql);die;
            mysqli_query($this->link, $sql) or die("Lỗi  query  insert ----" .mysqli_error($this->link));
            //Hàm mysqli_error() sẽ trả về nội dung của lỗi gần nhất xảy ra khi gọi hàm nào đó từ kết nối MySQL.
            return mysqli_insert_id($this->link);//lấy id vừa insert
        }
        //UPDATE table_name SET column1 = value1, column2 = value2, ... WHERE condition;
        public function update($table, array $data, array $conditions)
        {
            $sql = "UPDATE {$table}";

            $set = " SET ";

            $where = " WHERE ";

            foreach($data as $field => $value) {
                if(is_string($value)) {
                    $set .= $field .'='.'\''. mysqli_real_escape_string($this->link, xss_clean($value)) .'\',';
                    //Usage of xss_clean(), we can stop the data and filter up, if any disallowed data is encountered it is rendered by xss_clean function and safe convert into the character entities.
                    //\' là '
                } else {
                    $set .= $field .'='. mysqli_real_escape_string($this->link, xss_clean($value)) . ',';
                }
            }

            $set = substr($set, 0, -1);


            foreach($conditions as $field => $value) {
                if(is_string($value)) {
                    $where .= $field .'='.'\''. mysqli_real_escape_string($this->link, xss_clean($value)) .'\' AND ';
                } else {
                    $where .= $field .'='. mysqli_real_escape_string($this->link, xss_clean($value)) . ' AND ';
                }
            }

            $where = substr($where, 0, -5);
            //-5 là AND tính luôn 2 khoảng trắng

            $sql .= $set . $where;
            // _debug($sql);die;

            mysqli_query($this->link, $sql) or die( "Lỗi truy vấn Update -- " .mysqli_error($this->link));
            
            //mysqli_error() Returns a string description of the last error

            return mysqli_affected_rows($this->link);
            //mysqli_affected_rows Returns the number of rows affected by the last INSERT, UPDATE, REPLACE or DELETE query.
        }
        public function updateview($sql)
        {
            $result = mysqli_query($this->link,$sql)  or die ("Lỗi update view " .mysqli_error($this->link));
            return mysqli_affected_rows($this->link);

        }
        public function countTable($table)
        {
            $sql = "SELECT id FROM  {$table}";
            $result = mysqli_query($this->link, $sql) or die("Lỗi Truy Vấn countTable----" .mysqli_error($this->link));
            $num = mysqli_num_rows($result);
            //mysqli_num_rows Retrieves the number of rows from a result set. This command is only valid for statements like SELECT or SHOW that return an actual result set. To retrieve the number of rows affected by a INSERT, UPDATE, REPLACE or DELETE query, use mysql_affected_rows().
            return $num;
        }


        /**
         * [delete description] hàm delete
         * @param  $table      [description]
         * @param  array  $conditions [description]
         * @return integer             [description]
         */
        //DELETE FROM table_name WHERE condition;
        public function delete ($table ,  $id )
        {
            $sql = "DELETE FROM {$table} WHERE id = $id ";

            mysqli_query($this->link,$sql) or die (" Lỗi Truy Vấn delete   --- " .mysqli_error($this->link));
            return mysqli_affected_rows($this->link);
        }

        /**
         * delete array 
         */
        
        public function deletewhere($table,$data = array())
        {
            foreach ($data as $id)
            {
                $id = intval($id);//ép sang kiểu nguyên
                //intval Returns the integer value of var, using the specified base for the conversion (the default is base 10)
                $sql = "DELETE FROM {$table} WHERE id = $id ";
                mysqli_query($this->link,$sql) or die (" Lỗi Truy Vấn delete   --- " .mysqli_error($this->link));
            }
            return true;
        }
        //lấy dử liệu theo chuổi sql truyền vào hàm
        public function fetchsql( $sql )
        {
            $result = mysqli_query($this->link,$sql) or die("Lỗi  truy vấn sql " .mysqli_error($this->link));
            $data = [];
            if( $result)
            {
                while ($num = mysqli_fetch_assoc($result))
                    //mysqli_fetch_assoc — Fetch a result row as an associative array
                {
                    $data[] = $num;
                }
            }
            return $data;
        } 
        //lấy dữ liệu theo id
        public function fetchID($table , $id )
        {
            $sql = "SELECT * FROM {$table} WHERE id = $id ";
            $result = mysqli_query($this->link,$sql) or die("Lỗi  truy vấn fetchID " .mysqli_error($this->link));
            return mysqli_fetch_assoc($result);
        }
        //lấy 1 hàng dữ liệu 
        public function fetchOne($table , $query)
        {
            $sql  = "SELECT * FROM {$table} WHERE ";
            $sql .= $query;
            $sql .= "LIMIT 1";
            $result = mysqli_query($this->link,$sql) or die("Lỗi  truy vấn fetchOne " .mysqli_error($this->link));
            return mysqli_fetch_assoc($result);
        }
        //xóa dữ liệu theo điều kiện cung cấp cho hàm
        public function deletesql ($table ,  $sql )
        {
            $sql = "DELETE FROM {$table} WHERE " .$sql;
            // _debug($sql);die;
            mysqli_query($this->link,$sql) or die (" Lỗi Truy Vấn delete   --- " .mysqli_error($this->link));
            return mysqli_affected_rows($this->link);
        }

        
        //lấy tất các dữ liệu của bảng được truyền vào
         public function fetchAll($table)
        {
            $sql = "SELECT * FROM {$table} WHERE 1" ;
            $result = mysqli_query($this->link,$sql) or die("Lỗi Truy Vấn fetchAll " .mysqli_error($this->link));
            $data = [];
            if( $result)
            {
                while ($num = mysqli_fetch_assoc($result))
                {
                    $data[] = $num;
                }
            }
            return $data;
        }

    
        public  function fetchJones($table,$sql,$total = 1,$page,$row ,$pagi = true )
        {
            
            $data = [];

            if ($pagi == true )
            {
                $sotrang = ceil($total / $row);//$total tinh theo record tra ve cua tung muc, tuc la mot phan cua tong so record cua bang
                $start = ($page - 1 ) * $row ;
                $sql .= " LIMIT $start,$row ";
                $data = [ "page" => $sotrang];
              
               
                $result = mysqli_query($this->link,$sql) or die("Lỗi truy vấn fetchJone ---- " .mysqli_error($this->link));
            }
            else
            {
                $result = mysqli_query($this->link,$sql) or die("Lỗi truy vấn fetchJone ---- " .mysqli_error($this->link));
            }
            
            if( $result)
            {
                while ($num = mysqli_fetch_assoc($result))
                {
                    $data[] = $num;
                }
            }
            
            return $data;
        }
        //phân trang
         public  function fetchJone($table,$sql ,$page = 0,$row ,$pagi = false )
        {
            
            $data = [];
            // _debug($sql);die;
            if ($pagi == true )
            {
                $total = $this->countTable($table);//tổng số records , tong tat ca records cua bang
                $sotrang = ceil($total / $row);
                $start = ($page - 1 ) * $row ;
                //$page = 1 => $start = 1 - 1 * $row = 3 = 0 có nghĩa là lấy record 1 ,2, 3 lấy 3 record bắt đầu từ 0
                // current_page: trang hiện tại
                // limit: số records hiển thị trên mỗi trang
                // start: record bắt đầu trong câu lệnh SQL
                //(current_page - 1) * limit
                $sql .= " LIMIT $start,$row";// LIMIT 3,4 Có nghĩa là lấy 4 dòng, tính từ thứ tự thứ 3
                $data = [ "page" => $sotrang];
               
                $result = mysqli_query($this->link,$sql) or die("Lỗi truy vấn fetchJone ---- " .mysqli_error($this->link));
            }
            else
            {
                $result = mysqli_query($this->link,$sql) or die("Lỗi truy vấn fetchJone ---- " .mysqli_error($this->link));
            }
            
            if($result)
            {
                while ($num = mysqli_fetch_assoc($result))
                {
                    $data[] = $num;
                }
            }
            // _debug($data);
            return $data;

            //$data = array("page" => $sotrang,$num); $num là một mảng kết hợp mà câu lệnh $sql trả về
        }


        public  function fetchJoneDetail($table , $sql ,$page = 0,$total ,$pagi )
        {
            $result = mysqli_query($this->link,$sql) or die("Lỗi truy vấn fetchJone ---- " .mysqli_error($this->link));

            $sotrang = ceil($total / $pagi);
            $start = ($page - 1 ) * $pagi ;
            $sql .= " LIMIT $start,$pagi";

            $result = mysqli_query($this->link , $sql);
            $data = [];
            $data = [ "page" => $sotrang];
            if( $result)
            {
                while ($num = mysqli_fetch_assoc($result))
                {
                    $data[] = $num;
                }
            }
            return $data;
        }

        public function total($sql)
        {
            $result = mysqli_query($this->link  , $sql);
            $tien = mysqli_fetch_assoc($result);
            return $tien;
        }
    }
   
?>