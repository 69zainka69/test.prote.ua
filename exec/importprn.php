<?php
    // ��
    $dblocation = "127.0.0.1"; // ��� �������
    $dbuser = "root";          // ��� ������������
    $dbpasswd = "RooT";            // ������
    $dbname = "prote";
    $dbcnx = @mysql_connect($dblocation,$dbuser,$dbpasswd);

    $vmcat= '3282';

    $vmcats=array(
       '3277'=> '53',   // ����������
       '3286'=> '22',
       '3275'=> '51',   // ������� ������
       '3281'=> '31',   // ��������� � �����-���������
       '3282'=> '21'    // ��������� ��������
    );

$occats=array(
// '20' =>
'21' => array( '3282', '��������� ��������'),
'22' => array( '3286', '�������'),
'23' => array( '3287', '����'),
'24' => array( '3288', '���'),
'25' => array( '3302', ''),
// ''30' => array('),
'31' => array( '3280', '��������� � �����-���������'),
'32' => array( '3290', '����� ??') , // '3291'  3290
'33' => array( '3292', '������������ ??'),  // �������� - 3293!
'34' => array( '3295', '���� � ��������'),
'35' => array( '3296', '���� � ����������'),
'36' => array( '3294', '������'),
'37' => array( '3298', '�� ��� ��������'),
// ''40' => array('),
'41' => array( '3283', '��������� � ����� ��� ��������� ���������'),
'42' => array( '3284', '������ ��� ������'),
// ''50' => array('),
'51' => array( '3275', '������� ������'),
'52' => array( '3276', '������'),
'53' => array( '3277', '����������'),
'54' => array( '3278', '��������� ��� ����������'),
'55' => array( '3283', '��������� � ����� ��� ��������� ���������'),
'56' => array( '6382', '����� ��� ��������'),
'57' => array( '6448', '�������� ��� ����'),
// 60' => array('),
'61' => array( '6325', '������������� �������'),
'62' => array( '6323', ' ���-�����'),
'63' => array( '6327', '��������'),
'64' => array( '3316', '��������� � �����'),
'65' => array( '6328', 'USB ���� � ��������'),
'66' => array( '3312', '����-������'),
'67' => array( '3310', ' CD'),
'68' => array( '3319', '���������'),
'69' => array( '6434', '������� � ����������'),
'70' => array( '6352', '������� ��� ���'),
'71' => array( '3315', 'USB ������ � �����������'),
'72' => array( '6362', '����'),
'73' => array( '3318', '�������� ��������'),
'74' => array( '6341', '������'),
'75' => array('6326', '����� ������'),
//''80' => array('),
'81' => array( '3304', '�������� �������� � ���'),
'82' => array( '3305', '�������� �������� � ���'),
'83' => array( '6412', '��������� � ���������'),
'84' => array( '6413', '������� � ���������'),
);

$occat='32';




    // ���������
    // $vmcat='3277'; // 3286'; //3275';
    // $occat='53'; //22'; // 51';
    // $vmcat='3286'; //3275';
    // $occat='22'; // 51';
    //$vmcat='3275';
    // $occat= '51';
    // ��������� � �����-���������

    $vmcat= $occats[$occat][0];
    //

    if (!$dbcnx) // ���� ���������� ����� 0 ���������� �� �����������
    {
      echo("<P>� ��������� ������ ������ ���� ������ �� ��������, �������
               ���������� ����������� �������� ����������.</P>");
      exit();
    }
    $sSQL="
      SELECT *
      FROM `articles` a, cont_2130 b
      WHERE `category`='".$vmcat."' AND
      a.absnum=b.absnum AND
      a.langid=b.langid AND
      b.price_group=1 AND
      b.currency=1
      ORDER by a.absnum, a.langid

    ";

    $langcodes=array(1=>'ru', 2=>'ua', 3=>'en');

    if (!@mysql_select_db($dbname, $dbcnx))
    {
      echo( "<P>� ��������� ������ ���� ������ �� ��������, �������
                ���������� ����������� �������� ����������.</P>" );
      exit();
    }

    $a=mysql_set_charset ('utf8', $dbcnx);


    $art = mysql_query($sSQL);

    if($art)
    {

      $currentAbsnum=0;

      while ($article = mysql_fetch_array($art))
      {
          if ($article['absnum']!=$currentAbsnum)
          {
             $currentAbsnum=$article['absnum'];
             $data[$currentAbsnum]=array(
                 'absnum'   => $article['absnum'],
                 'alias'    => $article['alias'],

                 'axapta_code' => $article['axapta_code'],
                 'axapta_article' => $article['axapta_article'],
                 'axapta_alias' => $article['axapta_alias'],
                 'price' => $article['amount']
                 );
          }
          if (isset($langcodes[$article['langid']]))
          {
            $langcode=($langcodes[$article['langid']]);
            $data[$currentAbsnum]['name_'.$langcode]=$article['title'];
            $data[$currentAbsnum]['description_'.$langcode]=$article['body'];
            $data[$currentAbsnum]['meta_title_'.$langcode]=$article['meta_title'];
            $data[$currentAbsnum]['meta_h1_'.$langcode]=$article['meta_h1'];
            $data[$currentAbsnum]['meta_keywords_'.$langcode]=$article['meta_keywords'];
            $data[$currentAbsnum]['meta_description_'.$langcode]=$article['meta_description'];
          }

      }
      // echo '<pre>';
      // print_r($data);
      // echo '</pre>';

      foreach ($data as $k => $d)
      {

          $imgdecode=substr($d['absnum']+'', 0, 3).'/'.(int)substr($d['absnum'], 3, 5);
          // �������� ������ � �������� �������
          $sSQL="
          INSERT `oc_product`
          SET
          `sku`='".$d['axapta_article']."',
          `upc`='".$d['absnum']."',
          `status`=1,
          `price`=".$d['price'].",
          `image`='img/article/".$imgdecode."_main.jpg'
          ";


          if(mysql_query($sSQL))
          {
            $lastid=mysql_insert_id();
            // $lastid = 22222;
            echo '#';
            // �������� �������������� �������
            foreach ($langcodes as $kode => $lcode)
            {
              if(isset($d['name_'.$lcode]) OR
              isset($d['description_'.$lcode]) OR
              isset($d['meta_title_'.$lcode]) OR
              isset($d['meta_h1_'.$lcode]) OR
              isset($d['meta_description_'.$lcode]))
              {
                // �������� �������������� �������
                $sSQL="
                INSERT `oc_product_description`
                SET
                `product_id`=".$lastid.",
                `language_id`=".$kode.",
                `name`='".mysql_real_escape_string(substr($d['name_'.$lcode], 0, 254))."',
                `description`='".mysql_real_escape_string($d['description_'.$lcode])."',
                `meta_title`='".mysql_real_escape_string(substr($d['meta_title_'.$lcode],0,254))."',
                `meta_h1`='".mysql_real_escape_string(substr($d['meta_h1_'.$lcode],0,254))."',
                `meta_description`='".mysql_real_escape_string(substr($d['meta_description_'.$lcode],0,254))."',
                `meta_keyword`='".mysql_real_escape_string(substr($d['meta_keyword_'.$lcode],0,254))."'
                ";
                if(!mysql_query($sSQL)) echo $sSQL;
              }
            }

            // ���������� �����������
            $imglist=array();
            $sSQL="SELECT * FROM `articles_gallery` where parent=".$d['absnum'];
            if($imgl=mysql_query($sSQL))
            {
               while ($imgrow = mysql_fetch_array($imgl))
               {
                  $imglist[]=array($imgrow['absnum'],$imgrow['position']);
               }

               foreach($imglist as $imgitem) {
                  $sSQL="
                      INSERT `oc_product_image`
                      SET
                      `product_id`=".$lastid.",
                      `image`='img/gallery/".$imgdecode."/".$imgitem[0]."_main.jpg',
                      `sort_order`=".$imgitem[1];
                  mysql_query($sSQL);

               }
            }

            // �������� � ��������
            $sSQL="
                INSERT `oc_product_to_store`
                SET
                `product_id`=".$lastid.",
                `store_id`=0";
            mysql_query($sSQL);

            // �������� � ���������
            $sSQL="
                INSERT `oc_product_to_category`
                SET
                `product_id`=".$lastid.",
                `category_id`=".$occat.",
                `main_category`=0";
            mysql_query($sSQL);

            //
          }
          else
          {
            echo $sSQL;
          }




      }



    }

    // ���������
    if(mysql_close($dbcnx)) // ��������� ����������
    {
      echo("���������� � ����� ������ ����������");
    }
    else
    {
      echo("�� ������� ��������� ����������");
    }
    echo '� ��������� '.$occats[$occat][1].' ';
    echo '���������: '.count($data).' �������';
?>