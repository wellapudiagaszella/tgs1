<?php 
    $username = "root";                     //username yang dipakai
    $password= "";                          //password yang dipakai
    $db = "akademik";                            //database yang dipakai
    mysql_connect("localhost",$username,$password) or die("koneksi ke MySQL gagal");
    mysql_select_db($db) or die ("koneksi ke dataBase gagal");
   
    $doc = new DomDocument('1.0');                              //memanggil DOMDocument Class
    $root = $doc->createElement('akademik');                        //Buat element baru <news>
    $root = $doc->appendChild($root);                        
 
    $query=mysql_query("select nim,nama,alamat,progdi from mahasiswa");         
    while ( $get_data = mysql_fetch_object($query)) 
    {
        $mahasiswa= $doc->createElement('mahasiswa');                 //buat element baru <item>
        $mahasiswa = $root->appendChild($mahasiswa);                  //masukkan sebagai anak dari element <news>
        foreach($get_data as $fieldname => $fieldvalue)  
        {  
            $child = $doc->createElement($fieldname);      //buat element baru <nama_kolom_tabel>
            $child = $mahasiswa->appendChild($child);           //masukkan sebagai anak dari element <item>
         
            $value = $doc->createTextNode($fieldvalue);    //tambahkan isi data database ke element baru
            $value = $child->appendChild($value);
        }  
    }
    echo $doc->saveXML();   //sekedar menampilkan hasil penyimpanan ke XML
    $doc->save("book.xml");   //simpan XML yang sudah dibuat ke file news.xml
?>