require "oauth2"
UID= "xxx"
SECRET= "s-xxxx" #SECRET KEY HERE
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
puts "\n\n\n\n\n\n\n\n              \033[1;42m" + "  Total :[ #{total_hours.to_i} h ] " + "\033[0m"
puts "\n            \033[1;32m" + "Average hours: #{(total_hours.to_i / daily_hours.length).to_i} h" + "\033[0m"
sleep 6
