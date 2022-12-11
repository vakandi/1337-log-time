require "oauth2"
UID= "u-XXXXXXXXXX" #public key here
SECRET= "s-xxxxxxxxxxxx" #SECRET KEY HERE
client = OAuth2::Client.new(UID, SECRET, site: "https://api.intra.42.fr")
token = client.client_credentials.get_token
require 'date'
d = Date.today
response = token.get("/v2/users/" + ARGV[0] + "/locations_stats?begin_at=" + d.prev_month.strftime("%Y-%m") +"-28")
#The date is updating automatically every month, from 28th of the previous month to 28th on the current one accordly to the Scholarship
response.status

response.parsed
puts response.inspect
