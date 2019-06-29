<h1 style="text-align: center;">Login</h1>
<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <form id="frmRegister">
                <div class="container">
                    <div class="row row-loose">
                        <div class="col-md-2"></div>
                        <div class="col-md-8"><input type="text" class="form-control" style="text-align: center;" id="txtUsername" name="username" placeholder="Username" /></div>
                        <div class="col-md-2"></div>
                    </div>
                    <div class="row row-loose">
                        <div class="col-md-2"></div>
                        <div class="col-md-8"><input type="password" class="form-control" style="text-align: center;" id="txtPassword" name="password" placeholder="Password" /></div>
                        <div class="col-md-2"></div>
                    </div>
                    <div class="row row-loose">
                        <div class="col-md-2"></div>
                        <div class="col-md-3">
                            <input type="button" class="btn btn-primary btn-block" id="btnLogin" value="Login" />
                        </div>
                        <div class="col-md-2"></div>
                        <div class="col-md-3">
                            <input type="button" class="btn btn-warning btn-block" id="btnCancel" value="Cancel" />
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
        $(document).on("click", "#btnLogin", function(){
            var username = $("#txtUsername").val();
            var password = $("#txtPassword").val();
            var postBack = "<?=$postBack?>";

            $.ajax({
                url: "/BITProject2019/user/authenticate",
                type: "POST",
                dataType: "JSON",
                data: {
                    username: username,
                    password: password,
                    postBack: postBack
                },
                success: function(data){
                    window.location = data.postBack;
                },
                error: function(jqXHR, textStatus, errorThrown){
                    alert(textStatus);
                    console.log(errorThrown);
                }
            })
        });
    });
</script>