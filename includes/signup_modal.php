<div class="modal fade" id="signup-modal" tabindex="-1" role="dialog" aria-labelledby="signup-heading" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #2d2d2d; color: white;">
            <div class="modal-header" style="border-bottom: none;">
                <h5 class="modal-title" id="signup-heading" style="font-size: 24px; font-weight: bold;">Signup with PG Finder</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="signup-form" class="form" role="form" method="post" action="api/signup_submit.php">
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" class="form-control" name="full_name" placeholder="Full Name" maxlength="30" required 
                               style="background-color: #3d3d3d; color: white; border: none; border-radius: 5px; padding: 10px; margin-bottom: 10px;">
                    </div>

                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" class="form-control" name="phone" placeholder="Phone Number" maxlength="10" minlength="10" required 
                               style="background-color: #3d3d3d; color: white; border: none; border-radius: 5px; padding: 10px; margin-bottom: 10px;">
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Email" required 
                               style="background-color: #3d3d3d; color: white; border: none; border-radius: 5px; padding: 10px; margin-bottom: 10px;">
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password" minlength="6" required 
                               style="background-color: #3d3d3d; color: white; border: none; border-radius: 5px; padding: 10px; margin-bottom: 10px;">
                    </div>

                    <div class="form-group">
                        <label>College Name</label>
                        <input type="text" class="form-control" name="college_name" placeholder="College Name" maxlength="150" required 
                               style="background-color: #3d3d3d; color: white; border: none; border-radius: 5px; padding: 10px; margin-bottom: 15px;">
                    </div>

                    <div class="form-group">
                        <span>I'm a</span>
                        <div class="radio-group" style="display: flex; gap: 20px; margin-top: 10px;">
                            <label style="display: flex; align-items: center; gap: 5px;">
                                <input type="radio" name="gender" value="male" style="appearance: none; width: 16px; height: 16px; border: 2px solid #4B47D9; border-radius: 50%; position: relative;">
                                Male
                            </label>
                            <label style="display: flex; align-items: center; gap: 5px;">
                                <input type="radio" name="gender" value="female" style="appearance: none; width: 16px; height: 16px; border: 2px solid #4B47D9; border-radius: 50%; position: relative;">
                                Female
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-block" 
                                style="background-color: #4B47D9; color: white; padding: 10px; border: none; border-radius: 5px; font-weight: bold; transition: background-color 0.3s;">
                            Create Account
                        </button>
                    </div>
                </form>
            </div>

            <div class="modal-footer" style="border-top: none;">
                <span style="color: black;">Already have an account?
                    <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#login-modal" 
                       style="color: #4B47D9; font-weight: bold; text-decoration: none;">Login</a>
                </span>
            </div>
        </div>
    </div>
</div>

<style>
    /* Ensures the radio button style is unchanged */
    .radio-group input[type="radio"]:checked::before {
        content: "";
        width: 10px;
        height: 10px;
        background-color: #4B47D9;
        border-radius: 50%;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    /* Add specific class selector for modal input fields */
    #signup-modal .form-control {
        background-color: #3d3d3d !important;
        color: white !important;
        border: none !important;
        border-radius: 5px !important;
        padding: 10px !important;
        margin-bottom: 10px !important;
    }

    /* Apply styles when input fields in modal are focused */
    #signup-modal .form-control:focus {
        background-color: #3d3d3d !important;  /* Keep same background color */
        color: white !important;
        box-shadow: none !important;
        border-color: transparent !important;
    }

    /* Apply when inputs in modal are filled (avoid changing other input fields) */
    #signup-modal .form-control:not(:placeholder-shown) {
        background-color: #3d3d3d !important;  /* Keep it consistent */
    }

    /* Ensures the modal content has rounded corners */
    #signup-modal .modal-content {
        border-radius: 10px;
    }

    /* Hover effect for modal button */
    #signup-modal .btn:hover {
        background-color: #3A36C9 !important;
    }
</style>
