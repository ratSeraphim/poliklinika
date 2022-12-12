<?php 
    session_start();

    #ja tiek iznīcināta sesija, pārvieto lietotāju uz ielogošanās mājaslapu
    if(session_destroy()){
        header("location:../login.php");
    }

?>