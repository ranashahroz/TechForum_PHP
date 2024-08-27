<!-- Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="signupModalLabel">Sign Up</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

      <form action="/forum/partials/_handleSignup.php" method="post">
      <div class="mb-3">
                        <label for="name" class="form-label">User Name <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="userName" id="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address <span style="color: red;">*</span></label>
                        <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password <span style="color: red;">*</span></label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="cpassword" class="form-label">Confirm Password <span style="color: red;">*</span></label>
                        <input type="password" class="form-control" name="cpassword" id="cpassword" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Signup</button>
                </form>
      </div>
    </div>
  </div>
</div>