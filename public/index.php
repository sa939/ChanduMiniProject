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

        $fieldnames = array();
        $count = 0;



        while(! feof($file))
        {
            $record = fgetcsv($file);
            if($count == 0){
                $fieldnames == $record;
            }
            else{
                $movierecords[] = movieFactory::create($fieldnames, $record);

            }

            $count++;
        }
        fclose($file);
        return $movierecords;
    }
}

//Movie Object

class movie {
    public function __construct(Array $fieldnames = null, $values = null )
    {

       print_r($fieldnames);
        print_r($values);

        $this->createProperty();
    }

    public function createProperty($name = 'first', $value = 'Avengers'){
        $this->{$name} = $value;
    }
}


//Movie Factory
class movieFactory {
    public static function create(Array $fieldnames = null, Array $values = null) {

        $record = new movie($fieldnames, $values);

        return $record;
    }
}
