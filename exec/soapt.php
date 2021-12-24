<?php
    // phpinfo();


    // Соединение с БД
    $dblocation = "127.0.0.1"; // Имя сервера
    $dbuser = "root";          // Имя пользователя
    $dbpasswd = "RooT";            // Пароль
    $dbname = "prote";          // Имя базы данных


    $db = @mysql_connect($dblocation,$dbuser,$dbpasswd);

    if (!$db) // Если дескриптор равен 0 соединение не установлено
    {
      echo("<P>В настоящий момент сервер базы данных не доступен, поэтому
               корректное отображение страницы невозможно.</P>");
      exit();
    }

    if (!@mysql_select_db($dbname, $db))
    {
      echo( "<P>В настоящий момент база данных не доступна, поэтому
                корректное отображение страницы невозможно.</P>" );
      exit();
    }
    mysql_set_charset ('utf8', $db);

    try {
       $wsdl='http://esb.intime.ua:8080/services/intime_api_3.0?wsdl';
       $soapClientOptions = array(
        'trace'=>1,
        'version'=>SOAP_1_2,
        'exception' => 0
       );
       $soapClient = new SoapClient($wsdl, $soapClientOptions);


       // Список чего угодно :-)
       if (0) {
       echo "Список областей\n";
       $res=$soapClient->get_box_by_id(array('api_key'=>'36413862670001156560', 'id'=>''));
       $res=json_decode(json_encode($res), True);
       $res=$res['Entry_get_box_by_id'];
       print_r($res);die();
       //*************
        }
       // Список областей
       echo "Список областей\n";
       $res=$soapClient->get_area_by_id(array('api_key'=>'36413862670001156560', 'id'=>''));
       $res=json_decode(json_encode($res), True);
       $res=$res['Entry_get_area_by_id'];
       // print_r($res['Entry_get_area_by_id']);die();
       //
       // Удаляем таблицу
       mysql_query("TRUNCATE TABLE `in_areas`");

       foreach ($res as $row) {
           $sSQL = "insert into `in_areas` "
                   . "(`id`, `country_id`, `name_ua`, `name_ru`, `short_name_ua`, `short_name_ru`, `code`, `last_change`,`Status`)"
                   . "VALUES ("
                   . "'".$row['id']."',"
                   . "'".$row['country_id']."',"
                   . "'".mysql_real_escape_string ($row['name_ua'])."',"
                   . "'".mysql_real_escape_string ($row['name_ru'])."',"
                   . "'".mysql_real_escape_string ($row['short_name_ua'])."',"
                   . "'".mysql_real_escape_string ($row['short_name_ru'])."',"
                   . "'".$row['code']."',"
                   . "'".$row['last_change']."',"
                   . "'".$row['Status']."')";

            $res=mysql_query($sSQL);

           // print_r($row);
       }

//

       // Список районов
       echo "Список районов\n";
       $res=$soapClient->get_district_by_id(array('api_key'=>'36413862670001156560', 'id'=>''));
       $res=json_decode(json_encode($res), True);
       $res=$res['Entry_get_district_by_id'];

       // Удаляем таблицу
       mysql_query("TRUNCATE TABLE `in_districts`");

       foreach ($res as $row) {
           $sSQL = "insert into `in_districts` "
                   . "(`id`, `area_id`, `name_ua`, `name_ru`, `short_name_ua`, `short_name_ru`, `code`, `last_change`,`status`)"
                   . "VALUES ("
                   . "'".$row['id']."',"
                   . "'".$row['area_id']."',"
                   . "'".mysql_real_escape_string ($row['name_ua'])."',"
                   . "'".mysql_real_escape_string ($row['name_ru'])."',"
                   . "'".mysql_real_escape_string ($row['short_name_ua'])."',"
                   . "'".mysql_real_escape_string ($row['short_name_ru'])."',"
                   . "'".$row['code']."',"
                   . "'".$row['last_change']."',"
                   . "'".$row['status']."')";

            $res=mysql_query($sSQL);

           // print_r($row);
       }




        // Список населенных пунктов
        echo "Список населенных пунктов\n";
        $res=$soapClient->get_locality_all(array('api_key'=>'36413862670001156560', 'id'=>''));
        $res=get_object_vars($res);
        $res=$res['Entry_get_locality_all'];
        // print_r($res); die();
        // $res=json_decode(json_encode($res), True);
        // $res=$res['Entry_get_locality_all'];
        // Удаляем таблицу
        mysql_query("TRUNCATE TABLE `in_localities`");

        foreach ($res as $row) {
            $row=get_object_vars($row);
            echo '.';
            $sSQL = "insert into `in_localities` "
                    . "(`Id`, `Area_Id`, `Locality_Type_Id`, `Locality_Name_Ua`, `Locality_Name_Ru`, `Locality_Short_Name_Ua`, `Locality_Short_Name_Ru`, `Locality_Code`,`Last_Change`,`Status`,`District_Id`,`Latitude`,`Longitude`,`Koatuu` )"
                    . "VALUES ("
                    . "'".$row['Id']."',"
                    . "'".$row['Area_Id']."',"
                    . "'".$row['Locality_Type_Id']."',"
                    . "'".mysql_real_escape_string ($row['Locality_Name_Ua'])."',"
                    . "'".mysql_real_escape_string ($row['Locality_Name_Ru'])."',"
                    . "'".mysql_real_escape_string ($row['Locality_Short_Name_Ua'])."',"
                    . "'".mysql_real_escape_string ($row['Locality_Short_Name_Ru'])."',"
                    . "'".$row['Locality_Code']."',"
                    . "'".$row['Last_Change']."',"
                    . "'".$row['Status']."',"
                    . "'".$row['District_Id']."',"
                    . "'".$row['Latitude']."',"
                    . "'".$row['Longitude']."',"
                    . "'".$row['Koatuu']."')";

             $res=mysql_query($sSQL);

            // print_r($row);
        }

        ////
//
       // Список отделений
       echo "Список отделений\n";
       $res=$soapClient->get_branch_by_id(array('api_key'=>'36413862670001156560', 'id'=>''));
       $res=get_object_vars($res);
       $res=$res['Entry_get_branch_by_id'];

       // Удаляем таблицу
       mysql_query("TRUNCATE TABLE `in_branches`");

       foreach ($res as $row) {
            $row=get_object_vars($row);
            echo '.';
            $sSQL = "insert into `in_branches` "
                    . "(`id`, `parent_id`, `branch_type_id`, `number`, `name_ua`, `name_ru`, `short_name_ua`, `short_name_ru`,`locality_id`,`latitude`,`longitude`,`company_id`,`address_ua`,`address_ru`, `status`, `last_change`, `phone_numbers`, `emails`, `max_weight`, `max_length` )"
                    . "VALUES ("
                    . "'".$row['id']."',"
                    . "'".$row['parent_id']."',"
                    . "'".$row['branch_type_id']."',"
                    . "'".$row['number']."',"
                    . "'".mysql_real_escape_string ($row['name_ua'])."',"
                    . "'".mysql_real_escape_string ($row['name_ru'])."',"
                    . "'".mysql_real_escape_string ($row['short_name_ua'])."',"
                    . "'".mysql_real_escape_string ($row['short_name_ru'])."',"
                    . "'".$row['locality_id']."',"
                    . "'".$row['latitude']."',"
                    . "'".$row['longitude']."',"
                    . "'".$row['company_id']."',"
                    . "'".mysql_real_escape_string ($row['address_ua'])."',"
                    . "'".mysql_real_escape_string ($row['address_ru'])."',"
                    . "'".$row['status']."',"
                    . "'".$row['last_change']."',"
                    . "'".mysql_real_escape_string ($row['phone_numbers'])."',"
                    . "'".mysql_real_escape_string ($row['emails'])."',"
                    . "'".$row['max_weight']."',"
                    . "'".$row['max_length']."')";


             $res=mysql_query($sSQL);

            // print_r($row);
        }
    }

    catch (SoapFault $exc) {
        print_r($exc->getMessage());
    }
