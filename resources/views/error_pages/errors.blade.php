<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found</title>
    <!-- You can include your CSS stylesheets here -->
    <style>
        /* Example styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            text-align: center;
        }

        h1 {
            font-size: 48px;
            margin-bottom: 20px;
        }

        p {
            font-size: 20px;
            margin-bottom: 40px;
        }

        a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <!-- Use the asset() helper function to generate the correct URL for the audio file -->
    <audio id="alert-sound" preload="auto">
        <source src="{{ asset('errorsound/error-page-unacces.mp3') }}" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>

    <div class="container">
        <h1>404 - Page Not Found</h1>
        <lord-icon
            src="https://cdn.lordicon.com/jxzkkoed.json"
            trigger="loop"
            style="width:250px;height:250px">
        </lord-icon>
        <p>Oops! The page you are looking for does not exist.</p>
        <p><a href="{{ url('/') }}">Go back to the homepage</a></p>
    </div>
    <script src="https://cdn.lordicon.com/lordicon.js"></script>
    <script>
        // Play the error sound in response to a user action (e.g., page load or button click)
        window.onload = function() {
            var audio = document.getElementById('alert-sound');
            // Check if the audio element is supported and the file is loaded
            if(audio && audio.readyState >= 2) {
                audio.play(); // Start playback
            }
        };
    </script>
</body>
</html>
