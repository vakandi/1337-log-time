# Run : 
## ./scrap_logtime.sh "login"
[![Build status](https://img.shields.io/github/languages/top/vakandi/1337-log-time?color=green&label=shell&logo=github)](https://github.com/vakandi/1337-log-ime/pulls)
# Dependencies :
## To run on iMac in the cluster's, you'll need to install brew with https://github.com/kube/42homebrew
### then : 
- brew install chruby ruby-install
- ruby-install ruby
- gem install bundler
- gem install oauth2
### For Linux, only use:
- apt install ruby bc
- gem install bundler
- gem install oauth2
## Change "UID" & "SECRET" inside .rb file by your own 42 api keys
### The script is preconfigured to calculated every day since 28th november, i'll change the config each month
### Compatible with Termux (android), MacOs, Linux and WSL (Linux Inside Windows)
