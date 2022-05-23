### Överblick

<img src="/img/phpmetrics/overview.png" class="metrics-img">

### Coverage

I min phpMetrics-raport har jag inget värde för coverage. Se Scrutinizer.

### Complexity
<img src="/img/phpmetrics/complexity.png">

I bilden ovanför är en tabell över klasserna i mitt projekt. Tabellen är sorterad efter Class cyclomatic complexity. 
Högst upp finns klassen Card. Card har en total komplexitet på 6. Vi kan också se att den metod med mest komplexitet också har värdet 6 under columnen Max method cycl. Detta innebär alltså att klassens komplexitet kommer från denna metod. Metoden är asString i card-klassen. Den innehåller en del if-satser för att avgöra vad som ska returneras för att få kortets värde som en sträng. Har kortet värde 10 returneras "10" men är det ett klätt kort så returneras den korrekta bokstaven istället för värdet som sträng t.ex värde 13 returneras "K" efter som det är det värde kung har. Här går det att miska complexiteten och byta ut if-satserna till en annan lösning. 

Nästa klass med 6 i cyclomatic complexity är Deck. Deck har även ett högre WMC (weighted method count) är en ett tal som visar på tyngden av metoderna. Jag är inte helt säker på vad detta beror på men jag tror att det kan bero på att Deck-klassen består av komplexitet bestående av loopar mer än if-satser. De flesta av dessa loopar anser jag behövs dock finns en loop i metoder draw som jag tor kan undvikas och därmed minska komplexiteten en aning. 

Andra intressanta värden är WMC och Relative system complexity för BookContoller. Dessa är höga jämfört med de andra klasserna på grund av att ORM används i denna klass med CRUD. Jag kan inte hitta en tydlig defenition för realtive system complexity men av att se värderna är min teori att detta tal blir högra av användandet av andra moduler samt POST requests. Vi kan se samma värde något högre för t.ex GameController, Deal och Draw (som också är controllers) och det dessa har gemensamt är att de tar emot formulär via POST och/eller att logiken i metoderna för routrarna kallar på fler metoder i objekt än de med lägre Relative system complexity-värde.

### Coupling
<div class="text-img-container">
<img src="/img/phpmetrics/coupling-afferent.png" class="metrics-img">
<img src="/img/phpmetrics/coupling-efferent.png" class="metrics-img">
</div>


Bilderna ovan visar mina klasser samt deras mätvärden för cohesion. Den vänstra bilden är klasserna sorterade efter högts afferent coupling och den högra efter högst efferent coupling. Sambandet vi kan se av dessa två mätvärden är att klasserna för objecten som används på sidan som deck, card osv ligger högst upp när det kommer till afferent coupling och controller-klasserna ligger högst upp när det kommer till effernt coupling. Detta beror på att metoderna i controller-klasserna instansierar de andra klasserna för att de ska kunna användas för att visas på sidan. Vi ser också att controller-klasserna har 0 på afferent coupling eftersom dessa klasser inte instasieras i någon annan klass. Högst upp för listan för effernt coupling har vi BookController. Även om denna controller främst använder sig av book-klassen är den så beroende av denna klass i varje metod vilket gör kopplingen stark. 


För afferent coupling har vi Deck som ligger högst upp. Detta beror på att det finns flera controller-klasser som använder denna klass. T.ex är Draw-controllern och Deal-controllern beroende av denna då de drar och delar ut kort från kortleken.


Jag har svårt att komma på hur jag ska kunna ändra de mätvärden som är högre på grund av påverkar från controller-klasserna. Däremot kan det finnas chans att förbättra dessa värden genom att kolla på hur kortspelsklasserna använder sig av varandra. T.ex game som har efferent coupling på 3 kan gå att se över och då i sin tur påverka affenert coupling för andra klasser.


### Cohesion
<img src="/img/phpmetrics/lcom.png">


Bilden oven visar en tabell över klasserna sorterad efter högst LCOM-värde. Det högsta värdet i tabellen är 2 som är främst gemensamt för controller-klasserna. Detta är något som kan förbättras genom att lyfta ur en del metoder/routrar till en annan klass för att dela upp ansvaret en del. Sedan finns player-klassen också högt upp med LCOM 2. Detta är kanske något som skulle förbättras genom att förendra lite hur flödet går mellan klasserna game, deck och player. 


### Violations och annat intressant
<img src="/img/phpmetrics/violations.png">

I PHPMetrics finns en sida för violations. Jag har två violations för paketen App/Card och App/Entity. Detta är ett fel om att paketet inte följer Stable Abstractions Principle. Jag försöker läsa på om vad felet beror på men har svårt att hitta underlag för hur jag ska kunna lösa problemet. 


<div class="text-img-container">
<img src="/img/phpmetrics/class-rank.png" class="metrics-img-vertical">

Ett instressant värde vi får av PHPMetrics är class-rank. Detta är ett uppskattat värde på hur vikigt klassen är. Jag kan se att min Card-klass är högst upp på denna lista. Detta beror på att den används många gånger i Deck. Card är den minsta beståndsdel i mitt spel. Kortleken består av 52 kort och dessa är just Card-object därför kan jag förstå att den klassen hamnar högt upp på denna lista över class rank. 

</div>


