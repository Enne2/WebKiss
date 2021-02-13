<?php

class Compiler
{
    static public function compile($data_file){
        global $context;
        $context=42;
    // Parse, fill and return YAML data files
        $fc = file_get_contents($data_file);
        $parsed = yaml_parse($fc);
        return (array)self::parse_array($parsed);
    }
    static private function parse_array($in){
        $Parsedown = new Parsedown();
        foreach($in as $key => $value)
            if(is_array($value))
                $in[$key] = self::parse_array($value);
            else
                if(strpos($value,"md:")===0)
                    $in[$key] = $Parsedown->text(file_get_contents(str_replace("md:", null, $value)));
        return $in;
        
    }
}
