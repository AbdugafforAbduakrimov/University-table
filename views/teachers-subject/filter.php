	<table style="margin-top: 50px;" class="table sort-table table-bordered border-striped" id="month_table" style="margin-top: 15px">
        <tr>
            <th>Hafta kunlari \ Guruhlar</th>
            <?php
            $arr = [];
            
            foreach ($model as $key => $value) {
                echo "<th>" . $value->title . " - guruh</th>";
                $arr[] = $value->id;
            }
            ?>
        </tr>
        <?php
        // $current_date = date('Y-m-d');
        if (isset($command) && !empty($command)) {
            foreach ($command as $key => $value) {
                $i = 0;
                echo "<tr>";
                echo "<td>" . $key . "</td>";
                $time = $key;
                if (!empty($value)) {
                    $yes = 0;
                    foreach ($value as $teamKey => $teamValue) {
                        if (isset($teamKey) && isset($arr[$i]) && $teamKey == $arr[$i]) {
                            $yes++;
                            $i++;
                                echo "<td>";
                            foreach ($teamValue as $key11 => $teamValue1) {
                                echo "<span data-toggle='modal' data-target='#modal-default' style='cursor: pointer;' class='view label label-primary'>".$key11."- para | ".$teamValue1['subject']." - fan | ".$teamValue1['teacher']." - o`qituvchi</span><br>";
                            }
                                echo "</td>";
                        } else {
                            $i = 0;
                            for ($t = 0; $t <= count($arr); $t++) {
                                $yes++;
                                if (isset($teamKey) && isset($arr[$i]) && $teamKey == $arr[$i]) {
                                    echo "<td>";
                                    foreach ($teamValue as $key11 => $teamValue1) {
                                         echo "<span data-toggle='modal' data-target='#modal-default' style='cursor: pointer;' class='view label label-primary'>".$key11."- para | ".$teamValue1['subject']." - fan | ".$teamValue1['teacher']." - o`qituvchi</span><br>";
                                    }
                                    echo "</td>";
                                } else {
                                    if ($yes < count($arr)) {
                                        echo "<td></td>";
                                    }
                                }
                                $i++;
                            }
                        }
                    }
                    if ($yes < count($arr)) {
                        for ($y = $yes; $y < count($arr); $y++) {
                            echo "<td></td>";
                        }
                    }
                } else {
                    for ($t = 0; $t < count($arr); $t++) {
                        echo "<td></td>";
                    }
                }
                echo "</tr>";
            }
        } else {
            foreach ($command as $key => $value) {
                echo "<tr>";
                echo "<td>" . $key . "</td>";
                echo "</tr>";
            }
        }

        ?>
    </table>