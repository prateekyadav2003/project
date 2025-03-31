<style>
    .login-modal .modal-content {
        background-color: #2d2d2d;
        color: white;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        width: 100%;
        max-width: 500px;
        margin: auto;
        border: 2px ;
    }

    .login-modal .modal-header {
        padding: 1rem;
        border-bottom: 2px rgb(10, 10, 10);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .login-modal .modal-title {
        text-align: center;
        font-size: 1.5rem;
        font-weight: bold;
        width: 100%;
    }

    .login-modal .close {
        background: none;
        border: none;
        color: white;
        font-size: 1.5rem;
        cursor: pointer;
    }

    .login-modal .modal-body {
        padding: 1.5rem;
    }

    .login-modal .form-group {
        margin-bottom: 1.5rem;
    }

    .login-modal .form-group label {
        display: block;
        font-size: 0.875rem;
        font-weight: 500;
        margin-bottom: 0.5rem;
    }

    .login-modal .form-group input {
        width: 100%;
        padding: 0.75rem;
        border-radius: 6px;
        background-color: #3a3a3a;
        color: white;
        border: 1px ;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .login-modal .form-group input:focus {
        border-color: black;
        box-shadow: 0 0 0 2px rgba(0, 0, 0, 0.3);
    }

    .login-modal .btn-primary {
        width: 100%;
        background-color: #4b47d9;
        color: white;
        padding: 1rem;
        border-radius: 6px;
        font-weight: 500;
        transition: background-color 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .login-modal .btn-primary:hover {
        background-color: #4b47d9;
    }

    .login-modal .forgot-btn{
        text-align: right;
    }

    .login-modal .modal-footer {
        text-align: center;
        font-size: 0.875rem;
        margin-top: 1rem;
    }

    button{
        border: none;
        color: white;
        background-color: transparent;
        outline: none;
        font-weight: 450;
        cursor: pointer
    }

    .login-modal .modal-footer span {
        color: black;
    }

    .login-modal .modal-footer a {
        color: #4b47d9;
        font-weight: 600;
        text-decoration: none;
        transition: color 0.3s ease, text-shadow 0.3s ease;
    }

    .login-modal .modal-footer a:hover {
        color: #4b47d9;
        text-shadow: 0 0 10px rgba(75, 71, 217, 0.8);
    }
</style>

<div class="modal login-modal" id="login-modal" tabindex="-1" aria-labelledby="login-heading" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="login-heading">Login with PG Finder</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="login-form" method="post" action="api/login_submit.php">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Email" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Password" minlength="6" required>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn-primary">Login</button>
                    </div>
                </form>
                <!----------------- Forgot password ------------------->
                <div class="forgot-btn">
                    <button type="button">Forgot Password?</button>
                </div>
            </div>

            <div class="modal-footer">
                <span>Don't have an account? 
                    <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#signup-modal">Click here to register</a>
                </span>
            </div>

            
        </div>
    </div>
</div>

<!-- Forgot Password Modal -->
<div class="modal" id="forgot-password-modal" tabindex="-1" aria-labelledby="forgot-password-heading" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="forgot-password-heading">Reset Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="forgot-password-form" method="post" action="api/forgot_password.php">
                    <div class="form-group">
                        <label for="forgot-email">Email</label>
                        <input type="email" id="forgot-email" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn-primary">Send Reset Link</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelector('.forgot-btn button').addEventListener('click', function() {
    $('#forgot-password-modal').modal('show');
});
</script>