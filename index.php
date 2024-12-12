<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>main Page</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
    }
    .navbar {
      display: flex;
      justify-content: space-around;
      align-items: center;
      background-color: #333;
      padding: 10px;
    }
    .navbar a {
      color: white;
      text-decoration: none;
      padding: 10px 20px;
      transition: background 0.3s;
    }
    .navbar a:hover {
      background-color: #575757;
      border-radius: 5px;
    }
    iframe {
      width: 100%;
      height: calc(100vh - 50px); 
      border: none;
    }
  </style>
</head>
<body>

  <div class="navbar">
    <a href="#" onclick="changeIframe('views/admin.php')">AdminDashBoard</a>
    <a href="#" onclick="changeIframe('views/reservePage.php')">Reserve Page</a>
    <a href="#" onclick="changeIframe('views/activities.php')">Activity Page</a>
  </div>

  
  <iframe id="contentFrame" src="views/reservePage.php"></iframe>

  <script>
    
    function changeIframe(page) {
      document.getElementById('contentFrame').src = page;
    }
  </script>
</body>
</html>
