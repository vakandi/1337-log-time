from flask import Flask, request, render_template
import requests
from datetime import date, timedelta

app = Flask(__name__)

@app.route('/', methods=['GET', 'POST'])
def index():
    if request.method == 'POST':
        username = request.form['username']
        today = date.today()
        begin_date = (today - timedelta(days=28)).strftime("%Y-%m-%d")
        end_date = today.strftime("%Y-%m-%d")
        response = requests.get(f"https://api.intra.42.fr/v2/users/{username}/locations_stats?begin_at={begin_date}&end_at={end_date}")
        if response.status_code != 200:
            return "Error: Could not fetch data for the user"
        api_output_json = response.json()
        daily_hours = {}
        for date, time_string in api_output_json.items():
            hours, minutes, seconds = time_string.split(':')
            daily_hours[date] = int(hours) + int(minutes) / 60 + int(seconds) / 3600
        total_hours = sum(daily_hours.values())
        return render_template('index.html', output=f"Total hours: {total_hours:.2f} h")
    return '''
        <form method="post">
            <input type="text" name="username" placeholder="Enter 42 username">
            <input type="submit" value="Submit">
        </form>
    '''

if __name__ == '__main__':
    app.run(debug=True, port=80)

