<?php
use PHPCodec\PHPCodec;

PHPCodec::registerCodec('msgpack');
PHPCodec::registerCodec('ini');
PHPCodec::registerCodec('json');
PHPCodec::registerCodec('phpserialize');
PHPCodec::registerCodec('php');

//low priority
PHPCodec::registerCodec('lua');

//CSV Codec must be the last item
//PHPCodec::registerCodec('csv');
 