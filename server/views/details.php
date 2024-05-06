

<main class="site-main">

    <!-- #Details -->
    <section id="details">
        <div class="width-wrapper">

            <!-- event-description -->
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
                <?php
                    $query = "SELECT * from events WHERE id = $id"; 
                    $result = mysqli_query($connectionString, $query); // Query the database
                    $num_results = $result->num_rows; 

                    while($row = $result->fetch_assoc()) { 
                        echo "<div>"; 
                        
                        echo "<h2>". $row['topic'] . "</h2>";
                    
                        // Fetching date and time from database
                        $startingDateResult = mysqli_query($connectionString, "SELECT DATE(eventStart) AS startDate FROM events WHERE id = $id");
                        $startingDateRow = $startingDateResult->fetch_assoc();
                        $startingDate = $startingDateRow['startDate'];

                        $endingDateResult = mysqli_query($connectionString, "SELECT DATE(eventEnd) AS endDate FROM events WHERE id = $id");
                        $endingDateRow = $endingDateResult->fetch_assoc();
                        $endingDate = $endingDateRow['endDate'];

                        $startingTimeResult = mysqli_query($connectionString, "SELECT TIME(eventStart) AS startTime FROM events WHERE id = $id");
                        $startingTimeRow = $startingTimeResult->fetch_assoc();
                        $startingTime = $startingTimeRow['startTime'];

                        $endingTimeResult = mysqli_query($connectionString, "SELECT TIME(eventEnd) AS endTime FROM events WHERE id = $id");
                        $endingTimeRow = $endingTimeResult->fetch_assoc();
                        $endingTime = $endingTimeRow['endTime'];

                        echo "<p><i class='fa-regular fa-calendar-days'></i>" . $startingDate . " - " . $endingDate ."<br>" .
                            "<i class='fa-solid fa-clock'></i>" . $startingTime . " - " . $endingTime . "</p>";

                        echo "<p><i class='fa-solid fa-location-pin'></i>" . $row['place'] .  "</p>";

                        echo "</div>"; 
                    }
                ?>

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

    <!-- Only for Admins -->
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
    </section>
</main>