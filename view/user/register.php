<h1 style="text-align: center;">User Registration</h1>
<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <form id="frmRegister">
                <div class="container">
                    <div class="row row-loose">
                        <div class="col-md-6 lbl lbl-right">Username</div>
                        <div class="col-md-6"> : <input type="text" id="username" name="username" placeholder="E.g. johndoe123" /></div>
                    </div>
                    <div class="row row-loose">
                        <div class="col-md-6 lbl lbl-right">First Name</div>
                        <div class="col-md-6"> : <input type="text" id="firstName" name="firstName" placeholder="E.g. John" /></div>
                    </div>
                    <div class="row row-loose">
                        <div class="col-md-6 lbl lbl-right">Last Name</div>
                        <div class="col-md-6"> : <input type="text" id="lastName" name="lastName" placeholder="E.g. Doe" /></div>
                    </div>
                    <div class="row row-loose">
                        <div class="col-md-6 lbl lbl-right">Email</div>
                        <div class="col-md-6"> : <input type="text" id="email" name="email" placeholder="E.g. johndoe@example.com" /></div>
                    </div>
                    <div class="row row-loose">
                        <div class="col-md-6 lbl lbl-right">Password</div>
                        <div class="col-md-6"> : <input type="password" id="password" name="password" placeholder="E.g. JohnDoeIsMe" /></div>
                    </div>
                    <div class="row row-loose">
                        <div class="col-md-6 lbl lbl-right">Confirm Password</div>
                        <div class="col-md-6"> : <input type="password" id="confirmPassword" name="confirmPassword" placeholder="E.g. JohnDoeIsMe" /></div>
                    </div>
                    <div class="row row-loose">
                        <div class="col-md-2"></div>
                        <div class="col-md-3">
                            <input type="button" class="btn btn-primary btn-block" id="btnRegister" value="Register" />
                        </div>
                        <div class="col-md-2"></div>
                        <div class="col-md-3">
                            <input type="button" class="btn btn-warning btn-block" id="btnClear" value="Clear" />
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $(document).on("click", "#btnRegister", function(){
            var password = $("#password").val();
            var confirmPassword = $("#confirmPassword").val();

            if(password !== confirmPassword){
                //Passwords mismatching
                alert("Passwords do not match!");
            }

            var user = {
                username: $("#username").val(),
                firstName: $("#firstName").val(),
                lastName: $("#lastName").val(),
                email: $("#email").val(),
                password: $("#password").val()
            };

            $.ajax({
                url: "/BITProject2019/user/doRegistration",
                type: "POST",
                dataType: "JSON",
                data: {
                    userData: user
                },
                success: function(data){
                    alert("Successfully registered!");
                    console.log(data);
                },
                error: function(jqXHR, textStatus, errorThrown){
                    alert(textStatus);
                    console.log(errorThrown);
                }
            })
        });
    });
</script>