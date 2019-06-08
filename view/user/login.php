<h1>User Login</h1>
<input type="text" name="username" id="txtUsername" placeholder="Username" />
<input type="password" name="password" id="txtPassword" placeholder="Password" />
<input type="button" name="login" value="Login" id="btnLogin" />

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