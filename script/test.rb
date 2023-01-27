require 'json'
require 'time'

response_body = "{\"202194\",\"202"

response_hash = JSON.parse(response_body)

response_hash.each do |date, time|
  time_in_seconds = Time.parse(time).seconds_since_midnight
  hours = time_in_seconds / 3600
  puts "#{date}: #{hours} hours"
end

