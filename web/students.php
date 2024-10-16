<?php

  $hasBack = true;
  include "templates/header.php";

  $page = get_query_string("page", "");

  $headQuery = "";
  if ($role=="Head") {
    $headQuery = "and headId=$account->Id";
  }

  
  $account_list = account()->list("Id>0 $headQuery and role='Student' and isDeleted=0");
?>



<div class="containe mt-5">


    <div class="card card-body  shadow-sm border-0 rounded-lg mt-2">
        <div class="table-responsive" style="min-height:300px;">
            <table class="table search-table align-middle text-nowrap">
                <thead class="header-item">
                <th>#</th>
                <th>Username</th>
                    <th>Student</th>
                    <th>Date Added</th>
                    <?php if ($page): ?>
                        <th width="10%">Action</th>
                    <?php endif; ?>
                </thead>
                <tbody>
                    <!-- start row -->

                    <?php
                $count = 0;
                foreach ($account_list as $row):
                  $count += 1;
                   ?>

                    <tr class="search-items">
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="ms-3">
                                    <div class="user-meta-info">
                                        <h6 class="user-name mb-0"><?=$count;?></h6>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="ms-3">
                                    <div class="user-meta-info">
                                        <h6 class="user-name mb-0"><?=$row->username;?></h6>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="ms-3">
                                    <div class="user-meta-info">
                                        <h6 class="mb-0"><?=$row->firstName;?> <?=$row->lastName;?></h6>
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
                        <?php if ($page=="dtr"): ?>
                            <td><a href="dtr.php?studentId=<?=$row->Id?>" class="btn btn-primary">View DTR</a></td>
                    <?php endif; ?>
                        <?php if ($page=="coe"): ?>
                            <td><a href="" class="btn btn-primary">View COE</a></td>
                    <?php endif; ?>
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