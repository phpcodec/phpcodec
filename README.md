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
   
   - Conver ini data to msgpack
   
   <code>cat data.ini | phpcodec -t msgpack</code>

   - Read data from file using paramete f
   
   <code>phpcodec -f data.ini</code>

   - Write result to specified file
   
   <code>cat data.ini | phpcodec -t msgpack -O result.msgpack.txt</code>
   <code>cat data.ini | phpcodec -t msgpack > result.msgpack.txt</code>
   
   - Pretty print JSON string
   
   <code> cat data.ini | phpcodec -t json[pretty]</code>
  
  ## Licese
   MIT
  
  
  
  
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
