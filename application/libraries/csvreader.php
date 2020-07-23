<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class CSVReader {

    var $fields;            /** columns names retrieved after parsing */ 
    var $separator = '|<br>]';    /** separator used to explode each line */
    var $enclosure = '"';    /** enclosure used to decorate each field */

//    var $max_row_size = 4096;    /** maximum row size to be used for decoding */
    var $max_row_size = 0; 
    
    function parse_file($p_Filepath) {
        
        $error = [];

        $file = fopen($p_Filepath, 'r') or die("Couldn't get handle");
        $this->fields = fgetcsv($file, $this->max_row_size, $this->separator, $this->enclosure);
        $keys_values = explode(';',$this->fields[0]);

        $content    =   array();
        $keys   =   $this->escape_string($keys_values);
        
//        if (fgetcsv($file, $this->max_row_size, $this->separator, $this->enclosure) == false)
//            array_push($error, 'Terjadi kesalahan pada saat parsing data, pastikan format data yang di unggah sudah benar.');
        
        $i  =   1;
        while( ($row = fgetcsv($file, $this->max_row_size, $this->separator, $this->enclosure)) != false ) {
           
            if( $row != null ) { // skip empty lines
                $values =   explode(';',$row[0]);
                if(count($keys) == count($values)){
                    $arr    =   array();
                    $new_values =   array();
                    $new_values =   $this->escape_string($values);
                    for($j=0;$j<count($keys);$j++){
                        if($keys[$j] != ""){
                            $arr[$keys[$j]] =   $new_values[$j];
                        } 
                    }

                    $content[$i]=   $arr;
                    
                } else {
                    array_push($error, 'Row ke ' . ($i) . ' error. Perbaiki data terlebih dahulu <br>');
                }
            } else {
                array_push($error, 'Row ke ' . ($i) . ' skiped. <br>');
            }
            $i++;
        }
//        $ctn = json_encode($content);
//        array_push($error, $ctn);
        fclose($file);
        
        if (count($error)>0){
            for ($k=0; $k<count($error); $k++){
                echo $error[$k];
            }
            die();
        }
            
        return $content;
    }

    function escape_string($data){
        $result =   array();
        foreach($data as $row){
            $result[]   =   str_replace('"', '',$row);
        }
        return $result;
    }   
}
?> 