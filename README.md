# phpcodec
PHP Command line encoding &amp; decoding tool


## Installation

make install


## Uses

### Help information
  Type command <code>phpcodec -h</code>
  
### List supported codecs
  Type command <code>phpcodec -l</code>
  
## Examples

   - Convert ini content to PHP var_export
   
   <code>cat a.ini | phpcodec</code>
   
   - Convert PHP Serialize data to json
   
   <code>cat data.phpserialize.txt | phpcodec -t json</code>
   
   - Convert msgpack binary data to PHP var_export
   
   <code>cat data.msgpack.txt | phpcodec</code>
   
   - Convert msgpack binary data to json
   
   <code>cat data.msgpack.txt | phpcodec -t json</code>

   - Convert msgpack binary data to PHP serialize
   
   <code>cat data.msgpack.txt | phpcodec -t phpserialize</code>
   
   - Convert PHP var_export data to json
   
   <code>cat data.var_export.txt | phpcodec -t json</code>
   
   - Convert PHP var_export data to MessagePack
   
   <code>cat data.var_export.txt | phpcodec -t msgpack</code>
   
   - Convert PHP var_export data to PHP serialize
   
   <code>cat data.var_export.txt | phpcodec -t phpserialize</code>
   
   - Convert json string to MessagePack
   
   <code>cat data.json.txt | phpcodec -t msgpack</code>
   
   - Convert json string to PHP serialize 
   
   <code>cat data.json.txt | phpcodec -t phpserialize</code>
   
   - Convert PHP var_export data to MessagePack
   
   <code>cat data.var_export.txt | phpcodec -t msgpack</code>
   
   - Convert PHP var_export data to json
   
   <code>cat data.var_export.txt | phpcodec -t json</code>
   
   - Convert PHP var_export data to PHP serialize
   
   <code>cat data.var_export.txt | phpcodec -t phpserialize</code>
   
   - Convert json string data to PHP serialize
   
   <code>cat data.json.txt | phpcodec -t phpserialize</code>
   
   - Convert ini data to PHP serialize
   
   <code>cat dat.ini | phpcodec -t phpserialize</code>
   
   - Convert ini data to json
   
   <code>cat data.ini | phpcodec -t json</code>
   
   - Convert ini data to phpserialize
   
   <code>cat data.ini | phpcodec -t phpserialize</code>
   
   - Conver ini data to msgpack
   
   <code>cat data.ini | phpcodec -t msgpack</code>
  
  ## Licese
   MIT
  
  
  
  
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
