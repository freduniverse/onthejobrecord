<?php
  $hasBack = false;
include "templates/header.php";

$studentId = $account->Id;
$hasAddButton = true;
if (isset($_GET["studentId"])) {
  $studentId = $_GET["studentId"];
  $hasAddButton = false;
}

$dtrList = dtr()->list("studentId=$studentId");

?>
    <section class="p-3 mt-3">
      <div class="row text-center"> 
        <div class="col-4">
          <div class="card shadow-lg border-0 rounded-lg">
            <div class="card-body">
              <h3>Hours Needed: 300</h3>
            </div>
          </div>
        </div>
        
        <div class="col-4">
          <div class="card shadow-lg border-0 rounded-lg">
            <div class="card-body">
              <h3>Hours Rendered: 0</h3>
            </div>
          </div>
        </div>
        
        <div class="col-4">
          <div class="card shadow-lg border-0 rounded-lg">
            <div class="card-body">
              <h3>Hours Left: 0</h3>
            </div>
          </div>
        </div>

      </div>

      <?php if ($hasAddButton): ?>
        <button class="btn btn-primary mt-4" data-bs-toggle="modal" data-bs-target="#exampleModal">Add New DTR +</button>
      <?php endif; ?>

      <div class="card shadow-lg border-0 rounded-lg mt-3"> 
        <div class="card-body">

        <table class="table">
          <tr>
          <th>#</th>
          <th>Date</th>
          <th>Time</th>
          <th>Task</th>
          <th>Total Hours</th>
          </tr>

          <?php 
          $count = 0;
          foreach ($dtrList as $row):
            $count += 1;
           ?> 
          <tr>
            <td><?=$count?></td>
            <td><?=$row->date?></td>
            <td><?=$row->timeStart?> to <?=$row->timeEnd?></td>
            <td><?=$row->task?></td>
            <td>0</td>
          </tr>
           <?php endforeach; ?>
        </table>

        </div>
      </div>

    </section>


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">DTR Form</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="process.php?action=dtr-add" method="post">
      <input type="hidden" name="studentId" value="<?=$account->Id?>">
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <b>Date</b>
              <input type="date" class="form-control mt-2" name="date" required>
            </div>
        
            <div class="col-6">
              <b>Start Time</b>
              <input type="time" class="form-control mt-2" name="timeStart" required>
            </div>
        
        <div class="col-6">
          <b>End Time</b>
          <input type="time" class="form-control mt-2" name="timeEnd" required>
        </div>
        
        <div class="col-12">
          <b>What did you do?</b>
          <textarea name="task"class="form-control mt-2" ></textarea>
        </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php include "templates/footer.php"; ?>