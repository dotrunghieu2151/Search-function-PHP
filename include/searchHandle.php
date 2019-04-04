<?php
    if (file_get_contents('php://input')) {
        require_once 'db.php';
        $getData = json_decode(file_get_contents('php://input'),true);
        $input = $getData["searchInput"];
        if ($input === '') {
            echo "No customer found";
            exit();
        }
        // trying to simulate google search :)
       /* 
        $input = preg_replace("/\s+/","|",$getData["searchInput"]);
        $input = trim($input);
        */
        $sql = "SELECT * FROM tbl_customer WHERE "
                . "CustomerName REGEXP :name OR Address REGEXP :addr OR City REGEXP :city OR PostalCode REGEXP :code OR Country REGEXP :country ";
        $stmt = $PDO->prepare($sql);
        $stmt->execute([
            ":name" => "$input",
            ":addr"=>"$input",
            ":city"=>"$input",
            ":code"=>"$input",
            ":country"=>"$input"
        ]);
        $total = $stmt->rowCount();
        if ($total == 0) {
            echo "No customer found";
        } else {
            $output = "
                <div class='container-table100'>
                    <div class='wrap-table100'>
                        <div class='table100 ver1 m-b-110'>
                            <div class='table100-head'>
                                <table>
                                    <thead>
                                        <tr class='row100 head'>
                                            <th class='cell100 column1'>Customer Name</th>
                                            <th class='cell100 column2'>Address</th>
                                            <th class='cell100 column3'>City</th>
                                            <th class='cell100 column4'>Postal Code</th>
                                            <th class='cell100 column5'>Country</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>";
            while ($row = $stmt->fetchObject()) {
                $output .= "
                        <div class='table100-body js-pscroll'>
                            <table>
                                <tbody>
                                    <tr class='row100 body'>
                                        <td class='cell100 column1'>$row->CustomerName</td>
                                        <td class='cell100 column2'>$row->Address</td>
                                        <td class='cell100 column3'>$row->City</td>
                                        <td class='cell100 column4'>$row->PostalCode</td>
                                        <td class='cell100 column5'>$row->Country</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>";
            }
            $output .= "</div></div></div>";
            echo $output;
        }
    } else {
        header("Location: ../index.php");
    }
   


