from flask import Flask, request, render_template
import requests
from datetime import datetime

app = Flask(__name__)

@app.route('/', methods=['GET', 'POST'])
def index():
    if request.method == 'POST':
        username = request.form['username']
        today = datetime.now()
        begin_date = (today - timedelta(days=28)).isoformat()
        end_date = today.isoformat()
        response = requests.get(f"https://api.intra.42.fr/v2/users/{username}/locations_stats?begin_at={begin_date}&end_at={end_date}")
        if response.status_code != 200:
            return "Error: Could not fetch data for the user"
        api_output_json = response.json()
        total_seconds = sum(api_output_json.values())
        total_hours = total_seconds/3600
        return render_template('index.html', output=f"Total hours: {total_hours:.2f} h")
    return '''
        <form method="post">
            <input type="text" name="username" placeholder="Enter 42 username">
            <input type="submit" value="Submit">
        </form>
    '''

if __name__ == '__main__':
    app.run(port=8080)

