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

        $records = csv::getRecords($filename);
        $table = html::generateTable($records);

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
                $records[] = movieFactory::create($fieldNames, $record);
            }
            $count++;
        }
        fclose($file);
        return $records;
    }
}


class html {
    public static function generateTable($records) {
        $count = 0;
        foreach ($records as $record) {
            if($count == 0) {
                $array = $record->returnArray();
                $fields = array_keys($array);
                $values = array_values($array);
                print_r($fields);
                print_r($values);
            } else {
                $array = $record->returnArray();
                $values = array_values($array);
                print_r($values);
            }
            $count++;
        }
    }
}


//Movie Object
class movie {
    public function __construct(Array $fieldNames = null, $values = null )
    {
        $record = array_combine($fieldNames, $values);

        print_r($record);

        $this->createProperty();
    }



    public function returnArray() {
        $array = (array) $this;
        return $array;
    }

    public function createProperty($name = 'first', $value = 'Avengers') {
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
