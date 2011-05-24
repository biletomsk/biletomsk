<?php
  /*
   * Расширение базового хелпера по работе со строками
   */
  
  //Функция транслита
function cp_cyr2lat($name)
{
    $nick = "";

    for ($i = 0; $i < strlen($name); $i++)
    {
        switch (substr($name, $i, 1))
        {
        case    "1": $nick .= "1"; break;
        case    "2": $nick .= "2"; break;
        case    "3": $nick .= "3"; break;
        case    "4": $nick .= "4"; break;
        case    "5": $nick .= "5"; break;
        case    "6": $nick .= "6"; break;
        case    "7": $nick .= "7"; break;
        case    "8": $nick .= "8"; break;
        case    "9": $nick .= "9"; break;
        case    "0": $nick .= "0"; break;
        case    "a": $nick .= "a"; break;
        case    "A": $nick .= "a"; break;
        case    "b": $nick .= "b"; break;
        case    "B": $nick .= "b"; break;
        case    "c": $nick .= "c"; break;
        case    "C": $nick .= "c"; break;
        case    "d": $nick .= "d"; break;
        case    "D": $nick .= "d"; break;
        case    "e": $nick .= "e"; break;
        case    "E": $nick .= "e"; break;
        case    "f": $nick .= "f"; break;
        case    "F": $nick .= "f"; break;
        case    "g": $nick .= "g"; break;
        case    "G": $nick .= "g"; break;
        case    "h": $nick .= "h"; break;
        case    "H": $nick .= "h"; break;
        case    "i": $nick .= "i"; break;
        case    "I": $nick .= "i"; break;
        case    "j": $nick .= "j"; break;
        case    "J": $nick .= "j"; break;
        case    "k": $nick .= "k"; break;
        case    "K": $nick .= "k"; break;
        case    "l": $nick .= "l"; break;
        case    "L": $nick .= "l"; break;
        case    "m": $nick .= "m"; break;
        case    "M": $nick .= "m"; break;
        case    "n": $nick .= "n"; break;
        case    "N": $nick .= "n"; break;
        case    "o": $nick .= "o"; break;
        case    "O": $nick .= "o"; break;
        case    "p": $nick .= "p"; break;
        case    "P": $nick .= "p"; break;
        case    "r": $nick .= "r"; break;
        case    "R": $nick .= "r"; break;
        case    "q": $nick .= "q"; break;
        case    "Q": $nick .= "q"; break;
        case    "s": $nick .= "s"; break;
        case    "S": $nick .= "s"; break;
        case    "t": $nick .= "t"; break;
        case    "T": $nick .= "t"; break;
        case    "u": $nick .= "u"; break;
        case    "U": $nick .= "u"; break;
        case    "v": $nick .= "v"; break;
        case    "V": $nick .= "v"; break;
        case    "w": $nick .= "w"; break;
        case    "W": $nick .= "w"; break;
        case    "x": $nick .= "x"; break;
        case    "X": $nick .= "x"; break;
        case    "y": $nick .= "y"; break;
        case    "Y": $nick .= "y"; break;
        case    "z": $nick .= "z"; break;
        case    "Z": $nick .= "z"; break;
        case    "а": $nick .= "a"; break;
        case    "А": $nick .= "a"; break;
        case    "б": $nick .= "b"; break;
        case    "Б": $nick .= "b"; break;
        case    "в": $nick .= "v"; break;
        case    "В": $nick .= "v"; break;
        case    "г": $nick .= "g"; break;
        case    "Г": $nick .= "g"; break;
        case    "д": $nick .= "d"; break;
        case    "Д": $nick .= "d"; break;
        case    "е": $nick .= "e"; break;
        case    "Е": $nick .= "e"; break;
        case    "ё": $nick .= "e"; break;
        case    "Ё": $nick .= "e"; break;
        case    "ж": $nick .= "zh"; break;
        case    "Ж": $nick .= "zh"; break;
        case    "з": $nick .= "z"; break;
        case    "З": $nick .= "z"; break;
        case    "и": $nick .= "i"; break;
        case    "И": $nick .= "i"; break;
        case    "й": $nick .= "y"; break;
        case    "Й": $nick .= "y"; break;
        case    "к": $nick .= "k"; break;
        case    "К": $nick .= "k"; break;
        case    "л": $nick .= "l"; break;
        case    "Л": $nick .= "l"; break;
        case    "м": $nick .= "m"; break;
        case    "М": $nick .= "m"; break;
        case    "н": $nick .= "n"; break;
        case    "Н": $nick .= "n"; break;
        case    "о": $nick .= "o"; break;
        case    "О": $nick .= "o"; break;
        case    "п": $nick .= "p"; break;
        case    "П": $nick .= "p"; break;
        case    "р": $nick .= "r"; break;
        case    "Р": $nick .= "r"; break;
        case    "с": $nick .= "s"; break;
        case    "С": $nick .= "s"; break;
        case    "т": $nick .= "t"; break;
        case    "Т": $nick .= "t"; break;
        case    "у": $nick .= "u"; break;
        case    "У": $nick .= "u"; break;
        case    "ф": $nick .= "f"; break;
        case    "Ф": $nick .= "f"; break;
        case    "х": $nick .= "h"; break;
        case    "Х": $nick .= "h"; break;
        case    "ц": $nick .= "ts"; break;
        case    "Ц": $nick .= "ts"; break;
        case    "ч": $nick .= "ch"; break;
        case    "Ч": $nick .= "ch"; break;
        case    "ш": $nick .= "sh"; break;
        case    "Ш": $nick .= "sh"; break;
        case    "щ": $nick .= "sch"; break;
        case    "Щ": $nick .= "sch"; break;
        case    "ъ": $nick .= ""; break;
        case    "Ъ": $nick .= ""; break;
        case    "ы": $nick .= "y"; break;
        case    "Ы": $nick .= "y"; break;
        case    "ь": $nick .= ""; break;
        case    "Ь": $nick .= ""; break;
        case    "э": $nick .= "e"; break;
        case    "Э": $nick .= "e"; break;
        case    "ю": $nick .= "yu"; break;
        case    "Ю": $nick .= "yu"; break;
        case    "я": $nick .= "ya"; break;
        case    "Я": $nick .= "ya"; break;
        case    "*": $nick .= "x"; break;
        case    "-":
        case    "_":
        case    " ":
                if (strlen($nick) > 0)
                    $nick .= "_";
                break;

        default:
                break;
        }
    }

    $nick = substr($nick, 0, 40);

    $nick_arr = explode('_', $nick);
    $nick = "";
    for ($i = 0; $i < count($nick_arr); $i++)
    {
        if (strlen($nick_arr[$i]) > 0)
        {
            if (strlen($nick) > 0)
                $nick .= "_";
            $nick .= $nick_arr[$i];
        }
    }

    return $nick;
}



//Перевод кириллицы в латиницу в транскрипции с удалением "вредных" символов.
function cp_transliter($_txt){

  //Массивы с алфавитами.
  $_rus=array('Q','W','E','R','T','Y','U','I','O','P','A','S','D','F','G','H','J','K','L','Z','X','C','V','B','N','M','q','w','e','r','t','y','u','i','o','p','a','s','d','f','g','h','j','k','l','z','x','c','v','b','n','m','Й', 'Ц', 'У', 'К', 'Е', 'Ё', 'Н', 'Г', 'Ш',  'Щ', 'З', 'Х', 'Ъ', 'Ф', 'Ы', 'В', 'А', 'П', 'Р', 'О', 'Л', 'Д', 'Ж', 'Э', 'Я',  'Ч',  'С',  'М', 'И', 'Т', 'Ь', 'Б', 'Ю', 'й', 'ц', 'у', 'к', 'е', 'ё', 'н', 'г', 'ш',  'щ', 'з', 'х', 'ъ', 'ф', 'ы', 'в', 'а', 'п', 'р', 'о', 'л', 'д', 'ж', 'э', 'я',  'ч',  'с',  'м', 'и', 'т', 'ь', 'б', 'ю', ' ','+','=','|','\\','/','(',')','[',']','{','}',':',';','"','\'','<','>',',','..','?','!','~','@','#','№','$','%','^','&','*','_','-','«','»','. ');
  $_eng=array('q','w','e','r','t','y','u','i','o','p','a','s','d','f','g','h','j','k','l','z','x','c','v','b','n','m','q','w','e','r','t','y','u','i','o','p','a','s','d','f','g','h','j','k','l','z','x','c','v','b','n','m','i', 'c', 'u', 'k', 'e', 'e', 'n', 'g', 'sh', 'sh', 'z', 'x', '', 'f', 'y', 'v', 'a', 'p', 'r', 'o', 'l', 'd', 'j', 'e', 'ya', 'ch', 's', 'm', 'i',  't', '',  'b', 'yu', 'i', 'c', 'u', 'k', 'e', 'e', 'n', 'g', 'sh', 'sh', 'z', 'x','', 'f', 'i', 'v', 'a', 'p', 'r',  'o', 'l',  'd',  'j',  'e', 'ya', 'ch', 's', 'm', 'i',  't', '',   'b', 'y',  '-','','','','','','','','','','','','','','','','','','','.','','','','','','','','','','_','','_','-','"','"','_');

    //Ищем и заменям.
    $_txt=str_replace($_rus, $_eng, $_txt);

	return $_txt;
}
?>