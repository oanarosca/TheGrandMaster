#The GrandMaster#

_realizat de Oana Roşca, clasa a 10-a_

_Colegiul Naţional “Dragoş Vodă” Sighetu Marmatiei_

_profesori îndrumători: Dănuţ Bodnariuc, Ovidiu Roşca_

The GrandMaster este un joc, care poate fi jucat online. La momentul pregătirii acestei documentaţii, poate fi accesat la adresa http://thegrandmaster.eu

Pentru realizarea aplicaţiei am folosit următoarele tehnologii: HTML, CSS, Javascript, jQuery, AJAX, Bootstrap, PHP, SQL, Server de baze de date MySQL, phpMyAdmin, fonturi de la Google, iconițe din biblioteca FontAwesome și editorul de text Atom.

În lucrarea mea există două programe: jocul propriu-zis şi un program auxiliar, pe care l-am denumit "jucatorul perfect".
 

##Prezentarea jocului##

###Acţiunile iniţiale###

Înainte ca un utilizator să se poată juca, trebuie să se autentifice. Pentru aceasta, el va introduce un nume şi o parolă, care vor fi validate de aplicaţie, prin compararea cu informaţiile memorate in baza de date.

Am ales să existe un numar fix de niveluri, care au anumite proprietăţi, astfel încât pe de o parte jocul sa fie accesibil unor copii de clasa I, iar pe de alta, să nu se ajungă la o dificultate exagerată.

Când jucătorul deplasează mouse-ul peste pătratele care corespund nivelurilor, apar informaţii privitoare la numărul de încercări efectuate anterior de jucător, numărul de situaţii în care acesta a încheiat cu succes nivelul, numărul de puncte obţinute şi timpul utilizat. Aceste informaţii sunt luate din baza de date.

Pentru utilizator este accesibil iniţial doar primul nivel, iar atunci când acesta rezolvă un nivel, se va debloca următorul. Nivelurile deblocate rămân accesibile, deoarece este posibil ca un jucător să vrea să revină la nivelul respectiv, încercând să obţină mai multe puncte sau un timp mai bun.

Utilizatorul poate accesa o secţiune în care îi sunt prezentate instrucţiunile privitoare la desfăşurarea jocului.

De asemenea, utilizatorul poate accesa propria pagină de profil şi poate vizualiza o listă cu jucătorii cu cele mai bune rezultate.

Am ales ca fundalul jocului să fie negru, deoarece se ştie că astfel se economiseşte energie electrică.

Deoarece jocul este disponibil online, am stabilit ca expresiile care apar în interfaţă să fie scrise în engleză.

 

###Interfaţa jocului şi acţiunile corespunzătoare###

Calculatorul alege aleator o combinaţie, iar jucătorul va trebui să o identifice.

Utilizatorului îi sunt prezentate o serie de informaţii utile în timpul jocului. Altfel, în partea de sus apare numărul nivelului curent, iar sub acesta, un cronometru. Cronometrul porneşte doar atunci când utilizatorul selectează prima piesă.

Pentru a selecta o piesă pentru combinaţia curentă, jucătorul dă clic pe o culoare dintre cele afişate. Piesa va fi afişată în poziţia corespunzătoare în grilă.

Când jucătorul selectează toate piesele corespunzătoare combinaţiei curente, aplicaţia compară această combinaţie cu cea generată iniţial şi prezintă un feedback utilizatorului. Astfel, prezenţa unui pătrăţel roşu în zona de feedback semnifică faptul că în combinaţia curentă una dintre piese are culoarea corectă şi este plasată corect, iar un pătrăţel alb arată că una dintre piese are culoarea corectă, dar nu este plasată corect.

În timpul jocului utilizatorul nu poate pune pauză, deoarece pentru a întreţine corect statisticile este important ca timpul cronometrat să se scurgă fără întrerupere.

Utilizatorul are la dispoziţie un buton de anulare a ultimei selecţii efectuate. Totuşi, acesta nu poate fi folosit după ce s-a selectat ultima piesă dintr-o combinaţie, deoarece nu ar fi corect să existe această posibilitate, având în vedere că jucătorul primeşte feedback instantaneu.

Am testat aspectul interfeţei pe mai multe device-uri şi mi-am dat seama că pe telefon este mai convenabil pentru utilizator ca liniile completate să se deplaseze în jos, ca să nu fie nevoit sa facă frecvent scroll (derulare).

În interfaţă apare şi numarul de încercări pe care le mai are la dispoziţie utilizatorul. Având în vedere că acest număr este foarte important în stabilirea punctajului acordat şi a clasamentului, a fost stabilit într-un mod cât mai realist. Pentru aceasta am folosit un program dotat cu un anumit nivel de inteligenţă artificială, pe care l-am denumit “jucătorul perfect” şi care va fi prezentat mai jos.

 Când jucătorul încheie cu succes un nivel, se calculează numărul de puncte pe care le-a obţinut. Pentru aceasta se foloseşte o formulă, care ţine cont de numărul mediu de încercări necesare “jucătorului perfect” pentru a rezolva nivelul. Dacă rezultatele sunt mai bune decât cel obţinute anterior de utilizator, informaţiile (timp / punctaj) vor fi actualizate în baza de date.

###”Jucătorul perfect”###

Acesta este un program auxiliar, care este folosit pentru stabilirea dificultăţii unui anumit nivel. El joacă “perfect” în sensul că alege de fiecare dată o variantă care să nu  contrazică feedback-ul primit anterior.

Inţial el generează toate variantele posibile, propune prima dintre ele, apoi, pe baza feedback-ului primit alege o nouă variantă.

El rulează de un număr mare de ori şi raportează numărul mediu de încercări de care are nevoie pentru a rezolva un nivel, notat cu n.

Numărul de încercări acordate jucătorului uman pentru un anumit nivel este n * 1.5.
