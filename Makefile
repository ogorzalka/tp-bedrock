SELF_DIR := $(dir $(lastword $(MAKEFILE_LIST)))
include $(SELF_DIR)/.project-basics/Makefile.mk
include $(SELF_DIR)/.env

DC=docker-compose -pbee-bedrock -f .project-basics/docker/docker-compose.yml -f .project-basics/docker/docker-compose-traefik.yml