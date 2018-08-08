up :
	@ docker-compose -f docker-compose.yml up --remove-orphans -d

start :
	@ docker-compose -f docker-compose.yml start

stop :
	@ docker-compose -f docker-compose.yml stop

restart :
	@ docker-compose -f docker-compose.yml stop && docker-compose -f docker-compose.yml start

down :
	@ docker-compose -f docker-compose.yml down
