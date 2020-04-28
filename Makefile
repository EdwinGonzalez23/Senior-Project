all:

pull:
	git pull

push: pull
	git add .
	git commit -m "Auto Commit"
	git push origin master
