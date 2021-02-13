<?php

ini_set('max_execution_time', 0);

require 'app/connection.php';
require 'app/helper.php';

# RegExp
const REG_URL_IMG = '#src="((http|https)://([a-z0-9\.\-\?\/\_\,\=]+))"#smi';
const REG_URL_LINK = '#href="((http|https)://([a-z0-9\.\-\?\/\_\,\=]+))"#smi';

# Directories
const SAVE_DIRECTORY = 'D:/Google Drive/Documentos/Outros/X/Imagens/Crawler/';