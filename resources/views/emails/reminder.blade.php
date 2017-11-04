
    <h3>Dear <em>{{ $data['name'] }}</em>,</h3>
    <em>Congratulations and welcome you to Documnet Management website!</em> <br>
    Now you can use these following information to login: <br/>

    <strong>Email: </strong>{{ $data['email'] }}
    <br/>
    <strong>Username: </strong>{{ $data['name'] }}
    <br/>
    <strong>Init Password: </strong>{{ $data['password'] }}
    <br/>
    <strong>Your role: </strong>{{ $data['role'] }}
    <br/>
    <em>(Please note that you have to change password on first login.)</em>
    <br/>

    <br/>

    Thank you! Please log in at localhost:8000/login.
    If you have any questions, please let me know! <br/>

    <br/>

    <em>Regards,</em> <br/>
    Document Management Administrator <br/>

    Mail: phamha.qhi@gmail.com

