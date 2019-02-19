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
        $record = movieFactory::create($filename);

        print_r($record);
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
            $movierecords[] = $record;
        }
        fclose($file);
        return $movierecords;
    }
}

//Movie Object
class movie
{


}


//Create Movie Object
class movieFactory {

    public static function create(Array $array = null) {
        $record = new record();

        return $record;

    }

}
