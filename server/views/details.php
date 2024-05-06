<?php 
    echo $id;
?>

<main class="site-main">
    <!-- #Details -->
    <section id="details">
        <div class="width-wrapper">

            <!-- event-description -->
            <?php
                $query = "SELECT * from events WHERE id = $id"; 
                $result = mysqli_query($connectionString, $query); // Query the database
                $num_results = $result->num_rows; 

                while($row = $result->fetch_assoc()) { 
                    echo "<div class='event-description'>"; 
                    
                    echo "<img src='{$row['imageFileName']}'>";

                    echo "<h3>". $row['optionalInformation'] . "</h3>";
                    
                    echo "<p>Free for every one</p>";

                    echo "<p>". $row['description'] . "<p>";
                    echo "</div>"; 
                }
            ?>

            <!-- event-info -->
            <div class="event-info">
                <!-- Event-details-date-location -->
                <div>
                    <h2>Cyber Security and New Technologies</h2>

                    <p><i class="fa-regular fa-calendar-days"></i>
                        Wednesday, February 21, 2024
                        <br>
                        <i class="fa-solid fa-clock"></i> 11:00 - 13:00
                    </p>

                    <p><i class="fa-solid fa-location-pin"></i> Академичен Информационен Център</p>
                </div>

                <!-- Event-details-gallery -->
                <div>
                    <h3>View Gallery</h3>
                    <div class="event-gallery">
                        <div class="event-gallery-card">
                            <img src="images/demo.png" alt="">
                        </div>

                        <div class="event-gallery-card">
                            <img src="images/demo2.png" alt="">
                        </div>

                        <div class="event-gallery-card">
                            <img src="images/demo.png" alt="">
                        </div>

                        <div class="event-gallery-card">
                            <img src="images/demo2.png" alt="">
                        </div>
                    </div>
                </div>
            

                <button class="submit-btn">Register</button>
            </div>
        </div>
    </section> 

    <!-- Only for Admins
    <section id="details-admin">
        <h2 class="section-heading">Admin Panel</h2>
        <div class="width-wrapper">
            <ul class="admin-buttons">
                <li><button class="add-img-btn"><a href="#"><i class="fa-solid fa-plus"></i> Add Images</a></button></li>
                <li><button class="edit-btn"><a href="#"><i class="fa-regular fa-pen-to-square"></i> Edit</a></button></li>
                <li><button class="delete-btn"><a href="#"><i class="fa-regular fa-trash-can"></i> Delete</a></button></li>
                <li><button class="visible-btn"><a href="#"><i class="fa-regular fa-eye-slash"></i> Visible</a></button></li>
                <li><button class="save-btn"><a href="#"><i class="fa-regular fa-floppy-disk"></i> Save</a></button></li>
            </ul>
        </div>
    </section> -->
</main>