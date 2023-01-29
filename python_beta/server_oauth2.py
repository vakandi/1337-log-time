from flask import Flask, request, render_template
from datetime import date, timedelta
import json
from oauth2.oauth2 import OAuth2

app = Flask(__name__)

UID= "5f098420ac985c69454de207c0ed775aa09f12c7e1e2dc7d7070dd6ec27d49da" 
SECRET= "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" 
client = OAuth2(UID, SECRET, site="https://api.intra.42.fr")
token = client.client_credentials.get_token()

@app.route('/', methods=['GET', 'POST'])
def get_user_hours():
    if request.method == 'POST':
        username = request.form['username']
        d = date.today()
        response = token.get(f"/v2/users/{username}/locations_stats?begin_at={d.prev_month.strftime('%Y-%m')}-28")

        api_output_json = json.loads(response.body)
        daily_hours = {}

        for date, time_string in api_output_json.items():
            hours, minutes, seconds = map(int, time_string.split(':'))
            daily_hours[date] = hours + (minutes / 60.0) + (seconds / 3600.0)

        total_hours = 0
        for date, hours in daily_hours.items():
            total_hours += hours
            minutes = (hours - int(hours)) * 60
            print(f"{date}: {int(hours)} hours and {int(minutes)} minutes")

        print("Total hours: ", total_hours, "h")
        return render_template("index.html", total_hours=total_hours)
    return render_template("index.html")

if __name__ == '__main__':
    app.run(debug=True, host='0.0.0.0', port=80)

