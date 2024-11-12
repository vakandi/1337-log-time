require "oauth2"
UID= "5f098420ac985c69454de207c0ed775aa09f12c7e1e2dc7d7070dd6ec27d49da"

SECRET= "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"
client = OAuth2::Client.new(UID, SECRET, site: "https://api.intra.42.fr")
token = client.client_credentials.get_token
require 'date'
d = Date.today
#response = token.get("/v2/users/" + ARGV[0] + "/locations_stats?begin_at=" + d.prev_month.strftime("%Y-%m") +"-28")
# perform the rrquest but by fixing the error : `+': no implicit conversion of nil into String (TypeError) 
if ARGV[0] == nil
    puts "Please enter a login"
    exit
end
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
puts "\033[1;42m" + "  Total :[ #{total_hours.to_i} h ] " + "\033[0m"
puts "\033[1;32m" + "Average hours per day: #{(total_hours.to_i / daily_hours.length).to_i} h" + "\033[0m"





# ASCII art digits
DIGITS = {
  "0" => [
    "    ████████    ",
    "  ██        ██  ",
    "██            ██",
    "██            ██",
    "██            ██",
    "██            ██",
    "██            ██",
    "██            ██",
    "██            ██",
    "  ██        ██  ",
    "    ████████    "
  ],
  "1" => [
    "      ████      ",
    "    ██████      ",
    "      ████      ",
    "      ████      ",
    "      ████      ",
    "      ████      ",
    "      ████      ",
    "      ████      ",
    "      ████      ",
    "      ████      ",
    "  ████████████  "
  ],
  "2" => [
    "    ████████    ",
    "  ██        ██  ",
    "██            ██",
    "              ██",
    "          ████  ",
    "      ████      ",
    "  ████          ",
    "██              ",
    "██              ",
    "██            ██",
    "  ██████████████"
  ],
  "3" => [
    "    ████████    ",
    "  ██        ██  ",
    "██            ██",
    "              ██",
    "        ████████",
    "              ██",
    "              ██",
    "              ██",
    "██            ██",
    "  ██        ██  ",
    "    ████████    "
  ],
  "4" => [
    "██            ██",
    "██            ██",
    "██            ██",
    "██            ██",
    "██            ██",
    "  ██████████████",
    "              ██",
    "              ██",
    "              ██",
    "              ██",
    "              ██"
  ],
  "5" => [
    "██████████████  ",
    "██              ",
    "██              ",
    "██              ",
    "  ████████████  ",
    "              ██",
    "              ██",
    "              ██",
    "██            ██",
    "  ██        ██  ",
    "    ████████    "
  ],
  "6" => [
    "    ████████    ",
    "  ██        ██  ",
    "██              ",
    "██              ",
    "██  ████████    ",
    "████        ██  ",
    "██            ██",
    "██            ██",
    "██            ██",
    "  ██        ██  ",
    "    ████████    "
  ],
  "7" => [
    "██████████████  ",
    "              ██",
    "            ██  ",
    "          ██    ",
    "        ██      ",
    "      ██        ",
    "    ██          ",
    "  ██            ",
    "██              ",
    "██              ",
    "██              "
  ],
  "8" => [
    "    ████████    ",
    "  ██        ██  ",
    "██            ██",
    "██            ██",
    "  ██        ██  ",
    "    ████████    ",
    "  ██        ██  ",
    "██            ██",
    "██            ██",
    "  ██        ██  ",
    "    ████████    "
  ],
  "9" => [
    "    ████████    ",
    "  ██        ██  ",
    "██            ██",
    "██            ██",
    "██            ██",
    "  ██        ████",
    "    ████████  ██",
    "              ██",
    "              ██",
    "  ██        ██  ",
    "    ████████    "
  ]
}

def number_to_ascii(number)
  digits = number.to_s.chars
  height = DIGITS.first[1].length

  # Create array to hold each line of output
  result = Array.new(height) { "" }

  # Build each line of the ASCII art
  digits.each do |digit|
    DIGITS[digit].each_with_index do |line, i|
      result[i] += line + "  "
    end
  end

  result.join("\n")
end

# Modified output lines using ASCII art
puts "\033[1;32m"
puts "Total hours:"
#print 'h' next to the number and not below it, so on the same line
#puts number_to_ascii(total_hours.to_i)
puts number_to_ascii(total_hours.to_i) + "H"
puts "\033[0m"

puts "\033[1;32m"
puts "Average hours per day:"
puts number_to_ascii((total_hours.to_i / daily_hours.length).to_i) + "H"
puts "\033[0m"
