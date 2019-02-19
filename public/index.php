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
        html::returnTable($table);


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

    public static function movietablerow($row) {
       $html = "<tr> $row </tr>";
       return $html;
    }

    public static function movietablecol($col) {
        $html = "<th> $col </th>";
        return $html;
    }

    public static function returnTable($table) {
        print_r($table);
       return   "<table> $table </table>";
        }



    public static function generateTable($records) {
        $count = 0;
        foreach ($records as $record) {
            if($count == 0) {

                $html = '<table>';
                //Row 1: Array Keys (Headings)
                $array = $record->returnArray();
                $fields = array_keys($array);
                $values = array_values($array);

                foreach ($array as $key=>$value){
                    $tableheaders[] = html::createth($key);

                }

               // print_r($html);

            } else {
                $array = $record->returnArray();
                $values = array_values($array);
                foreach ($array as $key=>$value){
                //    $tablerows[] = html::createtr($key);
                }

              //  print_r($values);
            }
            $count++;
        }
    }



    public static function createth($key)
    {
        // MOVIE HEADERS
        $html = '<th>' .htmlspecialchars($key) . '</th>';

        print_r($html);
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
