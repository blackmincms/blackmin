//listing 1.0

//Silnik skryptu
//Pobrano z Funkcje.net
Array.prototype.remove=function(s){
                        for(i=0;i<s.length;i++){
                        if(s==this[i]) this.splice(i, 1);
                        }
                }

//listing 2.0
var tablica = ['raz', 'dwa', 'trzy'];
tablica.remove('dwa');

//teraz var tablica wynosić będzie ['raz', 'trzy']