<?php

/**
* Format the date to a readable sentence
*
* @return string
*/
function parseDate($date) {
    
    /*
    Retornar coisas como:
	agora mesmo,
	há 15 minutos
    há 4 horas,
	ontem,
	há 3 dias,
	semana passada,
	há 3 mêses,
	ano passado
    */
    
    return 'em '.$date;
}