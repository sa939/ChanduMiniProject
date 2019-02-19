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
            $movierecords[] = $record;
        }
        fclose($file);
        return $movierecords;
    }
}



