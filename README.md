<h1>Data generator</h1>

<h2>What is this?</h2>
<p>In the software development process is often a need to test data. Anyway, the programmer needs to make sure that the program will work with the actual amount of data before it will give to the customer. In the case when the amount of data does not matter it will not cause serious problems, but what if that is supposed database table can contain more than 1000000 and more records?  How to quickly and easily create test data for this table? This requires a flexible and simple tool capable of quickly generate test data in a useful format for import to the database. The solution to this issue is shown by the example of the data to for the user table</p>

<h2>What was used?</h2>
<ol>
<li>PHP5 as console applicaion</li>
<li>Zend_Console_Getopt class for collection of the options</li>
<li>Scabo_Heap - own library for generate random data</li>
<ol>

<h2>Architecture of the Scabo_Heap</h2>
<p>For maximum flexibility, the application is divided into four parts:</p>
<ol>
<li>Settings source</li>
<li>Settings reader</li>
<li>Result writer</li>
<li>Result target</li>
</ol>
<p>Для обеспечения максимальной гибксти приложение разбивается на 4 составные части</p>

<h2>Источник</h2>
<p>Предоставляет данные конфигурации для редера</p>

<h2>Редер</h2>
<p>Читает данные конфигурации из произвольного формата. Т.о. возможно создать редер для любого формата</p>

<h2>Врайтер</h2>
<p>Преобразует сгенерированный данные в произвольный формат и передает их в цель. Возможно реализовать врайтер для любого формата</p>

<h2>Цель</h2>
<p>Записывает сгенеригованные данные в произовольное место. Обычно это файл, но
может быть что-то другое. в любом случае, всегда можно сгенерировать свою цель</p>
