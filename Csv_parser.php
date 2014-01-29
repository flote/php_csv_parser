<?php


/**
 * Class Csv_parser
 *
 * @author Johan Flote
 *
 */
class Csv_parser {

    /**
     *
     * finds delimiter in text
     *
     * @param    string    $text
     *
     * @return   string
     *
     */
    private function delimiter($contents)
    {
        $del_guess = array();
        $del_guess[','] = substr_count($contents,",");
        $del_guess["\t"] = substr_count($contents,"\t");
        $del_guess[';'] = substr_count($contents,";");

        arsort($del_guess);
        $sorted_guess = $del_guess;// array_reverse($del_guess);
        reset($sorted_guess);
        return key($sorted_guess);
    }

    public function delimit_test($text)
    {

        return Csv_parser::delimiter($text);

    }

    /**
     *
     * Takes text, guesses on delimiter and returns array of objects (one object for each row)
     *
     * @param $text
     *
     * @return array or false
     */
    public function parse($text, $delimiter = null)
    {
        $contents = $blob['csv_list'];
        $ok_to_save = true;
        $order_test = array();

        if (isset($blob['first_name'])){
            if ($blob['first_name'] == 'on')
                $order_test[$blob['first_name_order']] = 'first_name';
        }

        if (isset($blob['last_name'])) {
            if ($blob['last_name'] == 'on')
                $order_test[$blob['last_name_order']] = 'last_name';
        }

        if (isset($blob['email'])) {
            if ($blob['email'] == 'on')
                $order_test[$blob['email_order']] = 'email';
        }

        $order_test[] = 'username';

        ksort($order_test);

        $delimiter = ($delimiter) ? $delimiter : Csv_parser::delimiter($text);

        define("PARSER_CSV_DELIMITER", $delimiter);

        $titles = array();
        $holder = array();
        $doubles = array();

        $counter = 0;
        $step_count = 0;
        $lines = explode("\n", $contents);
        foreach ($lines as $l) {

            if ($counter)
                $holder[$counter] = array();


            $line = explode(PARSER_CSV_DELIMITER, $l);
            $step_count = 0;
            if (intval(count($line)+1) == intval(count($order_test))) {
                foreach ($line as $x) {
                    if ($counter == 0) {
                        $titles[$order_test[$step_count+1]] = trim($x);
                    } else {
                        if ($order_test[$step_count+1] == "first_name" || $order_test[$step_count+1] == 'last_name')
                            $holder[$counter][$order_test[$step_count+1]] = $this->st->word_case(trim(trim($x), '"..\''));
                        else {//email
                            $this_email = trim(trim($x), '"..\'');
                            if (!preg_match('/^[^@^\s]+@[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,4}$/', $this_email)) {
                                $holder[$counter][$order_test[$step_count+1]] = "<span class='red'>Felaktig e-postadress: &lt;".$this_email."&gt;</span>";
                                $ok_to_save = false;
                            } elseif ($doubles[$x] = $this->user->check_for_doubles($this_email)) {
                                $holder[$counter][$order_test[$step_count+1]] = "<span class='red'>Redan registrerad: ".$this_email."</span>";
                                $ok_to_save = false;
                            } else {
                                $holder[$counter][$order_test[$step_count+1]] = $this_email;
                            }
                        }
                    }

                    $step_count++;
                }
                if ($counter == 0)
                    $titles['username'] = "Användarnamn";
                elseif (isset($blob['first_name']) && isset($blob['last_name']))
                    $holder[$counter][$order_test[$step_count+1]] = $this->username_genny($holder[$counter]['first_name'],$holder[$counter]['last_name']);
                else
                    $holder[$counter][$order_test[$step_count+1]] = $holder[$counter]['email'];

            } else {
                return false;
                break;
            }
            $counter++;
        }


        return array(
            "titles" => $titles,
            "rows" => $holder,
            "group" => $blob['group'],
            'admin' => $blob['admin'],
            'ok_to_save' => $ok_to_save
        );
    }

} 