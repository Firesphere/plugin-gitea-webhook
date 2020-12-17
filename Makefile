plugin=GiteaWebhook
version=1.1.2
all:
	@ echo "Build archive for plugin ${plugin} version=${version}"
	@ git archive HEAD --prefix=${plugin}/ --format=zip -o ${plugin}-${version}.zip
