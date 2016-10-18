<?php

function mes_toString($numero){
    if($numero==1){
        return 'Janeiro';
    }elseif ($numero==2) {
        return 'Fevereiro';
    }elseif ($numero==3) {
        return 'Março';
    }elseif ($numero==4) {
        return 'Abril';
    }elseif ($numero==5) {
        return 'Maio';
    }elseif ($numero==6) {
        return 'Junho';
    }elseif ($numero==7) {
        return 'Julho';
    }elseif ($numero==8) {
        return 'Agosto';
    }elseif ($numero==9) {
        return 'Setembro';
    }elseif ($numero==10) {
        return 'Outubro';
    }elseif ($numero==11) {
        return 'Novembro';
    }elseif ($numero==12) {
        return 'Dezembro';
    }else{
        echo 'Nenhum valor de mês retornado! em util/mes_toString';
    }
}

?>
