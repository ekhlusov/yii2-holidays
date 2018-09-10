#!/bin/sh

USER_UID=1000
PG_UID=999
ROOT_UID=0

sudo chown ${USER_UID}:${USER_UID} app -R
sudo chown ${USER_UID}:${USER_UID} '.git' -R
sudo chown ${ROOT_UID}:${ROOT_UID} 'runtime' -R
sudo chown ${PG_UID}:${PG_UID} 'runtime/pg/data' -R
sudo chown ${PG_UID}:${ROOT_UID} 'runtime/pg/data'
