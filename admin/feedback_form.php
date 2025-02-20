<?php
$title = "Nagar CT | Feedback";
$current_page="feedback";

include_once 'master_header.php';
require_once '../config/connection.php';

?>
<div class="custom-form-container">
      <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="email" class="form-label">Email</label>
          <input
            type="email"
            class="form-input"
            id="email"
            placeholder="Enter your email"
          />
        </div>
        <div class="form-group">
          <label for="message" class="form-label">Message</label>
          <textarea
            class="form-textarea"
            id="message"
            placeholder="Enter your message"
          ></textarea>
        </div>
        <div class="form-group">
          <label for="image" class="form-label">Upload Image</label>
          <input type="file" class="form-file" id="image" />
        </div>
        <button type="submit" class="custom-btn">Submit</button>
      </form>
    </div>





<?php
include_once 'master_footer.php';
?>        
