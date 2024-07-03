<?php

if (!function_exists('class_basename')) {

    function class_basename($className){
    
        // Split the class name by backslashes to get the namespace and class name parts
        $parts = explode('\\', $className);

        // The last part of the exploded array will be the class name without the namespace
        $classNameWithoutNamespace = end($parts);

        // Output the class name without the namespace
        return $classNameWithoutNamespace;
    }
}


if (!function_exists('cl')) {

    function cl($fileName, $message) {

        $logFilePath = storage_path('logs') . '/'. $fileName . '.log';
        
        if (is_array($message)) {                                   // Convert array to string representation
            $message = print_r($message, true);
        }

        $formattedMessage = '[' . date('Y-m-d H:i:s') . '] : ' . $message . PHP_EOL;

        file_put_contents($logFilePath, $formattedMessage, FILE_APPEND);
    }
}


if (!function_exists('cd')) {

    function cd($variable, $name = NULL) {

        if(is_array($variable) || is_object($variable)){

            echo "<pre>{$name} = ";print_r($variable);echo "</pre><br/>";
        }else{

            echo "{$name} = {$variable}<br/>";
        }
    }
}

// 'Sub Title' to 'sub_title'
if (!function_exists('convert_to_snake_case')) {

    function convert_to_snake_case($string) {
        
        $string = strtolower($string);
        return preg_replace('/[\s-]+/', '_', $string);
    }
}

// 'sub_title' to 'Sub Title'
if (!function_exists('snake_to_title_case')) {

    function snake_to_title_case($str) {
        
        return ucwords(str_replace('_', ' ', $str));                
    }
}

if (!function_exists('get_public_vars')) {

    function get_public_vars($obj) {
        
        $reflection = new ReflectionClass($obj);
        $properties = $reflection->getProperties(ReflectionProperty::IS_PUBLIC);

        $publicProperties = [];
        foreach ($properties as $property) {
            $propertyName = $property->getName();
            $publicProperties[$propertyName] = $obj->$propertyName;
        }    
        
        return $publicProperties;
    }
}

if (!function_exists('copy_values_this_to_model')) {

    function copy_values_this_to_model($request, &$model_obj) {
        
        foreach($request as $key => $value){

            $model_obj->$key = $value;
        }

        return $model_obj;
    }
}

if (!function_exists('copy_values_model_to_this')) {

    function copy_values_model_to_this($model_obj, $this_obj, $public_vars) {
        
        foreach($public_vars as $key => $value){

            $this_obj->$key = $model_obj->$key;
        }
    }
}





?>