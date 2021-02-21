<?php

class Compiler
{   
    protected $steps = array();
    public function compile(){
        foreach($this->steps as $name => $val){
        // Parse, fill and return YAML data files
            $parsed = yaml_parse(file_get_contents($val[2]));
            $parsed = $this->parse_array($parsed);
            $args = $val[4];
            if($val[3]){
                require $val[3];
            }
            echo "$name compiled successfully\n";
            file_put_contents($val[0], Template::view($val[1],$parsed));
        }
    }
    private function parse_array($in){
        $Parsedown = new Parsedown();
        foreach($in as $key => $value)
            if(is_array($value))
                $in[$key] = $this->parse_array($value);
            else
                if(strpos($value,"md:")===0)
                    $in[$key] = $Parsedown->text(file_get_contents(str_replace("md:", null, $value)));
        return $in;
        
    }
    public function add_step($name, $output, $template, $data, $script = null, $args = null){
        $this->steps[$name] = array($output, $template, $data, $script, $args);
    }

}
