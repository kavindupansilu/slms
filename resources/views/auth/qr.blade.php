<!DOCTYPE html>
<html>
<head>
    <title>Student Details</title>
</head>
<body>

<h1>Hello {{ $fname }} {{ $lname }}!</h1>
<h4>Welcome to BCI Campus Negombo</h4>
<br>
<div class="container">
    <h2 style="font-size: 20px;">Student Details</h2>
    <br>
    <div class="col-md-4 mb-3">
        <div class="card">
            <div class="card-body text-center">
                <h4 class="card-title">{{ $fname }} {{ $lname }} <br>{{ $degree_name }}</h4>
                <p class="card-text">Student Id: {{ $student_id }}</p>
                <img src="cid:qrcode.png" alt="QR Code" style="width: 100px; height: 100px;">
            </div>
        </div>
    </div>
</div>

<br><br>
<p>Use this QR when marking the Attendance inside the Campus<br>
Thanks.<br><br>
Best Regards,<br>
BCI Campus<br>
Negombo<br>
Administration</p>

</body>
</html>
