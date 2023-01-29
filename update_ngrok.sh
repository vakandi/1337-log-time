#!/bin/sh
	old_url="$(curl -s localhost:4040/api/tunnels | jq -r .tunnels\[0\].public_url)"
	sleep 2s
	if [ -z $old_url ]; then
		pkill ngrok
		sleep 5s
		nohup ngrok http 80 &
		sleep 4s
		new_url="$(curl -s localhost:4040/api/tunnels | jq -r .tunnels\[0\].public_url)"
		old_link_index="$(grep -o 'url=.*"' index.html | cut -c5- | sed 's/"//g')"
		old_link_readme="$(grep -o 'url> .*' README.md | cut -c6-)"
		perl -i -pe "s|$old_link_readme|$new_url|g" README.md
		perl -i -pe "s|$old_link_index|$new_url|g" index.html
		git add index.html README.md
		git commit -m "ngrok_newlink"
		git push origin main
	fi
	systemctl restart apache2
