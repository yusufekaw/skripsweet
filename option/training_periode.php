<?php

//pemilihan periode training
function month($periode)
{
    switch($periode)
    {
        case 0 :
            return "date<'2019-12-01'";
        break;
		case 1 :
            return "month(date)=1 and year(date)=2017";
        break;
        case 2 :
            return "month(date)=2 and year(date)=2017";
        break;
        case 3 :
            return "month(date)=3 and year(date)=2017";
        break;
        case 4 :
            return "month(date)=4 and year(date)=2017";
        break;
        case 5 :
            return "month(date)=5 and year(date)=2017";
        break;
        case 6 :
            return "month(date)=6 and year(date)=2017";
        break;
        case 7 :
            return "month(date)=7 and year(date)=2017";
        break;
        case 8 :
            return "month(date)=8 and year(date)=2017";
        break;
        case 9 :
            return "month(date)=9 and year(date)=2017";
        break;
        case 10 :
            return "month(date)=10 and year(date)=2017";
        break;
        case 11 :
            return "month(date)=11 and year(date)=2017";
        break;
        case 12 :
            return "month(date)=12 and year(date)=2017";
        break;
        case 13 :
            return "month(date)=1 and year(date)=2018";
        break;
        case 14 :
            return "month(date)=2 and year(date)=2018";
        break;
        case 15 :
            return "month(date)=3 and year(date)=2018";
        break;
        case 16 :
            return "month(date)=4 and year(date)=2018";
        break;
        case 17 :
            return "month(date)=5 and year(date)=2018";
        break;
        case 18 :
            return "month(date)=6 and year(date)=2018";
        break;
        case 19 :
            return "month(date)=7 and year(date)=2018";
        break;
        case 20 :
            return "month(date)=8 and year(date)=2018";
        break;
        case 21 :
            return "month(date)=9 and year(date)=2018";
        break;
        case 22 :
            return "month(date)=10 and year(date)=2018";
        break;
        case 23 :
            return "month(date)=11 and year(date)=2018";
        break;
        case 24 :
            return "month(date)=12 and year(date)=2018";
        break;
        case 25 :
            return "month(date)=1 and year(date)=2019";
        break;
        case 26 :
            return "month(date)=2 and year(date)=2019";
        break;
        case 27 :
            return "month(date)=3 and year(date)=2019";
        break;
        case 28 :
            return "month(date)=4 and year(date)=2019";
        break;
        case 29 :
            return "month(date)=5 and year(date)=2019";
        break;
        case 30 :
            return "month(date)=6 and year(date)=2019";
        break;
        case 31 :
            return "month(date)=7 and year(date)=2019";
        break;
        case 32 :
            return "month(date)=8 and year(date)=2019";
        break;
        case 33 :
            return "month(date)=9 and year(date)=2019";
        break;
        case 34 :
            return "month(date)=10 and year(date)=2019";
        break;
        case 35 :
            return "month(date)=11 and year(date)=2019";
        break;
        case 36 :
            return "month(date)=12 and year(date)=2019";
        break;
        case 37 :
            return "date<'2019-12-01'";
        break;
        case 38 :
            return "month(date)=12 and year(date)=2019";
        break;
        default :   
            return "month(date)=12 and year(date)=2019";
    }
}

?>

