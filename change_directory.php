<?php

namespace App;

class ChangeDirectory
{
    public mixed $currentPath;

    const  SEPARATOR = '/';
    const PATH_TO_CHECK = ['..', '.'];

    /**
     * @param string $path
     */
    function __construct(string $path = 'a/b/c/d')
    {
        $this->currentPath = $path;
    }

    /**
     * @param string|null $newPath
     * @return $this|void
     */
    public function cd(?string $newPath)
    {
        $pathToCheck = self::PATH_TO_CHECK;
        if (str_starts_with($newPath, '/')) {
            $this->currentPath = $newPath;
            return;
        }

        $currentPathCount = count( $this->convertToArray($this->currentPath) );
        $newPathCount = substr_count($newPath, '..' !== null ? '..' : '.');
        $currentDirectories = array_filter($this->convertToArray($this->currentPath));

        $newDirectories = array_filter( $this->convertToArray($newPath), function($value) use($pathToCheck) {
            return !empty($value) && !in_array($value, $pathToCheck, true);
        });

        $newPaths = array_slice($currentDirectories, 0,  $newPathCount > $currentPathCount ? 0 : $currentPathCount - $newPathCount );
        array_push($newPaths, ...$newDirectories);
        $this->currentPath =  $this->implodeData($newPaths);
        return $this;

    }

    /**
     * @param string $data
     * @return string[]
     */
    private function convertToArray(string $data): array
    {
        return explode(self::SEPARATOR, $data);

    }

    /**
     * @param array $data
     * @return string
     */
    private function implodeData(array $data): string
    {
        return implode(self::SEPARATOR, $data);
    }
    
}
