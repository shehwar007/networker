<?php

function admin_name(){
    
    return session('AdminData')['admin_name'];
   
}
function admin_email(){
    
    return session('AdminData')['admin_email'];
   
}
function admin_phone(){
    
    return session('AdminData')['admin_phone'];
   
}
function admin_id(){
    
    return session('AdminData')['admin_id'];
   
}


