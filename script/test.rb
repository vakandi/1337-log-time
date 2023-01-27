require "oauth2"
UID= "5f098420ac985c69454de207c0ed775aa09f12c7e1e2dc7d7070dd6ec27d49da" #public key here
SECRET= "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" #SECRET KEY HERE
client = OAuth2::Client.new(UID, SECRET, site: "https://api.intra.42.fr")
token = client.client_credentials.get_token
require 'date'
d = Date.today
response = token.get("/v2/users/" + ARGV[0] + "/locations_stats?begin_at=" + d.prev_month.strftime("%Y-%m") +"-28")
#The date is updating automatically every month, from 28th of the previous month to 28th on the current one accordly to the Scholarship
response.status

api_output_json = response.parsed

daily_hours = {}

api_output_json.each do |date, time_string|
    # Parse the time string into hours, minutes, and seconds
    hours, minutes, seconds = time_string.split(':').map(&:to_i)
    # Add the total number of hours for the day to the `daily_hours` hash
    daily_hours[date] = hours + (minutes / 60.0) + (seconds / 3600.0)
end

# Print out the results
daily_hours.each do |date, hours|
    puts "#{date}: #{hours} hours"
end

