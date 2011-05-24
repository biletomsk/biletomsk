<?php

class MY_Upload extends CI_Upload {
   
   function MY_Upload($props = array())
   {
      parent::CI_Upload($props);
   }
   
   function do_upload($field = 'userfile')
   {
      $success = FALSE;
      if (isset($_FILES[$field]) and is_array($_FILES[$field]['error']))
      {
         // Create a pseudo file field for each file in our array
         for ($i = 0; $i < count($_FILES[$field]['error']); $i++)
         {
         	
            // Give it a name not likely to already exist!
            $pseudo_field_name = '_psuedo_'. $field .'_'. $i;
            // Mimick the file
            $_FILES[$pseudo_field_name] = array(
               'name' => $_FILES[$field]['name'][$i],
               'size' => $_FILES[$field]['size'][$i],
               'type' => $_FILES[$field]['type'][$i],
               'tmp_name' => $_FILES[$field]['tmp_name'][$i],
               'error' => $_FILES[$field]['error'][$i]
            );
			
			
            // Let do_upload work it's magic on our pseudo file field
            $success = parent::do_upload($pseudo_field_name);
         }
      }
      else
      // Works just like do_upload since it's not an array of files
      {
         $success = parent::do_upload($field);
      }
      return $success;
   }
   
}

?>