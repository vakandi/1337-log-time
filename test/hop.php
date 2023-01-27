<html>
<head>
  <title>My Website</title>
  <style>
    /* Add your CSS styling here */
    /* exemple : */
    form {
            background-color: #f2f2f2;
            padding: 20px;
            border-radius: 10px;
            margin: 0 auto;
            width: 50%;
            text-align: center;
          }
          input[type=text] {
            width: 50%;
            padding: 12px 20px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 2px solid #ccc;
            border-radius: 4px;
          }
          input[type=button] {
            width: 25%;
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
          }
          input[type=button]:hover {
            background-color: #45a049;
          }
          #output {
            background-color: #f2f2f2;
            padding: 20px;
            border-radius: 10px;
            margin: 20px auto;
            width: 50%;
            text-align: center;
            display: none;
          }
          #loading {
            display: none;
          }
    
  </style>
</head>
<body>
  <form>
    <label for="login">Login:</label>
    <input type="text" id="login" name="login">
    <br>
    <br>
    <input type="button" value="Calculate" onclick="calculate()">
  </form>
  <div id="output"></div>
  <div id="loading">
    <img src="loading.gif" alt="Loading...">
  </div>

  <script>
    function calculate() {
      // Show the loading GIF
      document.getElementById("loading").style.display = "block";
      // Get the value of the input field
      var login = document.getElementById("login").value;
      // Send a request to the server to run the shell script
      var xhr = new XMLHttpRequest();
      xhr.open("GET", "script.php?login=" + login, true);
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
          // Hide the loading GIF
          document.getElementById("loading").style.display = "none";
          // Display the output of the script in a box
          document.getElementById("output").innerHTML = xhr.responseText;
          document.getElementById("output").style.display = "block";
        }
      };
      xhr.send();
    }
  </script>
</body>
</html>

