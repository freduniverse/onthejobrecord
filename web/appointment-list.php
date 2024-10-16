<?php

  $hasBack = true;
  include "templates/header.php";

  $appointmentList = appointment()->list();
?>



<div class="widget-content searchable-container list">
    <!-- --------------------- start Contact ---------------- -->
    <div class="card card-body">
        <div class="row justify-content-center">
            <div class="col-md-4 col-xl-3 ">
                <form class="position-relative">
                    <input type="text" onkeydown="return (event.keyCode!=13);" class="form-control product-search ps-5"
                        id="input-search" placeholder="Search Appointment..." />
                    <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
                </form>
            </div>
        </div>
    </div>

 
    <div class="card card-body">
        <div class="table-responsive" style="min-height:300px;">
            <table class="table search-table align-middle text-nowrap">
                <thead class="header-item">
                    <th>Patient Name</th>
                    <th>Appointment Date</th>
                    <th width="10%">Action</th>
                </thead>
                <tbody>
                    <!-- start row -->

                    <?php
                $count = 0;
                foreach ($appointmentList as $row):
                    $patient = account()->get("Id=$row->patientId");
                  $count += 1;
                   ?>

                    <tr class="search-items">
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="ms-3">
                                    <div class="user-meta-info">
                                        <h6 class="mb-0"><?=$patient->firstName;?> <?=$patient->lastName;?></h6>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="ms-3">
                                    <div class="user-meta-info">
                                        <h6 class="mb-0"><?=format_date($row->dateAdded);?></h6>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <a href="appointment-form.php?appointmentId=<?=$row->Id?>" class="btn btn-primary">View</a>
                        </td>
                    </tr>
                    <!-- end row -->

                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include "templates/footer.php"; ?>


<script type="text/javascript">
$(function() {

    $("#input-search").on("keyup", function() {
        var rex = new RegExp($(this).val(), "i");
        $(".search-table .search-items:not(.header-item)").hide();
        $(".search-table .search-items:not(.header-item)")
            .filter(function() {
                return rex.test($(this).text());
            })
            .show();
    });

    $("#btn-add-contact").on("click", function(event) {

        var $_username = document.getElementById("c-username");
        $_username.value = "";

        var $_generatedpw = Math.floor(Math.random() * 899999 + 100000);

        var $_password = document.getElementById("c-password");
        $_password.value = $_generatedpw;

        var $_dpassword = document.getElementById("c-display-password");
        $_dpassword.value = $_generatedpw;

        $("#addContactModal #btn-add").show();
        $("#addContactModal #btn-edit").hide();
        $("#addContactModal").modal("show");
    });


    function editContact() {
        $(".edit").on("click", function(event) {
            $("#addContactModal #btn-add").hide();
            $("#addContactModal #btn-edit").show();

            // Get Parents
            var getParentItem = $(this).parents(".search-items");
            var getModal = $("#addContactModal");

            // Get List Item Fields
            var $_name = getParentItem.find(".user-name");
            // Set Modal Field's Value
            getModal.find("#c-id").val($_name.attr("data-id"));
            getModal.find("#c-username").val($_name.attr("data-username"));
            getModal.find("#c-firstName").val($_name.attr("data-firstName"));
            getModal.find("#c-lastName").val($_name.attr("data-lastName"));
            if ($_name.attr("data-status") == "Inactive") {
                getModal.find("#c-display-password").val($_name.attr("data-password"));
            } else {
                getModal.find("#c-display-password").val("Not shown for security");
            }

            $("#addContactModal").modal("show");
        });
    }

    editContact();

});
</script>