<!DOCTYPE html>
<html>
<head>
    <title>Punch Attendance</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h2>Punch Attendance</h2>
    
    <video id="video" width="320" height="240" autoplay></video><br>
    <button onclick="capture()">Capture Selfie & Punch</button>
    <canvas id="canvas" style="display:none;"></canvas>

    <form id="punchForm" method="POST" action="{{ route('attendance.punch') }}">
        @csrf
        <input type="hidden" name="image" id="image">
        <input type="hidden" name="latitude" id="latitude">
        <input type="hidden" name="longitude" id="longitude">
    </form>

    <script>
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(stream => { document.getElementById('video').srcObject = stream; });

        navigator.geolocation.getCurrentPosition(position => {
            document.getElementById('latitude').value = position.coords.latitude;
            document.getElementById('longitude').value = position.coords.longitude;
        });

        function capture() {
            const canvas = document.getElementById('canvas');
            const video = document.getElementById('video');
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            canvas.getContext('2d').drawImage(video, 0, 0);
            const dataURL = canvas.toDataURL('image/png');
            document.getElementById('image').value = dataURL;
            document.getElementById('punchForm').submit();
        }
    </script>
</body>
</html>
