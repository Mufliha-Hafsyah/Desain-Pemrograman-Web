<?php 
$myArray = array();

if(empty($myArray)){
    echo "Array tidak terdefinisi atau kosong";
}else{
    echo "Array terdefinisi dan tidak kosong";
}

echo "<br>";

if(empty($nonExistentVar)){
    echo "Varible tidak terdefinisi atau kosong";
}else{
    echo "Varible terdefinisi dan tidak kosong";
}
?>