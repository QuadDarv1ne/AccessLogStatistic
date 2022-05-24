<?php

class Env {
    
    public function getDataPath(): string {
        return getenv('DATA_PATH'); }
}
class Autoload
{	static function run(): void {
    $loadableDirectories = [
        'app/kernel',
        'app/helpers',
        'app/models', ];
       
        foreach($loadableDirectories as $directory) {   
            $directoryPath = "./$directory";
            $loadableFiles = scandir($directoryPath);

            if( $loadableFiles !== false ) {
                foreach ($loadableFiles as $filename) {
                    $fileExtension = pathinfo($filename, PATHINFO_EXTENSION);
                    if($fileExtension === 'php') {
                    	require_once $directoryPath.'/'.$filename; } } } } } }