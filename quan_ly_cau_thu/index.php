<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <style type="text/css">
            table{
                width: 800px;
                margin: auto;
                text-align: center;
            }
            tr {
                border: 1px solid;
            }
            th {
                border: 1px solid;
            }
            td {
                border: 1px solid;
            }
            h1{
                text-align: center;
                color: red;
            }
            #button{
                margin: 2px;
                margin-right: 10px;
                float: right;
            }
        </style>
    </head>
    <body>
        <?php 
            //Kết nối databse
            include 'connect.php';
            
            
            //Viết câu SQL lấy tất cả dữ liệu trong bảng players
            $sql = "SELECT * FROM `thongtincauthu` ORDER BY `id`";

            //Chạy câu SQL
            $result = $con->query($sql);
            //thu var_dump($result)
            //if co data thi num_rows > 0, num_rows =0


            $data = [];
            if ($result->num_rows > 0) {

                //Gắn dữ liệu lấy được vào mảng $data
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
            }

            $html = '';
            foreach ($data as $value) {
                // $html .= '
                // <tr role="row">
                //     <td>'.$value['id'].'</td>
                //     <td>'.$value['name'].'</td>
                //     <td>'.$value['age'].'</td>
                //     <td>'.$value['national'].'</td>
                //     <td>'.$value['position'].'</td>
                //     <td>'.$value['salary'].' $</td>
                //     <td><a href="edit.php?id='.$value['id'].'">Edit</a></td>
                //     <td><a href="delete.php?id='.$value['id'].'"> Delete</a></td>
                // </tr>';

                $html .= '
                <tr role="row">
                    <td>'.$value['id'].'</td>
                    <td>'.$value['ten'].'</td>
                    <td>'.$value['tuoi'].'</td>
                    <td>'.$value['quoctich'].'</td>
                    <td>'.$value['vitri'].'</td>
                    <td>'.$value['luong'].' $</td>
                    <td><a href="edit.php?id='.$value['id'].'">Edit</a></td>
                    <td><a href="delete.php?id='.$value['id'].'"> Delete</a></td>
                </tr>';
            }
        ?>
        <table id="datatable" style="border: 1px solid">
            <h1>Quản lý cầu thủ</h1>
            <thead>
                <tr role="row">
                    <th>ID</th>
                    <th>Tên cầu thủ</th>
                    <th>Tuổi</th>
                    <th>Quốc tịch</th>
                    <th>Vị trí</th>
                    <th>Lương</th>
                    <th style="width: 7%;">Edit</th>
                    <th style="width: 10%;">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php  
                    echo $html;
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="8">
                        <a href="add.php"><button id="button">Thêm cầu thủ</button></a>
                    </td>
                </tr>
            </tfoot>
        </table>
    </body>
</html>