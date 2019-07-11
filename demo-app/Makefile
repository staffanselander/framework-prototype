# Project variables
PROJECT_NAME ?= demo-app
REPO_NAME ?= demo-app
ORG_NAME ?= selander

# Docker Compose Project Names
REL_PROJECT := $(PROJECT_NAME)$(BUILD_ID)
DEV_PROJECT := $(REL_PROJECT)-dev

# Commands
COMPOSE := docker-compose -p $(DEV_PROJECT) -f docker/dev/docker-compose.yml

.PHONY: build
build:
	${COMPOSE} build

.PHONY: server
server:
	${COMPOSE} build
	${COMPOSE} up
