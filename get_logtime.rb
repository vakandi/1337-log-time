require "oauth2"
UID= "5f098420ac985c69454de207c0ed775aa09f12c7e1e2dc7d7070dd6ec27d49da"
SECRET= "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" #SECRET KEY HERE
client = OAuth2::Client.new(UID, SECRET, site: "https://api.intra.42.fr")
token = client.client_credentials.get_token
require 'date'
d = Date.today
response = token.get("/v2/users/" + ARGV[0] + "/locations_stats?begin_at=" + d.prev_month.strftime("%Y-%m") +"-28")
#The date is updating automatically every month, from 28th of the previous month to 28th on the current one accordly to the Scholarship
response.status

response.parsed
#puts response.inspect

require 'json'

# Assuming the API output is stored in a variable called `api_output`
api_output_json = JSON.parse(response.body)

daily_hours = {}

api_output_json.each do |date, time_string|
    # Parse the time string into hours, minutes, and seconds
    hours, minutes, seconds = time_string.split(':').map(&:to_i)
    # Add the total number of hours for the day to the `daily_hours` hash
    daily_hours[date] = hours + (minutes / 60.0) + (seconds / 3600.0)
end

# Print out the results
total_hours = 0
daily_hours.each do |date, hours|
    total_hours += hours
    minutes = (hours - hours.to_i) * 60
   # puts "#{date}: #{hours.to_i} hours and #{minutes.to_i} minutes"
end
puts "Total hours: #{total_hours.to_i} h"

