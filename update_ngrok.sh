#!/bin/sh
var=1
while true
do
	old_url="$(curl -s localhost:4040/api/tunnels | jq -r .tunnels\[0\].public_url)"
	sleep 2s
	if [ -z $old_url ]; then
		pkill ngrok
		sleep 5s
		nohup ngrok http 80 &
		sleep 4s
		new_url="$(curl -s localhost:4040/api/tunnels | jq -r .tunnels\[0\].public_url)"
		echo "$(cat index.html | sed "s|\(url=\).*\(\"\)|\1$new_url\2|")" > index.html
		echo "$(cat README.md | sed "s|\(url=\).*\(\>\)|\1$new_url\2|")" > README.md
		git add index.html README.md
		git commit -m "ngrok_newlink"
		git push origin main
	fi
	systemctl restart apache2
	sleep 60s
	var=$((var+1))
done
