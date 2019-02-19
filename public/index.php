<?php
/**
 * Created by PhpStorm.
 * User: Chandu
 * Date: 2019-02-17
 * Time: 21:30
 */

main::start($filename= "movies.csv");

class main
{
    public static function start($filename)
    {

        $movierecords = csv::getMovieRecords($filename);
        print_r($movierecords);
        }
}
class csv
{

     public  static  function getMovieRecords($filename)
    {

        $file = fopen($filename,"r");

        while(! feof($file))
        {
            $record = fgetcsv($file);
            $movierecords[] = movieFactory::create($record);
        }
        fclose($file);
        return $movierecords;
    }
}

//Movie Object

class movie {
    public function __construct($record)
    {
        print_r($record);
    }
}


//Movie Factory
class movieFactory {
    public static function create(Array $array = null) {
        $record = new movie($array);

        return $record;
    }
}
