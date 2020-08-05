<?php
namespace Adoms\src\pasm;

include_once('pasm.php');

    $x = new PASM();

    $x::set('ecx',10)    // REGISTER
        ->set('ldp',1)  // NUMBER OF COMMANDS TO GO BACK
        ->set('pdb',1)  // DEBUG FIELD
        ->set('rdx',3)  // REGISTER
        ->set('ah',2)   // REGISTER
        ->end();
    $y = "ecx";
    $v = null;
    print_r($x, $v);
    echo $v;
    $x::mov_ecx()->decr()->loopnz();
    echo '\n\n\n\n';
    print_r($x);
    $x::set('ah',20)->set('ecx',1)->nop()->inc()->jge();
    print_r($x);
    $x::set('ah',10)->set('ecx',5)->nop()->inc()->jne();
    
    
    $x::set('ecx',0)->inc()->inc()->jmp();
    
    //print_r($x);  
    $x::set('ecx',20)->decr()->decr()->jgz()->set('ldp',4)->loopnz();
    

    $x::set('ecx',20)->set('ldp',2)->decr()->mov_ecx()->jmp()->create_register("eed", 3);
    
    print_r($x);
?> 
