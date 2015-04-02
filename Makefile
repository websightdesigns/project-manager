#------------------------------------------------------------------------------
# include platform make defs - so we can override them
#------------------------------------------------------------------------------

SHELL := /bin/bash

# If BUILD_NUMBER is not set, set it to 0
BUILD_NUMBER ?= 0

RESULTS_PHP_CODE_COVERAGE = docs/results/code-coverage
RESULTS_PHP_UNIT_TESTS    = docs/results/unit-tests

#PHP_UNIT_TEST_BOOTSTRAP = tests/util/bootstrap.php
#PHP_UNIT_TEST_DIR       = tests/phpunit

SYNTAX_CHECKS   :=
ifneq (,$(PHP_FILES))
SYNTAX_CHECKS   += php-syntax-check
endif

UNIT_TESTS      :=
ifneq (,$(PHP_UNIT_TESTS))
UNIT_TESTS      += php-unit-test
endif


#------------------------------------------------------------------------------
# Syntax Checking
#------------------------------------------------------------------------------
php-syntax-check:
	@$(PRE_PHP_SYNTAX_CHECK) \
		set -e ; \
		for FILE in $(shell find . -name '*.php' -o -name '*.inc' -o -name '*.shtml'); do \
			php -l $$FILE; \
		done \
	$(POST_PHP_SYNTAX_CHECK)

php-syntax-check-dev:
	@echo "Checking syntax for modified project files...";
	@if [ -d .git ]; then \
		for FILE in `git status | egrep '(modified|new file).*\.(php|inc|shtml)$$' | awk '{print $$NF}'`; do \
			php -l $$FILE; \
		done; \
	elif [ -d .svn ]; then \
		for FILE in `svn status | egrep '^(M|A)' | egrep '\.(php|inc|shtml)$$' | awk '{print $$NF}'`; do \
			php -l $$FILE; \
		done; \
	fi
	@echo "";

.PHONY: php-syntax-check php-syntax-check-dev

#------------------------------------------------------------------------------
# Unit Tests and Code Coverage
#------------------------------------------------------------------------------
php-unit-test-code-coverage: php-results-directories
	phpunit \
		--coverage-clover $(RESULTS_PHP_CODE_COVERAGE)/clover.xml \
		--coverage-html   $(RESULTS_PHP_CODE_COVERAGE) \
		--log-junit       $(RESULTS_PHP_UNIT_TESTS)/$(BUILD_DIR).xml \
		--bootstrap       $(PHP_UNIT_TEST_BOOTSTRAP) \
		-d memory_limit=1G \
		$(PHP_UNIT_TEST_DIR)

php-unit-test-dev:
	@ $(CURDIR)/app/Console/cake test app
	@ echo

# shortcut
phpunit: php-unit-test-dev

php-results-directories:
	mkdir -p $(RESULTS_PHP_CODE_COVERAGE)
	mkdir -p $(RESULTS_PHP_UNIT_TESTS)

.PHONY: php-unit-test php-unit-test-dev php-results-directories

#------------------------------------------------------------------------------
# default build
#------------------------------------------------------------------------------
all:: build-test-package

#------------------------------------------------------------------------------
# data import/export
#------------------------------------------------------------------------------
import: import-data clean

import-data:
	@bash make-scripts/import.sh

export:
	@bash make-scripts/export.sh

#------------------------------------------------------------------------------
# updates
#------------------------------------------------------------------------------
update-code:
	git pull

update-data:
	sh make-scripts/import.sh

restart:
	sudo apachectl graceful

update: update-code clean restart

update-all: update-code update-data clean restart

#------------------------------------------------------------------------------
# clean
#------------------------------------------------------------------------------
clean:
	@echo "Making clean cache"
	@echo "When prompted, enter your sudo password..."
	@sudo make-scripts/init.sh


#------------------------------------------------------------------------------
# documentation
#------------------------------------------------------------------------------
documentation: doxygen-phpdocs

docs: documentation

#------------------------------------------------------------------------------
# build-test-package
#------------------------------------------------------------------------------
build-test-package: $(SYNTAX_CHECKS)  $(UNIT_TESTS)

#------------------------------------------------------------------------------
# build-release-package
#------------------------------------------------------------------------------
build-release-package: $(SYNTAX_CHECKS)  $(UNIT_TESTS)

#------------------------------------------------------------------------------
# pre-commit build, quicker for devs
#   -- only run syntax checks on changed files in repo
#   -- don't build code coverage metrics for phpunit
#------------------------------------------------------------------------------
# @todo add php-unit-test-dev
pre-commit: php-syntax-check-dev php-unit-test-dev

#------------------------------------------------------------------------------
# Test Suite
#  -- mode=(default|develop)
#------------------------------------------------------------------------------
test:
	@bash app/Console/cake testSuite -c $(mode)

#------------------------------------------------------------------------------
# Make Configure file.
#  This will run the make config.
#------------------------------------------------------------------------------
configure:
	@bash app/Console/cake MakeConfig
