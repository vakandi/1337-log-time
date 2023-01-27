#!/bin/sh
echo "" > tmp/user_timelog.txt
echo "" > tmp/user_timelog.tmp
login=$1
var=1
if [ $# -eq 0 ]
then
        echo "Not enough arguments, usage : ./scrap_timelog.sh '<your login>'"
        exit
else
	ruby script/get_locations.rb $login > tmp/user_timelog.tmp
	str="$(cat tmp/user_timelog.tmp | tr " " "\n" | tr ">" "\n" |sed '/^$/d')"
	echo "${str#*StringKeyed}" > tmp/user_timelog.txt
	loops="$(cat tmp/user_timelog.txt | wc -l)"
	echo "Number of days you logged in since the \033[35;m28th "$(date -d"1 month ago" "+%B")"\033[0m : \033[42;m $(echo "$loops-1" | bc) \033[0m"
        echo "$(cat user_timelog.txt | sed '/^$/d')" > tmp/user_timelog.txt
	echo "\n Calculating all days together.."
	echo "$(cat user_timelog.txt | sed 's/^.*="//' | rev | cut -c12- | rev)" > tmp/list_hours.tmp
	#list="1:11 0:13 2:06 1:38 1:36 0:06 0:31 0:33 0:38 0:44"
	echo "\n\n"
	loops="$(cat tmp/list_hours.tmp | wc -l)"
	var2=1
	echo "" > tmp/minutes.tmp
	while [ $var2 -le $loops ]
	do
	        echo "$(cat tmp/list_hours.tmp | head -n$var2 | tail -n1 | sed 's/://g')" | awk '{print substr($0,1,2)*60+substr($0,3)}' >> tmp/minutes.tmp
		echo "Calculating day $var2.."
	        var2=$((var2+1))
	done
	echo "$(cat tmp/minutes.tmp | sed '1d')" > tmp/minutes.tmp
	echo "$(cat tmp/minutes.tmp | tr "\n" " " | tr " " "+" | sed 's/.$//')" > tmp/minutes.tmp
	echo "$(echo "$(cat tmp/minutes.tmp)" | bc)" > tmp/minutes.tmp
	minutes="$(cat tmp/minutes.tmp)"
	echo "\n"
	echo "$(printf '%dh:%dm\n' $((minutes/60)) $((minutes%60)))" > tmp/minutes.tmp
	echo "\033[35;m$(date +%B)current log time (by wbousfir):\n\033[0m\033[42;m  $(cat tmp/minutes.tmp)  \033[0m"
	echo "\033[35;mLast day with logtime:\n\033[0m\033[35;m  $(cat tmp/user_timelog.txt | tail -n 1 | rev | cut -c19- | rev) with this amount of hours: $(cat tmp/user_timelog.txt | tail -n1 | sed 's/^.*="//' | rev| cut -c12- | rev)  \033[0m"
fi
rm tmp/*
