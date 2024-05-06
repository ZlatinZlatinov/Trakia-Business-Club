<?php
    include('./config/connect_db.php');
?>
<main class="site-main">
        <!-- #Events -->
        <section id="events">

            <h2 class="section-heading">Events</h2>

            <div class="width-wrapper">
                <?php
                    $query = "SELECT * from events"; 
                    $result = mysqli_query($connectionString, $query); // Query the database
                    $num_results = $result->num_rows; 

                    while($row = $result->fetch_assoc()) { 
                        echo "<div class='event-card'>"; 
                        echo "<a href='details.php'>";
                        
                        echo "<span class='event-date'>FEB<br>21</span>";
                        
                        echo "<img src='{$row['imageFileName']}'>";
                        echo "<h4 class='event-title'>" . $row['topic'] . "</h4>";
                        echo "<p>" . $row['eventStart'] . "</p>";
                        
                        echo "</a>";
                        echo "</div>"; // Close event-card container
                    }
                ?>
            </div>
        </section>

        <!-- Pagination -->
        <section id="pagination" class="pagination">
            <ul>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">...</a></li>
                <li><a href="#">10</a></li>
            </ul>
        </section>
</main>