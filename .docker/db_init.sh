#!/bin/bash

# Create dev database
psql -a -e -U postgres -c "CREATE DATABASE ${PSQL_DATABASE};"

# Create and grant permission on dev database for dev user
psql -a -e -U postgres -c "CREATE USER ${PSQL_USERNAME} WITH SUPERUSER CREATEDB ENCRYPTED PASSWORD '${PSQL_PASSWORD}';"
psql -a -e -U postgres -c "GRANT ALL PRIVILEGES ON DATABASE ${PSQL_DATABASE} TO ${PSQL_USERNAME};"