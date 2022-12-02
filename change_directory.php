<?php

namespace App;

class ChangeDirectory
{
    public $currentPath;

    function __construct($path = 'a/b/c/d')
    {
        $this->currentPath = $path;
    }

    public function cd($newPath)
    {
        $separator = '/';
        $pathToCheck = ['..', '.'];
        if (substr($newPath, 0, 1) === '/') {
            $this->currentPath = $newPath;
            return;
        }

        $currentPathCount = count( $this->convertToArray($this->currentPath, $separator) );
        $newPathCount = substr_count($newPath, '..' !== null ? '..' : '.');
        $currentDirectories = array_filter($this->convertToArray($this->currentPath, $separator));

        $newDirectories = array_filter( $this->convertToArray($newPath, $separator), function($value) use($pathToCheck) {
            return !empty($value) && !in_array($value, $pathToCheck, true);
        });

        $newPaths = array_slice($currentDirectories, 0,  $newPathCount > $currentPathCount ? 0 : $currentPathCount - $newPathCount );
        array_push($newPaths, ...$newDirectories);
        $this->currentPath =  $this->implodeData($newPaths, $separator);
        return $this;

    }

    /**
     * @param $data
     * @param $separator
     * @return array|false|mixed|string[]
     */
    private function convertToArray($data, $separator)
    {
        $toArray = $data;
        if(!is_array($toArray)){
            $toArray = explode($separator, $toArray);
        }
        return $toArray;
    }

    /**
     * @param $data
     * @param $separator
     * @return string
     */
    private function implodeData($data, $separator)
    {
        $toArray = $data;
        if(!is_array($toArray)){
            $toArray = explode($separator, $toArray);
        }
        return implode($separator, $toArray);
    }
    
}