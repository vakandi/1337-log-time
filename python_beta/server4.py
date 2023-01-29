import http.server
import socketserver
import requests
from datetime import datetime, timedelta

# Add your UID and SECRET here
UID = "5f098420ac985c69454de207c0ed775aa09f12c7e1e2dc7d7070dd6ec27d49da"
SECRET = "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"

class MyHandler(http.server.BaseHTTPRequestHandler):
    def do_GET(self):
        self.send_response(200)
        self.send_header('Content-type', 'text/html')
        self.end_headers()
        self.wfile.write(b'<form method="post">')
        self.wfile.write(b'<input type="text" name="username" placeholder="Enter 42 username">')
        self.wfile.write(b'<input type="submit" value="Submit">')
        self.wfile.write(b'</form>')

    def do_POST(self):
        content_length = int(self.headers['Content-Length'])
        post_data = self.rfile.read(content_length).decode()
        post_data = post_data.split("=")[1]
        today = datetime.now()
        begin_date = (today - timedelta(days=28)).isoformat()
        end_date = today.isoformat()
        # Add the UID and SECRET to the headers
        headers = {'Authorization': f'Bearer {UID} {SECRET}'}
        response = requests.get(f"https://api.intra.42.fr/v2/users/{post_data}/locations_stats?begin_at={begin_date}&end_at={end_date}", headers=headers)
        if response.status_code != 200:
            self.send_response(404)
            self.send_header('Content-type', 'text/html')
            self.end_headers()
            self.wfile.write(b"Error: Could not fetch data for the user")
        else:
            api_output_json = response.json()
            total_seconds = sum(api_output_json.values())
            total_hours = total_seconds/3600
            self.send_response(200)
            self.send_header('Content-type', 'text/html')
            self.end_headers()
            self.wfile.write(b"Total hours: " + str(total_hours).encode() + b" h")

if __name__ == '__main__':
    with socketserver.TCPServer(("", 8080), MyHandler) as httpd:
        httpd.serve_forever()

