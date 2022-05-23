
### Överblick

<div class="text-img-container">
<img src="/img/scrutinizer/overview.png" class="metrics-img-vertical">
Detta är överblicken och de badges jag får när jag skapar raporten för min kod i scrutinizer. Detta är dock inte första rapporten. Jag skapade en rapport innan där jag inkluderade mappen tools, då var Scrutinizer-värdet 6.14. Jag valde att exkludera denna mapp då det inte är filer jag kommer jobba med så för att enklare se mätvärden på klasser och metoder som jag ska jobba med är dessa filer inte med i raporten. 

</div>

### Coverage
<img src="/img/scrutinizer/coverage.png" class="metrics-img">

I denna bild ser vi täckningen av de tester som jag har skrivit i tidigare kurs-moment. Här finns en chnas till förbättring. T.ex kan entity Book ha en del tester. Det skulle också vara bra att ha tester för controllers.

### Complexity

<div class="text-img-container">
<img src="/img/scrutinizer/complexity.png" class="metrics-img">
<img src="/img/scrutinizer/complexity-operation.png" class="metrics-img">
</div>

I Scrutinizer skiljer sig komplexiteten från de värdet jag fick i PHPMetrics-raporten. I Scrutinizer skrivs det som Total complexity till skillnad från php-metrics som det mäts i olika värden som cyclomatic complexity. Högst complexity i Scrutinizer är Entity/Book. 

Bilden till höger visar metoder i klasserna sorterade efter högst complexitet. Här ser vi Card:asString som metoden med högst komplexitet. Detta är samma siffra vi ser i PHPMetrics. Denna metod går att förbättra för att minska komplexiteten. 

### Issues

<img src="/img/scrutinizer/issues.png" class="metrics-img">

I Scrutinizer finns det en sida för issues. Där har jag 40 som är kategoriserade som buggar och 5 som är kategoriserade som unsused code. Många av dessa är småfixar som jag kan lösa för att få ett bättre resultat.


