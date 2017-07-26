#自动运维脚本 每天晚上0点0分0秒 执行所有备份
#crontab -e -u apache
#0 0 * * * sh /haimaike/web/dev/backup/script/auto.sh 

#日期
date=`date '+%Y-%m-%d'`
#目录
dir="/haimaike/web/dev/backup/"
datadir="${dir}data/"
filedir="${dir}file/"
logdir="${dir}log/"

#导出数据库
filename="${date}-data.sql"
host="localhost"
user="haimaike_dev"
pwd="mydivine"
db="haimaike_dev"
#导入sql文件到指定数据库  
mysqldump -u${user} -p${pwd} ${db} > ${datadir}${filename}

#打包文件系统
filename="${date}-file.zip"
targetdir="/haimaike/web/dev/upload"
zip -r ${filedir}${filename} ${targetdir}

#打包LOG
filename="${date}-log.zip"
targetdir="/haimaike/web/dev/log"
zip -r ${logdir}${filename} ${targetdir}

