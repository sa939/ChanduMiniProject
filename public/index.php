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
        $table = table::genMovieTable($movierecords);
    }
}
class csv
{

    static public function getMovieRecords($filename)
    {

        if (($handle  = fopen($filename, "r")) !== FALSE) {
            $data = array();
            while ($data = fgetcsv($handle,  '1000',  ',') !== FALSE ){
                $movierecords[] = $data;
             }
            fclose($handle);
        }
        return $movierecords;

    }
}

class table {
    static public function genMovieTable($movierecords){
        print_r($movierecords);
    }

}

