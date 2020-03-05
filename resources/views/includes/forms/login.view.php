<div class="card">
    <div class="card-header text-center">
        <img src="<?= asset('img/beng_cap_logo.png') ?>" class="w-25" alt="BenguetCapitolLogo">
        <h1 class="h3 mt-3">InfoTechServices</h1>
    </div>
    <div class="card-body">
        <!-- Login Form -->
        <form method="POST" id="login-form">
            <!-- action -->
            <input type="hidden" name="attemptLogin">
            <!-- /# action -->

            <div class="form-group">
                <!-- <label for="username" class="bmd-label-floating">Username</label> -->
                <input type="text" id="username" class="form-control" name="username" placeholder="Username">
            </div>

            <div class="form-group">
                <!-- <label for="password" class="bmd-label-floating">Password</label> -->
                <input type="password" id="password" class="form-control" name="password" placeholder="Password">
            </div>

            <div class="row">
                <div class="col text-center">
                    <button type="submit" name="login" class="btn btn-md btn-rounded btn-primary form text-capitalize mt-2 mx-auto">
                        <i class="fas fa-sign-in-alt"></i>
                        Login
                    </button>
                </div>
            </div>
        </form>
        <!-- /# Login Form -->
    </div>
</div>