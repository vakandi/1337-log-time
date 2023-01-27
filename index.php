<!DOCTYPE html>
<html>
  <head>
    <title>Log Time Scraper</title>
    <script>
      function calculate() {
        var login = document.getElementById("login").value;
        document.getElementById("output").innerHTML = "Calculating...";
        document.getElementById("loading").innerHTML = "<img src='loading.gif' alt='Loading...'/>";
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("output").innerHTML = this.responseText;
            document.getElementById("loading").innerHTML = "";
          }
        };
        xhttp.open("GET", "script/test.sh " + login, true);
        xhttp.send();
      }
    </script>
  </head>
  <body>
    <h1>Log Time Scraper</h1>
    <label for="login">Login:</label>
    <input type="text" id="login">
    <button onclick="calculate()">Calculate</button>
    <div id="loading"></div>
    <br>
    <div id="output"></div>
  </body>
</html>

