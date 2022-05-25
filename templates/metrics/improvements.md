Utifrån att se resultaten från Scrutinizer finns några delar jag vill ändra i min kod som förhoppningsvis kan förbättra resultatet från dessa rapporter något.

#### Issues

Jag vill börja med att minksa mina issues i scrutinizer. Det är små ändringar som ger bättre kvalité på min kod. Det kommer troligvis inte påverka andra mätvärden än just issues i scrutinizer. 


#### Complexity

Även om jag känner att complexityn för mina klasser inte är särskilt hög finns det vissa metoder i några av klasserna som kan bli lite mindre komplexa. Som t.ex asString i Card-klassen. 


#### Coverage

Jag vill ha lite bättre test coverage av min kod än 25%. Jag vill se över vilka delar jag kan skapa enhetstester för och se över hur jag skulle kunna testa controller-klasserna. Detta skulle leda till en högre coverage i scrutinizer. 


### Implementerade förändringar

#### Complexity

Jag kollade i min kod och på de metoderna som påverkade komplexiteten för de klasser som hade högst komplexitet. Dessa var klasserna Card och metoden asString och Deck med metoden Draw. 
I metoden asString kunde kom jag på att jag enkelt kunde lägga till en proprty med de värden som ska ha en bokstavsstäng istället för värdet som en sträng och sedan kolla i metoden om värdet finns med som nyckel i den propertyn. Då fick jag ner if-satserna från 4 till 1 vilket minksade komplexiteten. 

I Draw hade jag en onödig loop. Loopen kördes så många gånger som antal kort som skulle plockas från kortleken och tog bort ett kort i taget istället för att bara använda splice-funktionen frö att ta bort alla kort på en gång, detta miskade komplexiteten för denna metod.

#### Issues

Jag kollade på de issues jag hade från min scrutinizer rapport. Det var flera issues med unused code som jag enkelt kunde lösa. För det mest var det rader av kod som var "döda" och inte hade någon betydelse i koden. Två major bug och två minor bugs kunde jag också lösa. De resterande 38 buggar som presenterades i scrutinizer kom från samma problem. När jag skrev mina klasser försökte jag tänka på att ha lös koppling. Detta ville jag uppnå genom att i Game (som använder sig av Card, Deck och Player-klasserna) genom att skicka in klasserna som argument innan jag instansierar dom. Men denna lösning klagade scrutiniser på och ledde till dessa issues. Jag funderade på om denna lösning var bäst när det kom till coupling och kom fram till att det är bättre att instantiera dem utanför klassen men skicka in som argument i contruct-metoden för att kunne lägga till dom i propertys. Så jag gjorde interface för Card, Player och Deck som betsämmer de metoder som anropas i andra klasser än den klassen som implementerar de interfacen. Detta gör att kopplingen blir lösare. Skulle jag vilja ha ett annat sorts kort blir det då enklare att skapa utifrån detta interfacet. Detta löste många issues i scrutinizer men påverkade dock inte mina resultat på coupling i phpMetrics. 


#### Coverage

Jag börjde men att skapa enkla enhetstester för book-entityn jag har i min kod. Efter det var coverage fortfarande rätt låg men jag hade inga fler modellklasser att göra tester till. Jag sökte lite på hur jag kunde göra tester för mina router i controllers. I och med att detta inte är något vi har gått igenom la jag dock inte särskilt mycket tid på det. Jag hittade en [sida i Symfonys dokumentation](https://symfony.com/doc/current/testing.html#the-phpunit-testing-framework) för tester i Symfony där det fanns ett sorts test som heter WebTestCase som verkar vara i linje med det vi har jobbat med. Jag gjorde väldigt enkla tester som bara laddar en route, kollar att responsen lyckas och säkerställer att rätt rubrik finns på sidan vilket jag tyckte blev et rimligt sätt att testa controllersen något. Detta höjde min testcoverage till 54%. 

### Resultat

Bilderna nedan visar mätvärderna för complexity före och efter i scrutinizer och php metrics.

#### Scrutinizer
Före:

<img src="/img/scrutinizer/complexity.png" class="metrics-img">

Efter:

<img src="/img/scrutinizer/result-complexity.png" class="metrics-img">


#### PhpMetrics

Före:

<img src="/img/phpmetrics/complexity.png" class="metrics-img">

Efter:

<img src="/img/phpmetrics/result-complexity.png" class="metrics-img">


Nästa Bilder är kopplade tilld e ändringar som gjordes för att få bort de issues jag hade i scrutinizer. Eftersom dessa delvis rörde coupling också så hoppades jag på att förbättra de siffrorna i PhpMetrics men de blev en aning högre. Däremot såg jag att class rank hade ändrats en del som jag tror är kopplad till de ändringar jag gjorde i koden. Class rank är kopplat till ineraktioner mellan klasser och är ett mått på hur viktig en klass är. Jag kan inte hitta så mcyekt mer om detta mätvärde. Av denna förklaring skulle detta kunna vara något som reflekterar den lösare koppling jag ville uppnå med mina ändringar även om det inte visas i afferent eller efferent coupling. 


#### Issues i Scrutinizer
Före:

<img src="/img/scrutinizer/issues.png" class="metrics-img">

Efter:

<img src="/img/scrutinizer/result-issues.png" class="metrics-img">


#### PhpMetrics Class rank

Före:

<img src="/img/phpmetrics/class-rank.png" class="metrics-img">

Efter:

<img src="/img/phpmetrics/result-class-rank.png" class="metrics-img">


#### Coverage
Nedan finns bilderna för coverage i scrutinizer före och efter ändringar.

Före:

<img src="/img/scrutinizer/coverage.png" class="metrics-img">

Efter:

<img src="/img/scrutinizer/result-coverage.png" class="metrics-img">


Här är också de seanste badges som genereas av Scrutinizer:

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/olssonmalin/mvc-report/badges/quality-score.png?b=main)](https://scrutinizer-ci.com/g/olssonmalin/mvc-report/?branch=main)
[![Code Coverage](https://scrutinizer-ci.com/g/olssonmalin/mvc-report/badges/coverage.png?b=main)](https://scrutinizer-ci.com/g/olssonmalin/mvc-report/?branch=main)
[![Build Status](https://scrutinizer-ci.com/g/olssonmalin/mvc-report/badges/build.png?b=main)](https://scrutinizer-ci.com/g/olssonmalin/mvc-report/build-status/main)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/olssonmalin/mvc-report/badges/code-intelligence.svg?b=main)](https://scrutinizer-ci.com/code-intelligence)