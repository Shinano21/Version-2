<?php

                        $sql = "SELECT * FROM administrator";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['firstname'] . "</td>";
                                echo "<td>" . $row['midname'] . "</td>";
                                echo "<td>" . $row['lastname'] . "</td>";
                                echo "<td>" . $row['user_type'] . "</td>";
                                echo "<td>" . $row['email'] . "</td>";
                                echo "<td style='width: 100px; overflow: hidden; text-overflow: ellipsis;'" . $row['password'] . "'>" . $row['password'] . "</td>";
                                $imageType = ''; // Define the variable to store image type
                                // Check if the image data exists and determine its type
                                if ($row['pfp'] !== null) {
                                    $imageType = strpos($row['pfp'], '/png') !== false ? 'png' : 'jpeg';
                                    echo "<td><img src='data:image/{$imageType};base64," . base64_encode($row['pfp']) . "' style='width: 50px; height: 50px;' /></td>";
                                } else {
                                    echo "<td>No image available</td>";
                                }
                                echo "<td style='padding: 0;'>
                                        <div style='display: flex; justify-content:center; width:100%;'>
                                            <div class='options' style='background: #006BDD;'>
                                            <a href='edit_user.php?id=" . $row['id'] . "' onclick='loadPage('settings/edit_user.php?id=" . $row['id'] . ")' style='color: white; text-decoration: none;'>
                                                <i class='fa fa-pencil-square-o' aria-hidden='true' style='color: white;'></i>
                                            </a>
                                            </div>
                                            <div class='options' style='background: red;'>";
                                // Form for deletion
                                echo "<form method='post' action='delete_user.php' class='options'>";
                                echo "<input type='hidden' name='user_id' value='" . $row['id'] . "'>";
                                echo "<button type='submit' name='delete' style='color: white; background: none; border: none;' onclick='return confirm(\"Are you sure you want to delete this user?\");'>
                                        <i class='fa fa-trash' aria-hidden='true' style='color: white;'></i>
                                    </button>";
                                echo "</form>";

                                echo "</div>
                                    </div>
                                </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='9'>No data found</td></tr>";
                        }
                        $conn->close();
                    ?>