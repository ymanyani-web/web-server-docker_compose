cd docker-compose-lamp/
git fetch --all
git checkout 7.4.x
cp sample.env .env
docker-compose up -d
