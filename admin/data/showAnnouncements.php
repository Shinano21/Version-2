<?php
    $sql = "SELECT * FROM announcements ORDER By post_date DESC";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td class='table-row'>" . $row["post_date"] ."</td>";
            echo "<td class='table-row'>" . $row["announce_heading"] ."</td>";
            echo "<td class='table-body'>" . $row["announce_body"] ."</td>";
            if ($row['announce_pic'] !== null) {
                $imageType = strpos($row['announce_pic'], '/png') !== false ? 'png' : 'jpeg';
                echo "<td><img src='data:image/{$imageType};base64," . base64_encode($row['announce_pic']) . "' style='width: 50px; height: 50px;' /></td>";
            } else {
                echo "<td>No image available</td>";
            }
            echo "<td style='padding: 0;'>
            <div style='display: flex; justify-content:center; width:100%;'>
                <div class='actions'>
                    <div class='options' style='background: #006BDD;'>
                    <a href='wsUpdateAnnouncements.php?id=" . $row["id"] . "' style='color: white; text-decoration: none;'>
                            <i class='fa fa-pencil-square-o' aria-hidden='true'
                                style='color: white;'></i>
                        </a>
                    </div>
                    <div class='options' style='background: red;'>
                    <form action='cms/delete_announcements.php' method='post'>
                        <input type='hidden' name='id' value='" . $row["id"] . "'>
                        <button type='submit' name='delete' style='color: white; background: none; border: none;' onclick='return confirm(\"Are you sure you want to delete this announcement?\");'>
                            <i class='fa fa-trash' aria-hidden='true' style='color: white;'></i>
                        </button>
                    </form>
                </div>
                </div>
            </div>
        </td>
        </tr>";
        }
    }
    $conn->close();
?>