<?php
  $hasBack = true;
include "templates/header.php";

$patientId = $_GET["patientId"];
$patient = account()->get("Id=$patientId");

?>


<div class="container">
    <div class="card" style="margin: 0px 50px">
        <div class="card-body">
            <form action="process.php?action=appointment-save" method="post">
            <input type="hidden" name="doctorId" value="<?=$account->Id?>">
            <input type="hidden" name="patientId" value="<?=$patient->Id?>">
                <div class="row">
                    <div class="col-12 mt-3">
                        <h3>New Appointment Form</h3>
                        <hr>
                    </div>
                    <div class="col-4 mt-3">
                        <b>Patient: </b>
                        <input type="text" name="password" id="form-password" class="form-control mt-2" value="<?=$patient->firstName?> <?=$patient->lastName?>" disabled>
                    </div>
                    <div class="col-4 mt-3">
                        <b>Doctor</b>
                        <input type="text" name="password" id="form-password" class="form-control mt-2" value="<?=$account->firstName?> <?=$account->lastName?>" disabled>
                    </div>
                    <div class="col-4 mt-3">
                        <b>Appointment Date</b>
                        <input type="text" name="firstName" id="form-firstName" class="form-control mt-2" value="<?=date('Y-m-d')?>" disabled>
                    </div>
                    <div class="col-12 mt-3">
                        <b>Purpose</b>
                        <textarea name="purpose" class="form-control mt-2" style="height:200px;"></textarea>

                        <br>

                        <button class="btn btn-primary" name="form-type" value="add">Submit</button>
                    </div>
                   
                </div>
            </form>
        </div>
    </div>
</div>


<?php include "templates/footer.php"; ?>