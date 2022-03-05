<?php
while ($row = mysqli_fetch_assoc($query)) {
    $output .= '<a href="php/accept-friend.php?user_id=' . $row['unique_id'] . '">
                    <div class="content">
                        <img src="assets/images/profile/' . $row['img'] . '" alt="">
                        <div class="details">
                            <span>' . $row['fname'] . " " . $row['lname'] . '</span>
                        </div>
                    </div>
                    <button class="addBtn">Accept</button>
                </a>';
}