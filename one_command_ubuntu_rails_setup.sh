#!/bin/bash
echo "Updating system.."
sudo apt-get update
echo "Installing curl.."
sudo apt-get install 
echo "Installing RVM.."
\curl -L https://get.rvm.io | bash -s stable
echo "Loading RVM.."
source ~/.rvm/scripts/rvm
echo "Installing RVM dependancies.."
rvm requirements
echo "Installing latest ruby.."
rvm install ruby
echo "Setting default ruby in rvm"
rvm use ruby --default
echo "Installing RubyGems.."
rvm rubygems current
echo "Installing Rails.."
gem install rails
echo "Your rails version"
rails -v
echo "Succefully done with rails installation Happy Coding:)"
