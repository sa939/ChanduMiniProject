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
    //    $createtr = html::generateTable($movierecords);
      //  $createth = html::generateTable($movierecords);

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



    public static function generateTable($movierecords) {
        $count = 0;
        $html = '<table>';

        foreach ($movierecords as $record) {


            if($count == 0) {

                $array = $record->returnArray();
                $fields = array_keys($array);
                $values = array_values($array);

                $tableheaders[] = html::createth($array);

                $tableheaders[] = html::createtr($values);



            } else {
                $array = $record->returnArray();
                $fields = array_keys($movierecords);

                 $values = array_values($array);
            //    print_r($values);
              //  $tableheaders[] = html::createtr($values);

                $tableheaders[] = html::createtr($values);

            }

            $count++;




        }

        $html .= '</table>';
        print_r($html);
    }



    public static function createth($values)
    {
        $movieth = '<tr>';

        foreach ($values as $key=>$value) {
                $movieth .= '<th>' . htmlspecialchars($key) . '</th>';

            }
            $movieth .= '</tr>';
            print_r($movieth);

    }


    public static function createtr($array)
    {
        $movietr = '<tr>';

        foreach ($array as $key){
            $movietr .= '<td>' .($key) . '</td>';

        }
        $movietr .= '</tr>';
        print_r($movietr);

    }



    public static function createtd($key)
    {
        // MOVIE COLUMNS
        $movietd = '<td>' .htmlspecialchars($key) . '</td>';

        print_r($movietd);
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
