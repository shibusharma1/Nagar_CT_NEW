<?php
$title = "Nagar CT | Feedback";
$current_page = "vehicles";

include_once 'master_header.php';
require_once '../config/connection.php';

?>
<div class="table-heading">
  <div class="heading-2">
    <h2>Feedback List</h2>
  </div>
  <div class="add-button">
    <button>
      <i class="fa fa-plus" aria-hidden="true"></i> Add
    </button>
  </div>
</div>

<table>
  <thead>
    <tr>
      <th>S.N</th>
      <th>Email</th>
      <th>Message</th>
      <th>Status</th>
      <th>Action</th>
      <th>Created at</th>
    </tr>
  </thead>
  <tbody>
  <tr>
      <td>1</td>
      <td>abc@gmail.com </td>
      <td>This is a test message.</td>
      <td>status..</td>
      <td>action..</td>
      <td>created at...</td>
    </tr>
  </tbody>

</table>
<?php
include_once 'master_footer.php';
?>