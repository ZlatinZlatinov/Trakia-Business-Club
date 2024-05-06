<?php
    include('./config/connect_db.php');

    //Put the the right image folder path
    $targetDir = "./eventImages/"; 
    $imageMsg = ''; 
    $eventMsg = '';

    if($_SERVER["REQUEST_METHOD"] == "POST"){ 
        // Extract event data from the form
        $topic = $_POST['title'];
        $lecturer = $_POST['lecturer'];
        $eventStart = $_POST['start'];
        $eventEnd = $_POST['end'];
        $place = $_POST['location'];
        $description = $_POST['description'];
        $optionalInformation = $_POST['optional'];
        $isVisible = "";

        if (isset($_POST['isVisible']) && $_POST['isVisible'] == 'yes'){
            $isVisible = "true";
        } else{
            $isVisible = "false";
        }
        

        // Check if an image file is selected
        if(!empty($_FILES["img"]["name"])){ 
            $fileName = basename($_FILES["img"]["name"]); 
            $targetFilePath = $targetDir . $fileName;
            //Put the the right image folder path
            $imgUrl = "eventImages/" . $fileName; 
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 

            // Allow  file formats 
            $allowTypes = array('jpg','png','jpeg'); 
            if(in_array($fileType, $allowTypes)){ 
                // Upload file to server 
                if(move_uploaded_file($_FILES["img"]["tmp_name"], $imgUrl)){ 
                    //Insert image file name into database 
                    $insertEvent = mysqli_query($connectionString, "INSERT INTO events (topic, lecturer ,place, imageFileName,  eventStart, eventEnd, optionalInformation, isVisible) VALUES ('{$topic}', '{$lecturer}', '{$place}', '{$imgUrl}', '{$eventStart}', '{$eventEnd}', '{$optionalInformation}', '{$isVisible}')"); 
                        
                    if($insertEvent){ 
                        $eventMsg = "Event uploaded successfully."; 
                    } else { 
                        $eventMsg = "Error uploading event: " . mysqli_error($connectionString); 
                    }
                } else { 
                    $imageMsg = "Sorry, there was an error uploading your file."; 
                } 
            } else { 
                $imageMsg = 'Sorry, only JPG, JPEG, PNG files are allowed to upload.'; 
            } 
        } else { 
            $imageMsg = 'Please select an image file to upload.'; 
        } 
    } 
    // Display status message 
    // echo $statusMsg; 
?>

<main class="site-main">
            <!-- #Create -->
    <section id="create">

        <!-- Form container -->
        <div>
            <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST" enctype="multipart/form-data" class="create-form">
                <h2>Add New Event</h2>
                <!-- Event title -->
                <div>
                    <label for="title">Event Title</label>
                    <input type="text" name="title" id="title">
                </div>
                <!-- Event lecturer -->
                <div>
                    <label for="lecturer">Event Lecturer</label>
                    <input type="text" name="lecturer" id="title">
                </div>
                <!-- Event location -->
                <div>
                    <label for="location">Event Location</label>
                    <input type="text" name="location" id="location">
                </div>

                <!-- Event Date -->
                <!-- <div>
                    <label for="date">Event Date</label>
                    <input type="date" name="date" id="date">
                </div> -->

                <!-- Event Start -->
                <div>
                    <label for="start">Event Start</label>
                    <input type="datetime-local" name="start" id="start">
                </div>

                <!-- Event End -->
                <div>
                    <label for="start">Event End</label>
                    <input type="datetime-local" name="end" id="end">
                </div>

                <!-- Event Image -->
                <div>
                    <label for="img">Event Image</label>
                    <input type="file" name="img" id="img">
                    <span class="error">* <?php echo $imageMsg;?></span>
                </div>

                <!-- Optional Information -->
                <div>
                    <label for="optional">Optional Information</label>
                    <input type="text" name="optional" id="optional">
                </div>

                <!-- Event Description -->
                <div>
                    <label for="description">Event Description</label>
                    <textarea name="description" id="description" cols="50"></textarea>
                </div>

                <!-- Event Visibility -->
                <div>
                    <label for="isVisible">Make Visible</label>
                    <input type="checkbox" name="isVisible" id="isVisible" value="yes">
                </div>

                <!-- Submit -->
                <input type="submit" class="submit-btn" value="Add">
                <span class="error">* <?php echo $eventMsg;?></span>
            </form>
        </div>
    </section>
</main>