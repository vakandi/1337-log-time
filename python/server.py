from flask import Flask, request, render_template
import requests
from datetime import date, timedelta

app = Flask(__name__)

@app.route('/', methods=['GET', 'POST'])
def get_user_hours():
    if request.method == 'POST':
        UID = "5f098420ac985c69454de207c0ed775aa09f12c7e1e2dc7d7070dd6ec27d49da" #public key here
        SECRET = "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" #SECRET KEY HERE
        username = request.form['username']
        d = date.today()
        begin_date = (d - timedelta(days=28)).strftime("%Y-%m-%d")
        end_date = d.strftime("%Y-%m-%d")
        response = requests.get(f"https://api.intra.42.fr/v2/users/{username}/locations_stats?begin_at={begin_date}&end_at={end_date}", headers={
            "Authorization": f"Bearer {UID}:{SECRET}"
        })
        api_output_json = response.json()
        daily_hours = {}
        for date, time_string in api_output_json.items():
            hours, minutes, seconds = map(int, time_string.split(':'))
            daily_hours[date] = hours + (minutes / 60.0) + (seconds / 3600.0)
        total_hours = sum(daily_hours.values())
        return render_template('index.html', output=f"Total hours: {total_hours.to_i} h")

    return '''
        <form method="post">
            <label>Username:</label>
            <input type="text" name="username"><br><br>
            <input type="submit" value="Submit">
        </form>
    '''

if __name__ == '__main__':
    app.run(debug=True, host='0.0.0.0', port=80)

