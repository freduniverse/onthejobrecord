<?php
include "templates/header.php";

?>
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-lg-5">
              <div class="card shadow-lg border-0 rounded-lg mt-5 p-3">
                  <div class="card-body">
                    <h3 class="text-center">Log in</h3> <hr>
                    <span style="color:red;"><?=$error;?></span>
                    <span style="color:green;"><?=$success;?></span>
                      <form method="post" action="processAuth.php?action=user-login">
                          <div class="form-floating mb-3">
                              <input class="form-control" id="inputUsername" name="username" type="text" placeholder="User Name" />
                              <label for="inputUsername">User Name</label>
                          </div>
                          <div class="form-floating mb-3">
                              <input class="form-control" id="inputPassword" name="password" type="password" placeholder="Password" />
                              <label for="inputPassword">Password</label>
                          </div>
                          <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                              <button type="submit" class="btn btn-primary">Login</button>
                          </div>
                          <br>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
