#!/bin/sh
# install command by (source root directory)/tool/install.sh
SCRIPT_DIR=$(cd $(dirname $0);pwd);
php $SCRIPT_DIR/../src/init/ctrl.php $*;
