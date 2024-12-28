<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan QR Code</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@zxing/library@0.18.5"></script>
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Scan QR Code</h1>
        <form method="POST" action="{{ route('attendances.mark') }}">
            @csrf
            <div class="mb-3">
                <label for="student_id" class="form-label">Student Id</label>
                <input type="text" class="form-control" id="student_id" name="student_id" required>
            </div>
            <button type="submit" class="btn btn-primary">Mark Attendance</button>
        </form>
        <br>
        <div>
            <video id="video" width="300" height="200" style="border: 1px solid black"></video>
            <br>
            <button id="startButton" class="btn btn-primary">Start</button>
        </div>
    </div>

    <script src="{{ asset('js/index.min.js') }}"></script>
    <script>
        window.addEventListener('load', function () {
            let selectedDeviceId;
            const codeReader = new ZXing.BrowserQRCodeReader();

            console.log('ZXing code reader initialized');

            document.getElementById('startButton').addEventListener('click', () => {
                codeReader.getVideoInputDevices()
                    .then((videoInputDevices) => {
                        selectedDeviceId = videoInputDevices[0].deviceId;
                        codeReader.decodeFromVideoDevice(selectedDeviceId, 'video', (result, err) => {
                            if (result) {
                                document.getElementById('student_id').value = result.text;
                                console.log(result);
                            }
                            if (err && !(err instanceof ZXing.NotFoundException)) {
                                console.error(err);
                            }
                        });
                        console.log(`Started continuous decode from camera with id ${selectedDeviceId}`);
                    })
                    .catch((err) => {
                        console.error(err);
                    });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
