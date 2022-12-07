#!/bin/sh
echo "" > user_timelog.txt
echo "" > user_timelog.tmp
login=$1
var=1
if [ $# -eq 0 ]
then
        echo "Not enough arguments, usage : ./scrap_timelog.sh '<your login>'"
        exit
else
	ruby get_locations.rb $login > user_timelog.tmp
	str="$(cat user_timelog.tmp | tr " " "\n" | tr ">" "\n" |sed '/^$/d')"
	echo "${str#*StringKeyed}" > user_timelog.txt
	loops="$(cat user_timelog.txt | wc -l)"
	echo "Number of days you logged in since the 28th November : $(echo "$loops-1" | bc)"
	echo "$(cat user_timelog.txt | sed '/^$/d')" > user_timelog.txt
	echo "\n Calculating all days together.."
	echo "$(cat user_timelog.txt | sed 's/^.*="//' | rev | cut -c12- | rev)" > list_hours.tmp
	#list="1:11 0:13 2:06 1:38 1:36 0:06 0:31 0:33 0:38 0:44"
	echo "\n\n"
	loops="$(cat list_hours.tmp | wc -l)"
	var2=1
	echo "" > minutes.tmp
	while [ $var2 -le $loops ]
	do
	        echo "$(cat list_hours.tmp | head -n$var2 | tail -n1 | sed 's/://g')" | awk '{print substr($0,1,2)*60+substr($0,3)}' >> minutes.tmp
		echo "Calculating day $var2.."
	        var2=$((var2+1))
	done
	echo "$(cat minutes.tmp | sed '1d')" > minutes.tmp
	echo "$(cat minutes.tmp | tr "\n" " " | tr " " "+" | sed 's/.$//')" > minutes.tmp
	echo "$(echo "$(cat minutes.tmp)" | bc)" > minutes.tmp
	minutes="$(cat minutes.tmp)"
	echo "\n"
	echo "$(printf '%dh:%dm\n' $((minutes%3600/60)) $((minutes%60)))" > minutes.tmp
	echo "\033[35;mDecember current log time (by wbousfir):\n\033[0m\033[42;m  $(cat minutes.tmp)  \033[0m"
fi
rm user_timelog.tmp
rm user_timelog.txt
rm list_hours.tmp
rm minutes.tmp
