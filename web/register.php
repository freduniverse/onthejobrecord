<?php
  $pageTitle = "Patient Form";
  $hasBack = true;
    include "templates/header.php";

    $accountRole = "Student";

    $headList = account()->list("role='Head'");

?>



<div class="container">


    <div class="row justify-content-center">
        <div class="col-6 mb-5 mt-5">

            <div class="card  shadow-sm border-0 rounded-lg">
                <div class="card-body">
                    <form action="process.php?action=register-student" method="post">
                        <input type="hidden" name="role" value="<?=$accountRole?>">
                        <div class="row">
                            <div class="col-12 mt-3">
                                <h4>New <?=$accountRole?> Form</h4>
                                <hr>
                            </div>
                            <div class="col-6 mt-3">
                                <b>Username</b>
                                <input type="text" name="username" id="form-username" class="form-control mt-2"
                                    required>
                            </div>
                            <div class="col-6 mt-3">
                                <b>Password</b>
                                <input type="text" name="password" id="form-password" class="form-control mt-2"
                                    required>
                            </div>
                            <div class="col-6 mt-3">
                                <b>First Name</b>
                                <input type="text" name="firstName" id="form-firstName" class="form-control mt-2"
                                    required>
                            </div>
                            <div class="col-6 mt-3">
                                <b>Last Name</b>
                                <input type="text" name="lastName" id="form-lastName" class="form-control mt-2"
                                    required>
                            </div>
                            <div class="col-6 mt-3">
                                <b>Sex</b>
                                <select name="sex" id="form-sex" class="form-select mt-2">
                                    <option value="">--Select--</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </div>
                            
                            <?php if ($accountRole=="Head"): ?>
                            <div class="col-12 mt-3">
                                <hr>
                                <b>Company</b>
                                <input type="text" name="company" id="form-company" class="form-control mt-2" required>
                            </div>
                            <div class="col-12 mt-3">
                                <b>Company Address</b>
                                <input type="text" name="address" id="form-address" class="form-control mt-2" required>
                            </div>
                            <?php endif; ?>

                            <?php if ($accountRole=="Student"): ?>
                            <div class="col-6 mt-3">
                                <b>Course</b>
                                <input type="text" name="course" id="form-course" class="form-control mt-2" required>
                            </div>
                            <div class="col-6 mt-3">
                                <b>Company</b>
                                <select name="headId" id="form-headId" class="form-select mt-2">
                                    <option value="">--Select--</option>
                                    <?php foreach ($headList as $row): ?> 
                                        <option value="<?=$row->Id?>"><?=$row->company?></option>
                                     <?php endforeach; ?>
                                </select>
                            </div>
                            <?php endif; ?>

                            <div class="col-6 mt-3">
                                <b>Phone Number</b>
                                <input type="text" name="phone" id="form-phone" class="form-control mt-2" required>
                            </div>
                            <div class="col-6 mt-3">
                                <b>Email</b>
                                <input type="text" name="email" id="form-email" class="form-control mt-2" required>
                            </div>
                            <div class="col-12 mt-3">
                                <button class="btn btn-primary" type="submit" name="form-type" value="add">Create
                                    Account</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include "templates/footer.php"; ?>