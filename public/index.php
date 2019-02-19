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

        $movierecords = csv::getRecords($filename);
        $table = html::generateTable($movierecords);



    }
}
class csv {
    static public function getRecords($filename) {
        $file = fopen($filename,"r");
        $fieldNames = array();
        $count = 0;
        while(! feof($file))
        {
            $record = fgetcsv($file);
            if($count == 0) {
                $fieldNames = $record;
            } else {
                $movierecords[] = movieFactory::create($fieldNames, $record);
            }
            $count++;
        }
        fclose($file);
        return $movierecords;
    }
}


class html {
    public static function generateTable($movierecords) {
        $count = 0;
        foreach ($movierecords as $record){
            $array =  $record->returnArray();
            print_r($array);
        }
    }
}


//Movie Object
class movie {
    public function __construct(Array $fieldNames = null, $values = null )
    {
        $record = array_combine($fieldNames, $values);
        foreach ($record as $property => $value) {
            $this->createProperty($property, $value);
        }

    }

    public function returnArray() {
        $array = (array) $this;
        return $array;
    }






    public function createProperty($name = 'first', $value = 'keith') {
        $this->{$name} = $value;
    }
}
//Create Movie Object
class movieFactory {
    public static function create(Array $fieldNames = null, Array $values = null) {
        $record = new movie($fieldNames, $values);
        return $record;
    }
}
