
### [https://vakandi.github.io/1337-log-time/](https://vakandi.github.io/1337-log-time/)<br>[170.187.190.44](http://170.180.190.44) <br>
ngrok temp url> https://a0f2-2a01-7e01-00-f03c-93ff-fefd-788e.eu.ngrok.io
- Code > full.php
=======
## Using the terminal to get logtime : 
### ruby script/get_logtime.rb "login"
[![Build status](https://img.shields.io/github/languages/top/vakandi/1337-log-time?color=green&label=shell&logo=github)](https://github.com/vakandi/1337-log-ime/pulls)
## Dependencies :
### To run on iMac in the cluster's, you'll need to install brew with https://github.com/kube/42homebrew
### then : 
- brew install chruby ruby-install
- ruby-install ruby
- gem install bundler
- gem install oauth2
### For Linux, only use:
- apt install ruby bc
- gem install bundler
- gem install oauth2
### For MacOS:
- Install HomeBrew : ```bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"```
- (For the cluster, install 42 homebrew https://github.com/kube/42homebrew)
- rbenv install 3.1.2
- rbenv global 3.1.2
- If the output of "ruby -v" is not 3.1.2, just do:
- cd ~/.rbenv/versions/3.1.2/bin
- ./ruby -v
- gem install bundler
- gem install oauth2
## Change "UID" & "SECRET" inside .rb file by your own 42 api keys
### The script is preconfigured to calculated every day since 28th of the previous month
### Compatible with Termux (android), MacOs, Linux and WSL (Linux Inside Windows)
