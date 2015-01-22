PREFIX = /usr
PHP = /bin/env php


all:
	rm -f bin/phpcodec.phar
	$(PHP) build
	@echo
	@echo "-----------------------------------------"
	@echo Build Complete
	@echo "-----------------------------------------"

install:
	mkdir -p $(PREFIX)/bin
	install -c -m 755 bin/phpcodec.phar $(PREFIX)/bin/phpcodec
	@echo Installation complete
