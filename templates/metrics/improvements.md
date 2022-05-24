Utifrån att se resultaten från Scrutinizer finns några delar jag vill ändra i min kod som förhoppningsvis kan förbättra resultatet från dessa rapporter något.

#### Issues

Jag vill börja med att minksa mina issues i scrutinizer. Det är små ändringar som ger bättre kvalité på min kod. Det kommer troligvis inte påverka andra mätvärden än just issues i scrutinizer. 


#### Complexity

Även om jag känner att complexityn för mina klasser inte är särskilt hög finns det vissa metoder i några av klasserna som kan bli lite mindre komplexa. Som t.ex asString i Card-klassen. 


#### Coverage

Jag vill ha lite bättre test coverage av min kod än 25%. Jag vill se över vilka delar jag kan skapa enhetstester för och se över hur jag skulle kunna testa controller-klasserna. Detta skulle leda till en högre coverage i scrutinizer. 


#### Cohesion
#### Coupling

### Implementerade förändringar

#### Complexity

Jag kollade i min kod och på de metoderna som påverkade komplexiteten för de klasser som hade högst komplexitet. Dessa var klasserna Card och metoden asString och Deck med metoden Draw. 

(Tog bort loop i Draw och ändrade asString till ett if istället för 4)


#### Issues

Jag kollade på de issues jag hade från min scrutinizer rapport. Det var flera issues med unused code som jag enkelt kunde lösa. För det mest var det rader av kod som var "döda" och inte hade någon betydelse i koden. Två major bug och två minor bugs kunde jag också lösa. De resterande 38 buggar som presenteras i scrutinizer är alla av samma typ. Det är när jag skickar in en klass som argument när jag instansierar en annan klass säger scrutinizer att detta inte....

GÖR INTERFACE TILL CARD OCH DECK

### Resultat

