#!/bin/bash
# #########################################
# Program: ParsVT MySQL Tuner
# Developer: Hamid Rabiei, Mohammad Hadadpour
# Release: 1401-07-01
# Update: 1403-06-20
# #########################################
set -e
Color_Off="\e[0m"
Red="\e[0;31m"
Green="\e[0;32m"
Yellow="\e[0;33m"
Blue="\e[0;34m"
Purple="\e[0;35m"
Cyan="\e[0;36m"
output() {
	echo -e "$1"
}
echo -e "\n${Yellow} ___            __   _______               "
echo -e "| _ \__ _ _ _ __\ \ / /_   _|__ ___ _ __   "
echo -e "|  _/ _\` | '_(_-<\ V /  | |_/ _/ _ \ '  \ "
echo -e "|_| \__,_|_| /__/ \_/   |_(_)__\___/_|_|_| \n"
echo -e "Shell script to run ParsVT MySQLTuner on Linux."
echo -e "MySQLTuner is a script written in Perl that allows you to review a MySQL installation quickly and make adjustments to increase performance and stability."
echo -e "Please run as root. if you are not, enter 'n' now and enter 'sudo su' before running the script."
echo -e "Run the script? (y/n): ${Color_Off}"
read -e run
if [ "$run" == n ]; then
	output "\n${Red}The operation aborted!${Color_Off}"
	output "${Yellow}www.parsvt.com${Color_Off}\n"
	exit
else
	BASEDIR=$(dirname "$0")
	cd "$BASEDIR"
	file="mysqltuner.pl"
	if [ ! -f "$file" ]; then
		wget http://license.aweb.co/download/mysqltuner.pl -O mysqltuner.pl
	fi
	chmod +x mysqltuner.pl
	OS=$(php -r "echo substr(PHP_OS, 0, 3);")
	if [ "$OS" == "WIN" ]; then
		CRMPATH=$(php -r "echo substr(getcwd(), 0, 2);")
		echo $CRMPATH
		cd $BASEDIR
	fi
	OSNAME=$(php -r "echo PHP_OS;")
	PHPVERSION=$(php -v)
	output "\nOperating system: ${Green}${OSNAME}${Color_Off}\n"
	output "PHP version: ${Green}${PHPVERSION}${Color_Off}"
	DBUSERNAME=$(php -r "require '../../../../config.inc.php'; echo \$dbconfig['db_username'];")
	DBPASSWORD=$(php -r "require '../../../../config.inc.php'; echo \$dbconfig['db_password'];")
	DBHOST=$(php -r "require '../../../../config.inc.php'; echo \$dbconfig['db_server'];")
	MYSQLTUNERLOG=$(php -r "require '../../../../config.inc.php'; echo \$root_directory.'logs/mysqltuner.log';")
	echo $ROOTDIRECTORY
	chmod +x mysqltuner.pl
	perl "$BASEDIR"/mysqltuner.pl --host $DBHOST --user $DBUSERNAME --pass $DBPASSWORD --color --nogood --noinfo --buffers --pfstat --debug --outputfile $MYSQLTUNERLOG
	output "\nPlease check the log file in the following path: ${Green}${MYSQLTUNERLOG}${Color_Off}\n"
	output "Notice: ${Yellow}MySQLTuner is a read only script. It won't write to any configuration files, change the status of any daemons. It will give you an overview of your server's performance and make some basic recommendations for improvements that you can make after it completes.${Color_Off}\n"
fi
