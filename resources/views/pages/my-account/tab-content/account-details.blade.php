<div class="tab-pane fade" id="account-details">
    <h3>Account details </h3>
    <div class="login">
        <div class="login_form_container">
            <div class="account_login_form">
                <form action="#">
                    <div class="default-form-box mb-20">
                        <label>Full Name</label>
                        <input type="text" name="first-name" value="{{ auth()->user()->name }}">
                    </div>
                    <div class="default-form-box mb-20">
                        <label>Email</label>
                        <input type="email" name="email-name" value="{{ auth()->user()->email }}">
                    </div>
                    <div class="default-form-box mb-20">
                        <label>Phone no</label>
                        <input type="text" name="phone-name">
                    </div>
                    <div class="default-form-box mb-20">
                        <label>Password</label>
                        <input type="password" name="user-password">
                    </div>
                    <div class="save_button mt-3">
                        <button class="btn btn-md btn-black-default-hover"
                                type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
