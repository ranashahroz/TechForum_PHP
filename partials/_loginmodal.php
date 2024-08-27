<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="loginModalLabel">Login</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="/forum/partials/_handleLogin.php" method="post">

                    <div class="mb-3">
                        <label for="email" class="form-label">Email address <span style="color: red;">*</span></label>
                        <input type="email" class="form-control" name="loginEmail" id="email" aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password <span style="color: red;">*</span></label>
                        <input type="password" class="form-control" name="loginPassword" id="password" required>
                    </div>
                    <button type="submit" class="btn btn-success">Login</button>
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-center align-items-center">
                <p>Please signup first if you want to login. </p>
                <a href="" data-bs-toggle="modal" data-bs-target="#signupModal">Signup</a>
            </div>
        </div>
    </div>
</div>