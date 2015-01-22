PREFIX = /usr

install:
	mkdir -p $(PREFIX)/bin
	install -c -m 755 bin/phpcodec.phar $(PREFIX)/bin/phpcodec
	@echo Installation complete
